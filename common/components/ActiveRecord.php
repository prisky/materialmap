<?php

namespace common\components;

use Yii;
use common\models\Model;
use yii\helpers\Inflector;
use kartik\helpers\Html;

/**
 * Controller is the base class of app controllers and implements the CRUD actions for a model.
 *
 * @author Andrew Blake <admin@newzealandfishing.com>
 */
abstract class ActiveRecord extends \yii\db\ActiveRecord
{

	/**
	 * @var string the model name of the search class with namespace
	 */
	public $modelNameSearch;

	/**
	 * @var string the model name of the class without namespace
	 */
	public $modelNameShort;

	/**
	 *
	 * @var string The concatenated label returned when the models ActiveQuery::displayAttributes method is used 

	 */
	public $text;
	
	/*
	 * @inheritdoc
	 */
	public function __construct($config = array())
	{
 		$this->modelNameShort = static::modelNameShort();
		
		parent::__construct($config);
	}
	
	private static function modelNameShort() {
		$reflect = new \ReflectionClass(get_called_class());
		return $reflect->getShortName();
	}

	private static function modelName() {
		return "\\common\\models\\" . static::modelNameShort();
	}

 	private static function modelNameSearch()
	{
		return "\\backend\\models\\" . static::modelNameShort() . 'Search';
	}

   /**
     * @inheritdoc
     * @return UserQuery
     */
    public static function find()
    {
		$modelNameQuery = static::modelName() . 'Query';
	
		return class_exists($modelNameQuery)
			? new $modelNameQuery(get_called_class())
			: parent::find();
    }
	
	/**
	 * Get foreign key attribute name within this model that references another model.
	 * @param string $references the name name of the model that the foreign key references.
	 * @return string the foreign key attribute name within this model that references another model
	 */
	public static function getParentForeignKeyName($references = NULL)
	{
		if($references == NULL) {
			$references = static::parentName();
		}

		$referencedModelName = "\\common\\models\\$references";
		if(class_exists($referencedModelName)) {
			return Yii::$app->db->createCommand('
				SELECT COLUMN_NAME
				FROM information_schema.KEY_COLUMN_USAGE
				WHERE TABLE_SCHEMA = :schemaName
				AND TABLE_NAME = :tableName
				AND REFERENCED_TABLE_NAME = :referencedTableName', [
					':schemaName' => Yii::$app->params['defaultSchema'],
					':tableName' => static::tableName(),
					':referencedTableName' => $referencedModelName::tableName(),
				])->queryScalar();
		}
	}
	
	public static function parentName($modelNameShort = NULL)
	{
		if($modelNameShort === NULL) {
			$modelNameShort = static::modelNameShort();
		}

		return Yii::$app->db->createCommand("
			SELECT parent.auth_item_name
			FROM tbl_model child 
				JOIN tbl_navigation ON child.id = tbl_navigation.child
				JOIN tbl_model parent ON parent.id =tbl_navigation.parent
			WHERE child.auth_item_name = '$modelNameShort'
				AND tbl_navigation.depth = 1
		")->queryScalar();
	}
	
	/**
	 * Get the plural form of the class name to display
	 * @return type
	 */
	public static function labelPlural()
	{
		return Yii::t('app', Model::findOne(['auth_item_name' => static::modelNameShort()])->label_plural);
	}
	
	/**
	 * Get the short version of the model for display
	 * @param int $primaryKey The primary key value. If null then the 
	 * @return string The display name
	 */
	public static function labelShort($primaryKey=null)
	{
		$label = static::label($primaryKey);
		
		if(mb_strlen($label) > 20) {
			$label = mb_substr("$label ...");
		}
		
		return $label;
	}
		
	/**
	 * Get the best name to display for a model
	 * @param int $primaryKey The primary key value. If null then the 
	 * @return type
	 */
	public static function label($primaryKey = null)
	{
		// caches
		static $labels = NULL;
		
		$modelNameShort = static::modelNameShort();

		if($primaryKey) {
			$modelName = static::modelName();
			$model = $modelName::find()->where(['id' => $primaryKey])->displayAttributes()->one();
			$label = $model->text;
		}
		// otherwise if not cached
		elseif(empty($labels[$modelNameShort])) {
			$label = Yii::t('app', Model::findOne(['auth_item_name' => $modelNameShort])->label);

			// cache it
			$labels[$modelNameShort] = $label;
		}
		// otherwise use cache
		else {
			$label = $labels[$modelNameShort];
		}

		return Html::encode($label);
	}
	
	/**
	 * @inheritdoc
	 */
	public function getAttributeLabel($attribute) {
		// caches
		static $labels = NULL;
		static $models = NULL;
		
		$modelName = preg_replace('/Search$/', '', static::modelNameShort());

		// if not cached
		if(!isset($labels[$modelName][$attribute])) {
			// if the attribute is a foreign key
			if($referencedModelName = $this->referencedModelName($attribute)) {
				$referencedModelName = "\\common\\models\\$referencedModelName";
				$label = $referencedModelName::label();
			}
			else {
				// attribute is not a foreign key
				/* TODO: functional test should check that all attributes are referenced here to ensure that translations will
				 * be available in the future i.e. no attribute in tbl_column = no way to get a translation easily. It also 
				 * might occurr that we allow different help to be defined for different standard setups */
				// cache
				if(!isset($models[$modelName])) {
					$models[$modelName] = Model::findOne(['auth_item_name' => $modelName])->id;
				}

				if($attributeModel = \common\models\Column::findOne(['name' => $attribute, 'model_id' => $models[$modelName]])) {
					$label = $attributeModel->label;
				}
				else {
					$label = NULL;
				}
			}
			
			// cache it for optimization
			$labels[$modelName][$attribute] = $label;
		}
		
		return $labels[$modelName][$attribute];
	}

	/**
	 * Get the name of the model for the referenced table of and attribute.
	 * @param string $attribute The name of the attribute to check if is foreign key and what it references
	 * @return string The referenced model name or null if not a foreign key
	 */
	private function referencedModelName($attribute) {
		// cache
		static $keyColumnUsage = NULL;
		
		if(!$keyColumnUsage) {
			$rows = Yii::$app->db->createCommand('
				SELECT TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME
				FROM information_schema.KEY_COLUMN_USAGE
				WHERE TABLE_SCHEMA = :schemaName', [
					':schemaName' => Yii::$app->params['defaultSchema'],
			])->queryAll();

			foreach($rows as &$row) {
				$keyColumnUsage[$row['TABLE_NAME']] = [$row['COLUMN_NAME'] => $row['REFERENCED_TABLE_NAME']];
			}
		}

		return isset($keyColumnUsage[static::tableName()][$attribute])
			? Inflector::id2camel(preg_replace('/^' . Yii::$app->db->tablePrefix . '/', '', $keyColumnUsage[static::tableName()][$attribute]), '_')
			: NULL;
	}

}

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
	
    public function transactions()
    {
        return [
			'admin' => self::OP_ALL,
			self::SCENARIO_DEFAULT => self::OP_ALL,
		];
    }

	private static function modelNameShort() {
		$reflect = new \ReflectionClass(get_called_class());
		return $reflect->getShortName();
	}

	protected static function modelName() {
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
		
		if(class_exists($modelNameQuery)) {
			$modelNameQuery = new $modelNameQuery(get_called_class());
			return $modelNameQuery->accountScope()->softDeleteScope();
		}

		return parent::find();
    }

    /**
	 * Extended as need to add table or else if joined then column can be ambiguous i.e. id in both joined tables
     * @inheritdoc
     */
    public static function findOne($condition)
    {
        $query = static::find();
        if (\yii\helpers\ArrayHelper::isAssociative($condition)) {
            // hash condition
            return $query->andWhere($condition)->one();
        } else {
            // query by primary key
            $primaryKey = static::primaryKey();
            if (isset($primaryKey[0])) {
                return $query->andWhere([static::tableName() . '.' . $primaryKey[0] => $condition])->one();
            } else {
                throw new InvalidConfigException(get_called_class() . ' must have a primary key.');
            }
        }
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
				JOIN tbl_model_tree ON child.id = tbl_model_tree.child
				JOIN tbl_model parent ON parent.id =tbl_model_tree.parent
			WHERE child.auth_item_name = '$modelNameShort'
				AND tbl_model_tree.depth = 1
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
			$label = mb_substr("$label ...", 0, 20);
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
			$model = $modelName::find()->where([static::tableName() . '.id' => $primaryKey])->displayAttributes()->one();
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
	
	public function getLabel() {
		return static::label($this->primaryKey);
	}
	
	/**
	 * @inheritdoc
	 */
	public function getAttributeLabel($attribute) {
		return static::attributeLabel($attribute);
	}

	/**
	 * Get the label for a given attribute
	 * @staticvar null $labels
	 * @staticvar null $models
	 * @param type $attribute
	 * @return string attribute label
	 */
	public static function attributeLabel($attribute) {
		// caches
		static $labels = NULL;
		static $models = NULL;
		
		$modelName = preg_replace('/Search$/', '', static::modelNameShort());

		// if not cached
		if(!isset($labels[$modelName][$attribute])) {
			// if the attribute is a foreign key
			if($referencedModelName = static::referencedModelName($attribute)) {
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
	private static function referencedModelName($attribute) {
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
	
	/**
	 * Remove any null valued attributes if null is not allowed for the column - treat empty string as null but 0 as 0
	 * @inheritdoc
	 */
	public function save($runValidation = true, $attributeNames = null)
	{
		$messages = array('1062' => 'Duplicates are not allowed');

		try {
			if(!$attributeNames) {
				foreach($this->attributes as $attributeName => $attribute) {
					if(!(is_null($attribute) || $attribute == '') || $this->tableSchema->columns[$attributeName]->allowNull) {
						$attributeNames[] = $attributeName;
					}
				}
			}

			return parent::save($runValidation, $attributeNames);
		}
		catch (\Exception $e) {
			$msg = $e->getMessage();

			// special handling if forcing trigger failures to block an operation
			if(strpos($msg, 'forced_trigger_error'))
			{
				// extact the message which is the incorrect column name - the bad table name is forced_trigger_error
				preg_match("/1054 Unknown column 'forced_trigger_error\.(.*)' in 'where clause'/", $msg, $matches);
				$msg = $matches[1];
			}
			else
			{
				// special handling to block parents being set to children - forcing a trigger fail on bad column name
				foreach ($messages as $needle => &$message)
				{
					// NB: do not remove the speech marks around needle - converting to string
					if(strpos($msg, "$needle") !== FALSE)
					{
						$msg = $message;
						break;
					}
				}
			}
				
			$this->addError(null, $msg);
		}
	}
	
	/**
	 * Soft delete
	 * @inheritdoc
	 */
    public static function deleteAll($condition = '', $params = [])
    {
        $command = static::getDb()->createCommand();

		// if this model has a deleted attribute
		if(isset(static::getTableSchema()->columns['deleted'])) {
			// soft delete
			$command->update(static::tableName(), ['deleted'=>1], $condition, $params);
		} else {
			// make it gone forever
			$command->delete(static::tableName(), $condition, $params);
		}
 
        return $command->execute();
    }

    protected function insertInternal($attributes = null)
    {
        if (!$this->beforeSave(true)) {
            return false;
        }
        $values = $this->getDirtyAttributes($attributes);
        if (empty($values)) {
            foreach ($this->getPrimaryKey(true) as $key => $value) {
                $values[$key] = $value;
            }
        }
        $db = static::getDb();
        $command = $db->createCommand()->insert($this->tableName(), $values);
		
 		try {
			if (!$command->execute()) {
				return false;
			}
		}
		catch (\Exception $e) {
			if(isset($this->deleted))
			{
				$primaryKeyName = $this->primaryKey();
				$tableName = $this->tableName();
				unset($values['deleted']);
				if(array_key_exists($primaryKeyName, $values)) {
					unset($values[$primaryKeyName]);
				}
				// get the matching row. Need to get list of attributes for search as the constraint violation columns
				// only - otherwise the other attributes will stop us from finding a match
				preg_match("/for key '(.*)'. The /", $e->message, $matches);
				if(isset($matches[1])) {
					$databaseName = Yii::$app->params['defaultSchema'];
					$results = $db->createCommand("
						SELECT COLUMN_NAME
						FROM information_schema.KEY_COLUMN_USAGE
						WHERE TABLE_SCHEMA = '$databaseName'
							AND TABLE_NAME = '$tableName'
							AND CONSTRAINT_NAME = '{$matches[1]}'")->all();
					// convert to array so we can use the keys to intersect with attributes
					$keyColumns = array();
					foreach($results as $keyColumn) {
						$keyColumns[$keyColumn['COLUMN_NAME']] = $keyColumn['COLUMN_NAME'];
					}

					$values = array_intersect_key($values, $keyColumns);
				}
				// try without the deleted attribute - using parent::find to avoid the soft delete scope applied in find
				if(!$values || !$model = parent::find($values)->one()) {
					// unknown error i.e. not todo with already being deleted
					throw($e);
				}

				// if deleted
				if($model->deleted) {
					$this->$primaryKeyName = $model->$primaryKeyName;
					// attempt undelete
					$this->deleted = 0;
					$this->isNewRecord = FALSE;
					if($result=$this->update()) {
						// similalate setting of other properties that insert sets
						$this->isNewRecord = TRUE;
//						$this->scenario = 'update';
					}
					else {
						// not handled so re-throw
						throw($e);
					}
				}
				else {
					// not handled so re-throw
					throw($e);
				}
			}
			else {
				// not handled so re-throw
				throw($e);
			}
		}

        $table = $this->getTableSchema();
        if ($table->sequenceName !== null) {
            foreach ($table->primaryKey as $name) {
                if ($this->getAttribute($name) === null) {
                    $id = $table->columns[$name]->phpTypecast($db->getLastInsertID($table->sequenceName));
                    $this->setAttribute($name, $id);
                    $values[$name] = $id;
                    break;
                }
            }
        }

        $changedAttributes = array_fill_keys(array_keys($values), null);
        $this->setOldAttributes($values);
        $this->afterSave(true, $changedAttributes);

        return true;
    }

}
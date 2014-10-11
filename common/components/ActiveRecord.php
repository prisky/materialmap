<?php

namespace common\components;

use Yii;
use common\models\Model;
use yii\helpers\Inflector;
use kartik\helpers\Html;
use yii\db\Schema;
use Aws\S3\Enum\CannedAcl;

/**
 * @inheritdoc
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
	 * @var string the model name of the with namespace
	 */
	public $modelName;

	/**
	 * @var string The concatenated label returned when the models ActiveQuery::display method is used 
	 */
	public $text;
	
	/**
	 *
	 * @var array Errors returned from database on save that aren't necassarily specific to a particular field i.e. maybe trigger or
	 * foreign key constraing violation. These once known can be searched for in Save below and formatted for readability.
	 * TODO: potentially suggest to yii developers something like this
	 */
	public $saveErrors = [];
	
	/*
	 * @inheritdoc
	 */
	public function __construct($config = array())
	{
 		$this->modelNameShort = static::modelNameShort();
 		$this->modelName = static::modelName();
		
		parent::__construct($config);
	}
	
	/**
	 * @inheritdoc
	 */
    public function transactions()
    {
        return [
			'admin' => self::OP_ALL,
			self::SCENARIO_DEFAULT => self::OP_ALL,
		];
    }

	/**
	 * Gets the name of this class without the namespace
	 * @return string The name of the class without the namespace
	 */
	private static function modelNameShort() {
		$reflect = new \ReflectionClass(get_called_class());
		return $reflect->getShortName();
	}

	/**
	 * Gets the name of this class with the namespace
	 * @return string The name of the class with the namespace
	 */
	protected static function modelName() {
		return "\\common\\models\\" . static::modelNameShort();
	}

	/**
	 * Gets the name of this search model class with the namespace
	 * @return string The name of the search model class with the namespace
	 */
 	private static function modelNameSearch()
	{
		return "\\backend\\models\\" . static::modelNameShort() . 'Search';
	}

   /**
     * @inheritdoc. Applies account and soft delete scopes i.e. dependant on RBAC may limit results by account_id
     * and will exclude soft deleted records if model has a deleted attribute.
     * 
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
	 * @inheritdoc. Adds table or else if joined then column can be ambiguous i.e. id in both joined tables
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
	public static function parentAttribute($references = NULL)
	{
		if($references == NULL) {
			$references = static::parentName();
		}

		$referencedModelName = "\\common\\models\\$references";
		if($references && class_exists($referencedModelName)) {
			return Yii::$app->db->createCommand('
				SELECT COLUMN_NAME
				FROM information_schema.KEY_COLUMN_USAGE
				WHERE TABLE_SCHEMA = :schemaName
				AND TABLE_NAME = :tableName
				AND REFERENCED_TABLE_NAME = :referencedTableName
				AND REFERENCED_COLUMN_NAME = :referencedColumnName', [
					':schemaName' => Yii::$app->params['defaultSchema'],
					':tableName' => static::tableName(),
					':referencedTableName' => $referencedModelName::tableName(),
					':referencedColumnName' =>'id',
				])->queryScalar();
		}
	}
	
	/**
	 * Derive the parent model using our navigation structure
	 * @return mixed ActiveRecord The parent of this model or null if there is no parent
	 */
	public function getParentModel()
	{
		if($parentNameShort = static::parentName()) {
			$parentModelName = "\\common\\models\\$parentNameShort";
			$parentAttribute = static::parentAttribute();

			return $parentModelName::findOne($this->$parentAttribute);
		}
	}
	
	/**
	 * Get the name of the parent class in our navigation structure
	 * 
	 * @param type $modelNameShort The class that we want to find the parent of in our navigation structure
	 * @return string The name of the parent class without namespace
	 */
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
	 * Get the plural form of a class name for output
	 * @return string The translated plural version of a class name for output
	 */
	public static function labelPlural()
	{
		return Yii::t('app', Model::findOne(['auth_item_name' => static::modelNameShort()])->label_plural);
	}
	
	/**
	 * Get the short version of a model label for output. This will be shortened to 20 characters including elipses if longer than 20 characters
	 * @param int $primaryKey The primary key value of the target model. If null then the class name is used instead.
	 * @return string The display label for a model or class shortened to 20 characters including elipses
	 */
	public static function labelShort($primaryKey=null)
	{
		$label = static::label($primaryKey);
		
		if(mb_strlen($label) > 20) {
			$label = mb_substr($label, 0, 16) . '...';
		}
		
		return $label;
	}
		
	/**
	 * Get the best full length name to display for a model
	 * @param int $primaryKey The primary key value of the target model. If null then the class name is used instead.
	 * @return string The display label for a model or class.
	 */
	public static function label($primaryKey = null)
	{
		// caches
		static $labels = NULL;
		
		$modelNameShort = static::modelNameShort();

		if($primaryKey) {
			$modelName = static::modelName();
			$model = $modelName::find()->where([static::tableName() . '.id' => $primaryKey])->display()->one();
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
	 * Get the best name to display for a model - shortened to 20 charactes with elipses if necassary.
	 * @param int $primaryKey The primary key value of the target model.
	 * @return string The label for output for a model.
	 */
	public function getLabel() {
		return static::labelShort($this->primaryKey);
	}
	
	/**
	 * @inheritdoc
	 */
	public function getAttributeLabel($attribute) {
		parent::getAttributeLabel($attribute);
		return static::attributeLabel($attribute);
	}

	/**
	 * Get the label for a given attribute
	 * @staticvar array $labels Cached array of lables
	 * @staticvar array $models Cached array of models
	 * @param string $attribute The attribute that we want a label for
	 * @return string attribute label The label
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
	 * Calcualte the path file for uploads
	 * @return string The path
	 */
	public function getPath()
	{
		static $path = [];

		// cache
		if(isset($path[$this->id])) {
			return $path[$this->id];
		}

		// calculate the path from the uploads directory
		for($model = $this, $path = []; $model; $model = $model->parentModel) {
			if($model->primaryKey) {
				$path[] = $model->primaryKey;
			}
			$path[] = $model->modelNameShort;
		}

		return $path[$this->id] = implode('/', array_reverse($path));
	}

	/**
	 * Extract and save base64 images from html text string and return
	 * @param string $attributeName the html attribute in the current model
	 */
	private function storeImages($attributeName)
	{
		$manager = Yii::$app->resourceManager;
		$options = [
			'Bucket' => $manager->bucket,
			'ACL' => CannedAcl::PUBLIC_READ
		];
		$path = $this->path;

		$this->$attributeName = preg_replace_callback(
			"/src=\"data:([^\"]+)\"/",
			function ($matches) use ($manager, $options, $path)
		{
			list($contentType, $encContent) = explode(';', $matches[1]);
			if (substr($encContent, 0, 6) != 'base64') {
				return $matches[0]; // Don't understand, return as is
			}
			
			switch($contentType) {
				case 'image/jpeg':  $imgExt = '.jpg'; break;
				case 'image/gif':   $imgExt = '.gif'; break;
				case 'image/png':   $imgExt = '.png'; break;
				default:            return $matches[0]; // Don't understand, return as is
			}
			
			$imgBase64 = substr($encContent, 6);
			$options['SourceFile'] = md5($imgBase64) . $imgExt;
			file_put_contents($options['SourceFile'], base64_decode($imgBase64));
			$options['Key'] = $path . '/' . $options['SourceFile'];
			$manager->getClient()->putObject($options);
			@unlink($options['SourceFile']);
			
			// permanent url
			return 'src="' . $manager->getUrl($options['Key']) . '"'; 
		}, $this->$attributeName);
	}
	
	/**
	 * @inheritdoc. Convert empty strings to nulls where null is allowed and perform other error testing that validate can't e.g.
	 * dealing with a potential variety of constraint or trigger failure errors in database. See the database for details but we
	 * can perform some checking in a trigger and then force an error which we can receive and decode within here in order to produce
	 * sensible feedback to user. This could be for example on adjacency list, blocking endless loop, or multi column unique constraints
	 * without the need to have to test the datatabase first in validation.
	 */
	public function save($runValidation = true, $attributeNames = null)
	{
		$messages = array('1062' => 'Duplicates are not allowed');

		// deal with unset attributes
		$primaryKeys = $this->getTableSchema()->primaryKey;
		foreach($this->attributes as $attributeName => $attributeValue) {
			// leave out primary keys
            if(in_array($attributeName, $primaryKeys) && $this->getAttribute($attributeName) === null) {
				// skip primary key as null - probably insert
				continue;
			}
			
			if((is_null($attributeValue) || $attributeValue == '')) {
				$column = $this->tableSchema->columns[$attributeName];
				if($column->allowNull) {
					$this->$attributeName = null;
				}
				else {
					switch ($column->type) {
						 case Schema::TYPE_SMALLINT:
						 case Schema::TYPE_INTEGER:
						 case Schema::TYPE_BIGINT:
						 case Schema::TYPE_BOOLEAN:
						 case Schema::TYPE_FLOAT:
						 case Schema::TYPE_DECIMAL:
						 case Schema::TYPE_MONEY:
							 $this->$attributeName = 0;
					 }
				}
			}
		}

		try {
			$failedValidation = false;
			
			if(!$attributeNames) {
				// do separate validation here - one reason is that attribute may contain an array of UpdateFiles which need validating
				// but update or create will error with array to string conversion
				if ($runValidation) {
					if(!$this->validate($attributeNames)) {
						Yii::info('Model not updated due to validation error.', __METHOD__);
						return;
					}
					$runValidation = false;
				}
	
				$attributeNames = [];
				foreach($this->attributes as $attributeName => $attributeValue) {
					if(!is_array($attributeValue)) {
						$attributeNames[] = $attributeName;
					}
				}
			}

			// if save is ok then need to re-save potentially to extract and store files from html fields
			if($return = parent::save($runValidation, $attributeNames)) {
				foreach($this->safeAttributes() as $attributeName) {
					// transplate base64 images from html fields to s3
					if (strpos($attributeName, '_html') !== false) {
					   $this->storeImages($attributeName);
					}
				}
				parent::save(false, $attributeNames);
			}
			
			return $return;
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
				
			$this->saveErrors[] = ['content' => $msg];
		}
	}
	
	/**
	 * @inheritdoc. Supports soft delete. Not actually intended for use of multiple deletes
	 */
    public static function deleteAll($condition = '', $params = [])
    {
        $command = Yii::$app->db->createCommand();

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

	/**
	 * @inheritdoc. Supports soft delete.
	 */
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
        $command = Yii::$app->db->createCommand()->insert($this->tableName(), $values);
		
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
					$results = Yii::$app->db->createCommand("
						SELECT COLUMN_NAME
						FROM information_schema.KEY_COLUMN_USAGE
						WHERE TABLE_SCHEMA = '$databaseName'
							AND TABLE_NAME = '$tableName'
							AND CONSTRAINT_NAME = '{$matches[1]}'")->queryAll();
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

	/**
	 * @inheritdoc. Attempt to resolve any unset null attributes used in foreign keys -- for enforcing referencial integrity most probably.
	 */
	public function beforeValidate()
	{
		// keep looping until no changes are made in one complete cycle. We do this because once an attribute has been resolved then
		// this might help us to reolve another attribute we have already passed over.
		while(true) {
			$haveSetAttributeValue = false;
			// loop thru attributes
			foreach($this->attributes as $attributeName => $attribute) {
				// if we have a null value on a not null attribute
				if(is_null($attribute) && !$this->tableSchema->columns[$attributeName]->allowNull) {
					// loop thru all foreign keys using this attribute
					foreach($this->tableSchema->foreignKeys as $foreignKey) {
						// if the foreign key uses this attribute
						if(isset($foreignKey[$attributeName])) {
							// see if we can uniquely can identify a row in the foreign key table
							// initialize paramters array for select
							$queryParams = [];
							$whereArray = [];
							// get a list of non null attributes for this foreign key in this model
							foreach($foreignKey as $thisTableAttribute => $foreignTableAttribute) {
								// if not that table name which array index 0
								if($thisTableAttribute) {
									$t = $this->$thisTableAttribute;
									if(!is_null($this->$thisTableAttribute)) {
										$queryParams[":$foreignTableAttribute"] = $this->$thisTableAttribute;
										$whereArray[$foreignTableAttribute] = "$foreignTableAttribute = :$foreignTableAttribute";
									}
								}
							}
							// if we have some query paramters to try
							if($queryParams) {
								// see if these paramters identify a single row
								$rowCount = Yii::$app->db->createCommand("
									SELECT COUNT(*)
									FROM `{$foreignKey[0]}`
									WHERE " . implode(' AND ', $whereArray), 
									$queryParams
								)->queryScalar();
									
								if($rowCount == 1) {
									$this->$attributeName = Yii::$app->db->createCommand("
										SELECT `{$foreignKey[$attributeName]}`
										FROM `{$foreignKey[0]}`
										WHERE " . implode(' AND ', $whereArray), 
										$queryParams
									)->queryScalar();

									// ensure we keep looping in case setting this attribute allows us to resolve another null attribute now	
									$haveSetAttributeValue = true;
									// value resolved so exit this inner loop
									break;
								}
							}
						}
					}
				}
			}
			
			if(!$haveSetAttributeValue) {
				break;
			}
		}
		
		return parent::beforeValidate();
	}
	
}
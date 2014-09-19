<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\components\gii\generators\mcrud;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Connection;
use yii\db\Schema;
use yii\gii\CodeFile;
use yii\helpers\Inflector;
use yii\base\NotSupportedException;
use yii\helpers\StringHelper;
use backend\components\FieldRange;
use kartik\grid\GridView;

/**
 * This generator will generate one or multiple ActiveRecord classes for the specified database table and crud
 */
class Generator extends \yii\gii\generators\crud\Generator
{
    public $db = 'db';
    public $ns = 'common\models';
    public $tableName;
    public $modelClass;
    public $baseClass = 'common\components\ActiveRecord';
    public $generateRelations = true;
    public $useTablePrefix = false;
    public $baseControllerClass = 'backend\components\Controller';
    public $controllerNs = 'backend\controllers';
    public $searchModelNs = 'backend\models';
	public $enableI18N = true;

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Model and CRUD Generator';
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return 'This generator generates a model, controller and views that implement CRUD (Create, Read, Update, Delete)
            operations for the specified data model.';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
		// remove rules not required due to extending crud generator
		$rules = parent::rules();
		unset($rules[3][0][0]);	// modelClass required
		unset($rules[3][0][1]);	// controllerClass required
		
        return array_merge($rules, [
            [['db', 'ns', 'searchModelNs', 'controllerNs', 'tableName', 'modelClass', 'baseClass'], 'filter', 'filter' => 'trim'],
            [['db', 'ns', 'searchModelNs', 'controllerNs', 'tableName', 'baseClass'], 'required'],
            [['db', 'modelClass'], 'match', 'pattern' => '/^\w+$/', 'message' => 'Only word characters are allowed.'],
            [['ns', 'searchModelNs', 'controllerNs', 'baseClass'], 'match', 'pattern' => '/^[\w\\\\]+$/', 'message' => 'Only word characters and backslashes are allowed.'],
            [['tableName'], 'match', 'pattern' => '/^(\w+\.)?([\w\*]+)$/', 'message' => 'Only word characters, and optionally an asterisk and/or a dot are allowed.'],
            [['db'], 'validateDb'],
            [['ns', 'searchModelNs', 'controllerNs'], 'validateNamespace'],
            [['tableName'], 'validateTableName'],
            [['modelClass'], 'validateModelClass', 'skipOnEmpty' => false],
            [['baseClass'], 'validateClass', 'params' => ['extends' => ActiveRecord::className()]],
            [['generateRelations'], 'boolean'],
            [['enableI18N'], 'boolean'],
            [['useTablePrefix'], 'boolean'],
            [['messageCategory'], 'validateMessageCategory', 'skipOnEmpty' => false],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'ns' => 'Model Namespace',
            'searchModelNs' => 'Search Model Namespace',
            'controllerNs' => 'Controller Namespace',
            'db' => 'Database Connection ID',
            'tableName' => 'Table Name',
            'modelClass' => 'Model Class',
            'baseClass' => 'Base Model Class',
            'generateRelations' => 'Generate Relations',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function hints()
    {
        return array_merge(parent::hints(), [
            'ns' => 'This is the namespace of the ActiveRecord class to be generated, e.g., <code>common\models</code>',
            'searchModelNs' => 'This is the namespace of the search model class to be generated, e.g., <code>app\models</code>',
            'controllerNs' => 'This is the namespace of the controller class to be generated, e.g., <code>app\controllers</code>',
            'db' => 'This is the ID of the DB application component.',
            'tableName' => 'This is the name of the DB table that the new ActiveRecord class is associated with, e.g. <code>post</code>.
                The table name may consist of the DB schema part if needed, e.g. <code>public.post</code>.
                The table name may end with asterisk to match multiple table names, e.g. <code>tbl_*</code>
                will match tables who name starts with <code>tbl_</code>. In this case, multiple ActiveRecord classes
                will be generated, one for each matching table name; and the class names will be generated from
                the matching characters. For example, table <code>tbl_post</code> will generate <code>Post</code>
                class.',
            'modelClass' => 'This is the name of the ActiveRecord class to be generated. The class name should not contain
                the namespace part as it is specified in "Namespace". You do not need to specify the class name
                if "Table Name" ends with asterisk, in which case multiple ActiveRecord classes will be generated.',
            'baseClass' => 'This is the base class of the new ActiveRecord class. It should be a fully qualified namespaced class name.',
            'generateRelations' => 'This indicates whether the generator should generate relations based on
                foreign key constraints it detects in the database. Note that if your database contains too many tables,
                you may want to uncheck this option to accelerate the code generation process.',
            'useTablePrefix' => 'This indicates whether the table name returned by the generated ActiveRecord class
                should consider the <code>tablePrefix</code> setting of the DB connection. For example, if the
                table name is <code>tbl_post</code> and <code>tablePrefix=tbl_</code>, the ActiveRecord class
                will return the table name as <code>{{%post}}</code>.',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function autoCompleteData()
    {
        $db = $this->getDbConnection();
        if ($db !== null) {
            return [
                'tableName' => function () use ($db) {
                    return $db->getSchema()->getTableNames();
                },
            ];
        } else {
            return [];
        }
    }

    /**
     * @inheritdoc
     */
    public function requiredTemplates()
    {
        return [
			'model.php',
			'controller.php',
			'search.php',
		];
    }

    /**
     * @inheritdoc
     */
    public function stickyAttributes()
    {
        return array_merge(parent::stickyAttributes(), ['ns', 'searchModelNs', 'controllerNs', 'db', 'baseClass', 'generateRelations']);
    }

    /**
     * Generate CRUD, called from generate to merge model and crud generation.
	 * @param string $className the model name
	 * @param string $tableName the table name
	 * @return \yii\gii\CodeFile
	 */
    private function generateCrud($className, $tableName)
    {
		$this->controllerClass = $this->controllerNs . '\\' . $className . 'Controller';
		$this->searchModelClass = $this->searchModelNs . '\\' . $className . 'Search';

        $controllerFile = Yii::getAlias('@' . str_replace('\\', '/', ltrim($this->controllerClass, '\\')) . '.php');

        $files = [
            new CodeFile($controllerFile, $this->render('controller.php', ['tableName' => $tableName])),
        ];

        if (!empty($this->searchModelClass)) {
            $searchModel = Yii::getAlias('@' . str_replace('\\', '/', ltrim($this->searchModelClass, '\\') . '.php'));
            $files[] = new CodeFile($searchModel, $this->render('search.php'));
        }

        $viewPath = $this->getViewPath();
        $templatePath = $this->getTemplatePath() . '/views';
        foreach (scandir($templatePath) as $file) {
            if (is_file($templatePath . '/' . $file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                $files[] = new CodeFile("$viewPath/$file", $this->render("views/$file"));
            }
        }

        return $files;
    }

   /**
    * Overwritten this as the original left hyphens in which isn't in the controller id I think
    * @return string the controller ID (without the module ID prefix)
    */
    public function getControllerID()
    {
        $pos = strrpos($this->controllerClass, '\\');
        $class = substr(substr($this->controllerClass, $pos + 1), 0, -10);

		return strtolower($class);
    }
	
    /**
     * @inheritdoc
     */
    public function generate()
    {
		// model
        $files = [];
        $relations = $this->generateRelations();
        $db = $this->getDbConnection();
        foreach ($this->getTableNames() as $tableName) {
            $className = $this->generateClassName($tableName);
			if(!$this->modelClass) {
				$this->modelClass = $className;
			}
            $tableSchema = $db->getTableSchema($tableName);
            $params = [
                'tableName' => $tableName,
                'className' => $className,
                'tableSchema' => $tableSchema,
                'rules' => $this->generateRules($tableSchema),
                'relations' => isset($relations[$className]) ? $relations[$className] : [],
            ];
			
			// generate the model
            $files[] = $codeFile = new CodeFile(
                Yii::getAlias('@' . str_replace('\\', '/', $this->ns)) . '/' . $className . '.php',
                $this->render('model.php', $params)
            );
			
			// actually need the model file to exist here in order to generate crud but don't want to loose the old either
			if(file_exists($codeFile->path)) {
				$modelTempName = $codeFile->path . 'tmp';
				$modelName = $codeFile->path;
				rename($modelName, $modelTempName);
			}
			$codeFile->save();
			
			// geerate the ActiveQuery
            $files[] = $codeFile = new CodeFile(
                Yii::getAlias('@' . str_replace('\\', '/', $this->ns)) . '/' . $className . 'Query'. '.php',
                $this->render('activequery.php', $params)
            );

			// crud generateor expectes modelName to be namespaced
			$this->modelClass = $this->ns . '\\' . $className;
			$files = array_merge($files, $this->generateCrud($className, $tableName));
			
			if(isset($modelTempName)) {
				rename($modelTempName, $modelName);
				unset($modelName);
				unset($modelTempName);
			}
			
			$this->modelClass = NULL;
        }

        return $files;
    }

    /**
     * Generates the attribute labels for the specified table.
     * @param \yii\db\TableSchema $table the table schema
     * @return array the generated attribute labels (name => label)
     */
    public function generateLabels($table)
    {
		$labels = [];
        foreach ($table->columns as $column) {
			$labels[$column->name] = Yii::$app->db->createCommand("
				SELECT tbl_column.label FROM tbl_column JOIN tbl_model ON tbl_column.model_id = tbl_model.id
				WHERE tbl_model.auth_item_name = REPLACE(bookaspot.ucwords(REPLACE(REPLACE(LOWER(:table), 'tbl_', ''), '_', ' ')), ' ', '')
				AND tbl_column.name = :column_name", [
					':table' => $table->name,
					':column_name' => $column->name,
				])->queryScalar();;
         }

        return $labels;
    }

    /**
     * Generates validation rules for the specified table.
     * @param \yii\db\TableSchema $table the table schema
     * @return array the generated validation rules
     */
    public function generateRules($table)
    {
        $types = [];
        $lengths = [];
		
		$labels = $this->generateLabels($table);
	
        foreach ($table->columns as $column) {
			// no rules for autoincrement or non-labeled attributes
            if ($column->autoIncrement || empty($labels[$column->name])) {
                continue;
            }
            if (!$column->allowNull && $column->defaultValue === null) {
                $types['required'][] = $column->name;
            }
            switch ($column->type) {
                case Schema::TYPE_SMALLINT:
                case Schema::TYPE_INTEGER:
                case Schema::TYPE_BIGINT:
                    $types['integer'][] = $column->name;
                    break;
                case Schema::TYPE_BOOLEAN:
                    $types['boolean'][] = $column->name;
                    break;
                case Schema::TYPE_FLOAT:
                case Schema::TYPE_DECIMAL:
                case Schema::TYPE_MONEY:
                    $types['number'][] = $column->name;
                    break;
                case Schema::TYPE_DATE:
                case Schema::TYPE_TIME:
                case Schema::TYPE_DATETIME:
                case Schema::TYPE_TIMESTAMP:
                    $types['safe'][] = $column->name;
                    break;
                default: // strings
                    if ($column->size > 0) {
                        $lengths[$column->size][] = $column->name;
                    } else {
                        $types['string'][] = $column->name;
                    }
            }
        }
        $rules = [];
        foreach ($types as $type => $columns) {
            $rules[] = "[['" . implode("', '", $columns) . "'], '$type']";
        }
        foreach ($lengths as $length => $columns) {
            $rules[] = "[['" . implode("', '", $columns) . "'], 'string', 'max' => $length]";
        }

        // Unique indexes rules
        try {
            $db = $this->getDbConnection();
            $uniqueIndexes = $db->getSchema()->findUniqueIndexes($table);
            foreach ($uniqueIndexes as $uniqueColumns) {
                // Avoid validating auto incremental columns
                if (!$this->isColumnAutoIncremental($table, $uniqueColumns)) {
                    $attributesCount = count($uniqueColumns);

                    if ($attributesCount == 1) {
                        $rules[] = "[['" . $uniqueColumns[0] . "'], 'unique']";
                    } elseif ($attributesCount > 1) {
                        $labels = array_intersect_key($labels, array_flip($uniqueColumns));
                        $lastLabel = array_pop($labels);
                        $columnsList = implode("', '", $uniqueColumns);
                        $rules[] = "[['" . $columnsList . "'], 'unique', 'targetAttribute' => ['" . $columnsList . "'], 'message' => 'The combination of " . implode(', ', $labels) . " and " . $lastLabel . " has already been taken.']";
                    }
                }
            }
        } catch (NotSupportedException $e) {
            // doesn't support unique indexes information...do nothing
        }

        return $rules;
    }

    /**
     * @return array the generated relation declarations
     */
    protected function generateRelations()
    {
        if (!$this->generateRelations) {
            return [];
        }

        $db = $this->getDbConnection();

        if (($pos = strpos($this->tableName, '.')) !== false) {
            $schemaName = substr($this->tableName, 0, $pos);
        } else {
            $schemaName = '';
        }

        $relations = [];
        foreach ($db->getSchema()->getTableSchemas($schemaName) as $table) {
            $tableName = $table->name;
            $className = $this->generateClassName($tableName);
            foreach ($table->foreignKeys as $refs) {
                $refTable = $refs[0];
                unset($refs[0]);
				// only interested in primary keys i.e. id columns except maybe with RBAC stuff
				foreach($refs as $key => $value) {
					if($value != 'id' && $key != 'id') {
						unset($refs[$key]);
					}
				}
				if(!$refs) {
					continue;
				}
                $fks = array_keys($refs);
                $refClassName = $this->generateClassName($refTable);

                // Add relation for this table
                $link = $this->generateRelationLink(array_flip($refs));
                $relationName = $this->generateRelationName($relations, $className, $table, $fks[0], false);
                $relations[$className][$relationName] = [
                    "return \$this->hasOne($refClassName::className(), $link);",
                    $refClassName,
                    false,
                ];

                // Add relation for the referenced table
                $hasMany = false;
                foreach ($fks as $key) {
                    if (!in_array($key, $table->primaryKey, true)) {
                        $hasMany = true;
                        break;
                    }
                }
                $link = $this->generateRelationLink($refs);
                $relationName = $this->generateRelationName($relations, $refClassName, $refTable, $className, $hasMany);
                $relations[$refClassName][$relationName] = [
                    "return \$this->" . ($hasMany ? 'hasMany' : 'hasOne') . "($className::className(), $link);",
                    $className,
                    $hasMany,
                ];
            }

            if (($fks = $this->checkPivotTable($table)) === false) {
                continue;
            }
            $table0 = $fks[$table->primaryKey[0]][0];
            $table1 = $fks[$table->primaryKey[1]][0];
            $className0 = $this->generateClassName($table0);
            $className1 = $this->generateClassName($table1);

            $link = $this->generateRelationLink([$fks[$table->primaryKey[1]][1] => $table->primaryKey[1]]);
            $viaLink = $this->generateRelationLink([$table->primaryKey[0] => $fks[$table->primaryKey[0]][1]]);
            $relationName = $this->generateRelationName($relations, $className0, $db->getTableSchema($table0), $table->primaryKey[1], true);
            $relations[$className0][$relationName] = [
                "return \$this->hasMany($className1::className(), $link)->viaTable('{$table->name}', $viaLink);",
                $className1,
                true,
            ];

            $link = $this->generateRelationLink([$fks[$table->primaryKey[0]][1] => $table->primaryKey[0]]);
            $viaLink = $this->generateRelationLink([$table->primaryKey[1] => $fks[$table->primaryKey[1]][1]]);
            $relationName = $this->generateRelationName($relations, $className1, $db->getTableSchema($table1), $table->primaryKey[0], true);
            $relations[$className1][$relationName] = [
                "return \$this->hasMany($className0::className(), $link)->viaTable('{$table->name}', $viaLink);",
                $className0,
                true,
            ];
        }

        return $relations;
    }

    /**
     * Generates the link parameter to be used in generating the relation declaration.
     * @param array $refs reference constraint
     * @return string the generated link parameter.
     */
    protected function generateRelationLink($refs)
    {
        $pairs = [];
        foreach ($refs as $a => $b) {
            $pairs[] = "'$a' => '$b'";
        }

        return '[' . implode(', ', $pairs) . ']';
    }

    /**
     * Checks if the given table is a pivot table.
     * For simplicity, this method only deals with the case where the pivot contains two PK columns,
     * each referencing a column in a different table.
     * @param \yii\db\TableSchema the table being checked
     * @return array|boolean the relevant foreign key constraint information if the table is a pivot table,
     * or false if the table is not a pivot table.
     */
    protected function checkPivotTable($table)
    {
        $pk = $table->primaryKey;
        if (count($pk) !== 2) {
            return false;
        }
        $fks = [];
        foreach ($table->foreignKeys as $refs) {
            if (count($refs) === 2) {
                if (isset($refs[$pk[0]])) {
                    $fks[$pk[0]] = [$refs[0], $refs[$pk[0]]];
                } elseif (isset($refs[$pk[1]])) {
                    $fks[$pk[1]] = [$refs[0], $refs[$pk[1]]];
                }
            }
        }
        if (count($fks) === 2 && $fks[$pk[0]][0] !== $fks[$pk[1]][0]) {
            return $fks;
        } else {
            return false;
        }
    }

    /**
     * Generate a relation name for the specified table and a base name.
     * @param array $relations the relations being generated currently.
     * @param string $className the class name that will contain the relation declarations
     * @param \yii\db\TableSchema $table the table schema
     * @param string $key a base name that the relation name may be generated from
     * @param boolean $multiple whether this is a has-many relation
     * @return string the relation name
     */
    protected function generateRelationName($relations, $className, $table, $key, $multiple)
    {
        if (strcasecmp(substr($key, -2), 'id') === 0 && strcasecmp($key, 'id')) {
            $key = rtrim(substr($key, 0, -2), '_');
        }
        if ($multiple) {
            $key = Inflector::pluralize($key);
        }
        $name = $rawName = Inflector::id2camel($key, '_');
        $i = 0;
        while (isset($table->columns[lcfirst($name)])) {
            $name = $rawName . ($i++);
        }
        while (isset($relations[$className][lcfirst($name)])) {
            $name = $rawName . ($i++);
        }

        return $name;
    }

    /**
     * Validates the [[db]] attribute.
     */
    public function validateDb()
    {
        if (!Yii::$app->has($this->db)) {
            $this->addError('db', 'There is no application component named "db".');
        } elseif (!Yii::$app->get($this->db) instanceof Connection) {
            $this->addError('db', 'The "db" application component must be a DB connection instance.');
        }
    }

    /**
     * Validates the [[ns]] attribute.
     */
    public function validateNamespace()
    {
        $this->ns = ltrim($this->ns, '\\');
        $path = Yii::getAlias('@' . str_replace('\\', '/', $this->ns), false);
        if ($path === false) {
            $this->addError('ns', 'Namespace must be associated with an existing directory.');
        }
    }

    /**
     * Validates the [[modelClass]] attribute.
     */
    public function validateModelClass()
    {
        if ($this->isReservedKeyword($this->modelClass)) {
            $this->addError('modelClass', 'Class name cannot be a reserved PHP keyword.');
        }
/*        if (substr($this->tableName, -1) !== '*' && $this->modelClass == '') {
            $this->addError('modelClass', 'Model Class cannot be blank if table name does not end with asterisk.');
        }*/
    }

    /**
     * Validates the [[tableName]] attribute.
     */
    public function validateTableName()
    {
        if (strpos($this->tableName, '*') !== false && substr($this->tableName, -1) !== '*') {
            $this->addError('tableName', 'Asterisk is only allowed as the last character.');

            return;
        }
        $tables = $this->getTableNames();
        if (empty($tables)) {
            $this->addError('tableName', "Table '{$this->tableName}' does not exist.");
        } else {
            foreach ($tables as $table) {
                $class = $this->generateClassName($table);
                if ($this->isReservedKeyword($class)) {
                    $this->addError('tableName', "Table '$table' will generate a class which is a reserved PHP keyword.");
                    break;
                }
            }
        }
    }

    private $_tableNames;
    private $_classNames;

    /**
     * @return array the table names that match the pattern specified by [[tableName]].
     */
    protected function getTableNames()
    {
        if ($this->_tableNames !== null) {
            return $this->_tableNames;
        }
        $db = $this->getDbConnection();
        if ($db === null) {
            return [];
        }
        $tableNames = [];
        if (strpos($this->tableName, '*') !== false) {
            if (($pos = strrpos($this->tableName, '.')) !== false) {
                $schema = substr($this->tableName, 0, $pos);
                $pattern = '/^' . str_replace('*', '\w+', substr($this->tableName, $pos + 1)) . '$/';
            } else {
                $schema = '';
                $pattern = '/^' . str_replace('*', '\w+', $this->tableName) . '$/';
            }

            foreach ($db->schema->getTableNames($schema) as $table) {
                if (preg_match($pattern, $table)) {
                    $tableNames[] = $schema === '' ? $table : ($schema . '.' . $table);
                }
            }
        } elseif (($table = $db->getTableSchema($this->tableName, true)) !== null) {
            $tableNames[] = $this->tableName;
            $this->_classNames[$this->tableName] = $this->generateClassName($this->tableName);
        }

        return $this->_tableNames = $tableNames;
    }

    /**
     * Generates the table name by considering table prefix.
     * If [[useTablePrefix]] is false, the table name will be returned without change.
     * @param string $tableName the table name (which may contain schema prefix)
     * @return string the generated table name
     */
    public function generateTableName($tableName)
    {
        if (!$this->useTablePrefix) {
            return $tableName;
        }

        $db = $this->getDbConnection();
        if (preg_match("/^{$db->tablePrefix}(.*?)$/", $tableName, $matches)) {
            $tableName = '{{%' . $matches[1] . '}}';
        } elseif (preg_match("/^(.*?){$db->tablePrefix}$/", $tableName, $matches)) {
            $tableName = '{{' . $matches[1] . '%}}';
        }
        return $tableName;
    }

    /**
     * Generates a class name from the specified table name.
     * @param string $tableName the table name (which may contain schema prefix)
     * @return string the generated class name
     */
    public function generateClassName($tableName)
    {
        if (isset($this->_classNames[$tableName])) {
            return $this->_classNames[$tableName];
        }

        if (($pos = strrpos($tableName, '.')) !== false) {
            $tableName = substr($tableName, $pos + 1);
        }

        $db = $this->getDbConnection();
        $patterns = [];
        $patterns[] = "/^{$db->tablePrefix}(.*?)$/";
        $patterns[] = "/^(.*?){$db->tablePrefix}$/";
        if (strpos($this->tableName, '*') !== false) {
            $pattern = $this->tableName;
            if (($pos = strrpos($pattern, '.')) !== false) {
                $pattern = substr($pattern, $pos + 1);
            }
            $patterns[] = '/^' . str_replace('*', '(\w+)', $pattern) . '$/';
        }
        $className = $tableName;
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $tableName, $matches)) {
                $className = $matches[1];
                break;
            }
        }

        return $this->_classNames[$tableName] = Inflector::id2camel($className, '_');
    }

    /**
     * @return Connection the DB connection as specified by [[db]].
     */
    public function getDbConnection()
    {
        return Yii::$app->get($this->db, false);
    }

    /**
     * Checks if any of the specified columns is auto incremental.
     * @param \yii\db\TableSchema $table the table schema
     * @param array $columns columns to check for autoIncrement property
     * @return boolean whether any of the specified columns is auto incremental.
     */
    protected function isColumnAutoIncremental($table, $columns)
    {
        foreach ($columns as $column) {
            if (isset($table->columns[$column]) && $table->columns[$column]->autoIncrement) {
                return true;
            }
        }

        return false;
    }
	
	/**
	 * Tidy var_export using php 5.4 short array syntax as per http://stackoverflow.com/questions/24316347/how-to-format-var-export-to-php5-4-array-syntax
	 * preceding with a pipe character in position 0 means not to quote or add slashes
	 * @param type $var
	 * @param type $indent
	 * @return type
	 */
	public function var_export54($var, $indent="") {
		switch (gettype($var)) {
			case "string":
				return ((strpos($var, '|') === 0))
					? str_replace('|', '', $var)
					: '"' . addcslashes($var, "\\\$\"\r\n\t\v\f") . '"';
			case "array":
				$indexed = array_keys($var) === range(0, count($var) - 1);
				$r = [];
				foreach ($var as $key => $value) {
					$r[] = "$indent    "
						 . ($indexed ? "" : $this->var_export54($key) . " => ")
						 . $this->var_export54($value, "$indent    ");
				}
				return "[\n" . implode(",\n", $r) . "\n" . $indent . "]";
			case "boolean":
				return $var ? "TRUE" : "FALSE";
			default:
				return var_export($var, TRUE);
		}
	}

	/**
	 * @inheritdoc
	 */
	public function generateActiveField($attribute)
    {
        $tableSchema = $this->getTableSchema();
        $column = $tableSchema->columns[$attribute];

		if (preg_match('/(password|pass|passwd|passcode)/i', $column->name)) {
			$inputType = 'DetailView::INPUT_PASSWORD';
		}
		elseif ($column->type == 'decimal' && preg_match('/(amount|charge|balance)/i', $column->name)) {
			$inputType = 'DetailView::INPUT_MONEY';
		}
		elseif ($column->type == 'decimal' && preg_match('/(rate)$/i', $column->name)) {
			$inputType = 'DetailView::INPUT_SPIN';
		}
		elseif (is_array($column->enumValues) && count($column->enumValues) > 0) {
			$dropDownOptions = [];
			foreach ($column->enumValues as $enumValue) {
				$dropDownOptions[$enumValue] = Inflector::humanize($enumValue);
			}
			$inputType = "DetailView::INPUT_DROPDOWN_LIST,
				'options' => ['prompt' => ''],
				'items' => " . preg_replace("/\n\s*/", ' ', $this->var_export54($dropDownOptions, '    '));
		}
		else {
			if($column->type == 'integer') {
				// if the field is in a foreign key
				foreach($tableSchema->foreignKeys as $tableKeys) {
					// if in this foreign key and identifying
					if(isset($tableKeys[$column->name]) && $tableKeys[$column->name] == 'id') {
						$where = [];
						// get any other attributes in this foreign key
						foreach($tableKeys as $referencing => $referenced) {
							// ignore array index 0 as is tablename, and ignore the identifying one
							if($referencing && $referenced != 'id') {
								$where[] = "'$referenced'" . ' => $model->' . $referencing;
							}
						}
						$inputType = "DetailView::INPUT_SELECT2, 'widgetOptions' => \$this->context->fKWidgetOptions('"
							. $this->generateClassName($tableKeys[0])
							. "', ["
							. implode(', ', $where)
							. "])";
						break;
					}
				}
			}

			if(!isset($inputType)) {
				switch($column->dbType) {
					case 'tinyint(1)' :
						$inputType = 'DetailView::INPUT_SWITCH';
						break;
					case 'date' :
						$inputType = 'DetailView::INPUT_DATE';
						break;
					case 'time' :
						$inputType = 'DetailView::INPUT_TIME';
						break;
					case 'datetime' :
					case 'timestamp' :
						$inputType = 'DetailView::INPUT_DATETIME';
						break;
					case 'text' :
					case 'mediumtext' :
						$inputType = 'DetailView::INPUT_TEXTAREA';
						break;
					default :
						$inputType = "DetailView::INPUT_TEXT";
						if($column->size) {
							$inputType .= ", 'options' => ['maxlength' => {$column->size}]";
						}
				}
			}
		}

        return "\t\t\t['attribute' => '$attribute', 'type' => $inputType],";
	}
	
	/**
	 * Generate list of columns to show in index view - grid.
	 * @param string $modelName name spaced model name
	 * @param string $modelNameShort model name without namespace
	 * @param array $excelFormats format strings for use when exporting to excel
	 * @param array $searchConditions for use in search model
	 * @param array $searchAttributes for use in search model
	 * @param array $searchRules for use in search model
	 * @return array the grid columns
	 */
	public function generateGridColumns($modelName, $modelNameShort, &$excelFormats, &$searchConditions = [], &$searchAttributes = [], &$searchRules = [])
	{
		$tableSchema =  Yii::$app->db->getTableSchema($modelName::tableName());
 		$columns = $tableSchema->columns;
		$gridColumns = [];
		$types = [];
		$attributes = [];

 		// get all columns that have labels
		$attributesSet = \common\models\Column::find()
			->joinWith('model')
			->where(['auth_item_name' => $modelNameShort])
			->asArray()
			->all();
		
		foreach($attributesSet as $attribute) {
			$attributes[$attribute['name']] = $attribute['name'];
		}
		
		foreach($this->removeNonDisplayAttributes($modelName, $attributes) as $attribute) {
			$column = $columns[$attribute];

			$gridColumn = ['attribute' => $attribute];

			if (preg_match('/(password|pass|passwd|passcode)/i', $attribute)) {
				continue;
			}
			elseif ($column->type == 'decimal' && preg_match('/(amount|charge|balance)/i', $attribute)) {
				$gridColumn['filterType'] = 'backend\components\FieldRange';
				$gridColumn['filterWidgetOptions'] = [
					'separator' => null,
					'attribute1' => "from_$attribute",
					'attribute2' => "to_$attribute",
					'type' => FieldRange::INPUT_WIDGET,
					'widgetClass' => GridView::FILTER_MONEY,
					'widgetOptions1' => [
						'pluginOptions' => [
							'allowEmpty' => true,
						],
					],
					'widgetOptions2' => [
						'pluginOptions' => [
							'allowEmpty' => true,
						],
					],
				];
				$types['number'][] = $attribute;
				$types['number'][] = "from_$attribute";
				$types['number'][] = "to_$attribute";
				$searchConditions[] = "if(!is_null(\$this->from_{$attribute}) && \$this->from_{$attribute} != '') \$query->andWhere('`$attribute` >= :from_{$attribute}', [':from_{$attribute}' => \$this->from_{$attribute}])";
				$searchConditions[] = "if(!is_null(\$this->to_{$attribute}) && \$this->to_{$attribute} != '') \$query->andWhere('`$attribute` <= :to_{$attribute}', [':to_{$attribute}' => \$this->to_{$attribute}])";
				$searchAttributes[] = "from_$attribute";
				$searchAttributes[] = "to_$attribute";
				$excelFormats[$attribute] = '$#,##0.00;[Red]-$#,##0.00';
			}
			elseif ($column->type == 'decimal' && preg_match('/(rate)$/i', $attribute)) {
				$gridColumn['filterType'] = 'backend\components\FieldRange';
				$gridColumn['filterWidgetOptions'] = [
					'separator' => null,
					'attribute1' => "from_$attribute",
					'attribute2' => "to_$attribute",
					'type' => FieldRange::INPUT_SPIN,
					'widgetOptions1' => [
						'pluginOptions' => [
							'verticalbuttons' => true,
							'verticalupclass' => 'glyphicon glyphicon-plus',
							'verticaldownclass' => 'glyphicon glyphicon-minus',
								],
						],
					'widgetOptions2' => [
						'pluginOptions' => [
							'verticalbuttons' => true,
							'verticalupclass' => 'glyphicon glyphicon-plus',
							'verticaldownclass' => 'glyphicon glyphicon-minus',
						],
					],
				];
				$types['number'][] = $attribute;
				$types['number'][] = "from_$attribute";
				$types['number'][] = "to_$attribute";
				$searchConditions[] = "if(!is_null(\$this->from_{$attribute}) && \$this->from_{$attribute} != '') \$query->andWhere('`$attribute` >= :from_{$attribute}', [':from_{$attribute}' => \$this->from_{$attribute}])";
				$searchConditions[] = "if(!is_null(\$this->to_{$attribute}) && \$this->to_{$attribute} != '') \$query->andWhere('`$attribute` <= :to_{$attribute}', [':to_{$attribute}' => \$this->to_{$attribute}])";
				$searchAttributes[] = "from_$attribute";
				$searchAttributes[] = "to_$attribute";
				$excelFormats[$attribute] = '0.00%';
			}
			elseif (is_array($column->enumValues) && count($column->enumValues) > 0) {
				foreach ($column->enumValues as $enumValue) {
					$dropDownOptions[$enumValue] = $enumValue;
				}
				$gridColumn['filter'] = $dropDownOptions;
				$types['string'][] = $attribute;
				$searchConditions[] = "\$query->andFilterWhere(['{$attribute}' => \$this->{$attribute}])";
			}
			else {
				if($column->type == 'integer') {
					foreach($tableSchema->foreignKeys as $tableKeys) {
						// if in this foreign key and identifying
						if(isset($tableKeys[$column->name]) && $tableKeys[$column->name] == 'id') {
							$where = [];
							// get any other attributes in this foreign key
							foreach($tableKeys as $referencing => $referenced) {
								// ignore array index 0 as is tablename, and ignore the identifying one
								if($referencing && $referenced != 'id') {
									$where[] = "'$referenced'" . ' => $searchModel->' . $referencing;
								}
							}
							$foreignKeyModelNameShort = Inflector::id2camel(str_replace('tbl_', '', $tableKeys[0]), '_');
							$foreignKeyRelationName = lcfirst($foreignKeyModelNameShort);
							$gridColumn['filterType'] = GridView::FILTER_SELECT2;
							$gridColumn['filterWidgetOptions'] =
								'|Controller::fKWidgetOptions(\''
								. $foreignKeyModelNameShort
								. "', ["
								. implode(', ', $where)
								. "])";
							$gridColumn['value'] = '|function($model, $key, $index, $widget) {
								return \\backend\\components\\GridView::foreignKeyValue($model, $key, $index, $widget, "' . $foreignKeyRelationName . '");
							}';
							$types['integer'][] = $attribute;
							$searchConditions[] = "\$query->andFilterWhere(['{$attribute}' => \$this->{$attribute}])";
							$gridColumn['format'] = 'raw';
							break;
						}
					}
				}

				if(!isset($gridColumn['filterType'])) {
					switch($column->dbType) {
						case 'tinyint(1)' :
							$gridColumn['class'] = 'kartik\grid\BooleanColumn';
							$excelFormats[$attribute] = '[=0]"No";[=1]"Yes"';
							$types['boolean'][] = $attribute;
							break;
						case 'date' :
							$gridColumn['filterType'] = 'backend\components\FieldRange';
							$gridColumn['filterWidgetOptions'] = [
								'separator' => null,
								'attribute1' => "from_$attribute",
								'attribute2' => "to_$attribute",
								'type' => FieldRange::INPUT_DATE,
								'widgetOptions1' => [
									'pluginOptions' => ['autoclose' => true,],
								],
								'widgetOptions2' => [
									'pluginOptions' => ['autoclose' => true,],
								],
							];
							$types['number'][] = $attribute;
							$types['number'][] = "from_$attribute";
							$types['number'][] = "to_$attribute";
							$searchConditions[] = "if(!is_null(\$this->from_{$attribute}) && \$this->from_{$attribute} != '') \$query->andWhere('`$attribute` >= :from_{$attribute}', [':from_{$attribute}' => \$this->from_{$attribute}])";
							$searchConditions[] = "if(!is_null(\$this->to_{$attribute}) && \$this->to_{$attribute} != '') \$query->andWhere('`$attribute` <= :to_{$attribute}', [':to_{$attribute}' => \$this->to_{$attribute}])";
							$searchAttributes[] = "from_$attribute";
							$searchAttributes[] = "to_$attribute";
							$excelFormats[$attribute] = 'mmmm d", "yy';
							break;
						case 'time' :
							$gridColumn['filterType'] = 'backend\components\FieldRange';
							$gridColumn['filterWidgetOptions'] = [
								'separator' => null,
								'attribute1' => "from_$attribute",
								'attribute2' => "to_$attribute",
								'type' => FieldRange::INPUT_TIME,
								'widgetOptions1' => [
									'pluginOptions' => ['autoclose' => true,],
								],
								'widgetOptions2' => [
									'pluginOptions' => ['autoclose' => true,],
								],
							];
							$types['number'][] = $attribute;
							$types['number'][] = "from_$attribute";
							$types['number'][] = "to_$attribute";
							$searchConditions[] = "if(!is_null(\$this->from_{$attribute}) && \$this->from_{$attribute} != '') \$query->andWhere('`$attribute` >= :from_{$attribute}', [':from_{$attribute}' => \$this->from_{$attribute}])";
							$searchConditions[] = "if(!is_null(\$this->to_{$attribute}) && \$this->to_{$attribute} != '') \$query->andWhere('`$attribute` <= :to_{$attribute}', [':to_{$attribute}' => \$this->to_{$attribute}])";
							$searchAttributes[] = "from_$attribute";
							$searchAttributes[] = "to_$attribute";
							$excelFormats[$attribute] = 'hh:mm AM/PM';
							break;
						case 'datetime' :
						case 'timestamp' :
							$gridColumn['filterType'] = 'backend\components\FieldRange';
							$gridColumn['filterWidgetOptions'] = [
								'separator' => null,
								'attribute1' => "from_$attribute",
								'attribute2' => "to_$attribute",
								'type' => FieldRange::INPUT_DATETIME,
								'widgetOptions1' => [
									'type' => \kartik\widgets\DateTimePicker::TYPE_INPUT,
									'pluginOptions' => ['autoclose' => true,],
								],
								'widgetOptions2' => [
									'type' => \kartik\widgets\DateTimePicker::TYPE_INPUT,
									'pluginOptions' => ['autoclose' => true,],
								],
							];
							$types['number'][] = $attribute;
							$types['number'][] = "from_$attribute";
							$types['number'][] = "to_$attribute";
							$excelFormats[$attribute] = 'hh:mm AM/PM on mmmm d, yy';
							$searchConditions[] = "if(!is_null(\$this->from_{$attribute}) && \$this->from_{$attribute} != '') \$query->andWhere('`$attribute` >= :from_{$attribute}', [':from_{$attribute}' => \$this->from_{$attribute}])";
							$searchConditions[] = "if(!is_null(\$this->to_{$attribute}) && \$this->to_{$attribute} != '') \$query->andWhere('`$attribute` <= :to_{$attribute}', [':to_{$attribute}' => \$this->to_{$attribute}])";
							$searchAttributes[] = "from_$attribute";
							$searchAttributes[] = "to_$attribute";
					}
				
					// last resort
					if(!isset($gridColumn['filterType'])) {
						switch($column->type) {
							case 'integer' :
								$excelFormats[$attribute] = '#';
								$types['integer'][] = $attribute;
								break;
							case 'decimal' :
								$types['number'][] = $attribute;
								$excelFormats[$attribute] = '#.#';
								break;
						}
						if(isset($excelFormats[$attribute])) {
							$gridColumn['filterType'] = 'backend\components\FieldRange';
							$gridColumn['filterWidgetOptions'] = [
								'separator' => null,
								'attribute1' => "from_$attribute",
								'attribute2' => "to_$attribute",
							];
							$searchConditions[] = "if(!is_null(\$this->from_{$attribute}) && \$this->from_{$attribute} != '') \$query->andWhere('`$attribute` >= :from_{$attribute}', [':from_{$attribute}' => \$this->from_{$attribute}])";
							$searchConditions[] = "if(!is_null(\$this->to_{$attribute}) && \$this->to_{$attribute} != '') \$query->andWhere('`$attribute` <= :to_{$attribute}', [':to_{$attribute}' => \$this->to_{$attribute}])";
							$searchAttributes[] = "from_$attribute";
							$searchAttributes[] = "to_$attribute";
						}
						else {
							$types['safe'][] = $attribute;
							$searchConditions[] = "\$query->andFilterGoogleStyle('{$attribute}', \$this->{$attribute})";
						}
					}
				}
			}
			
			$gridColumns[] = $gridColumn;
		}

        $searchRules = [];
        foreach ($types as $type => $columns) {
            $searchRules[] = "[['" . implode("', '", $columns) . "'], '$type']";
        }

		return $gridColumns;
	}

	/**
	 * Remove any non identifying attributes (i.e. if none of the foreign keys using the attribute point at an id column in the
	 * referenced table). Basically used out attributes that have a sole purpose of enforcing referencial integrity.
	 * @param string $modelName The name of the model for which to remove non identifying attributes
	 * @param array $attributes
	 * @return array
	 */
	private function removeNonIdentifyingAttributes($modelName, $attributes) {
		$foreignKeyAttributes = [];
		$identifyingAttributes = [];
			
		// loop thru attributes
		foreach($attributes as $attributeName) {
			// loop thru all foreign keys using this attribute
			foreach($modelName::getTableSchema()->foreignKeys as $foreignKey) {
				// if the foreign key uses this attribute
				if(isset($foreignKey[$attributeName])) {
					// record that this is a foreign key attribute
					$foreignKeyAttributes[$attributeName] = $attributeName;
					// if this attribute is identifying i.e. points at the pk (id) of the referenced table
					if($foreignKey[$attributeName] == 'id') {
						// record that it is identifying
						$identifyingAttributes[$attributeName] = $attributeName;
					}
				}
			}
		}

		// remove the difference between foreign key attributes and identifying attributes are the attributes we want to remove
		foreach(array_diff($foreignKeyAttributes, $identifyingAttributes) as $removeAttribute) {
			unset($attributes[array_search($removeAttribute, $attributes)]);
		}

		return $attributes;
	}

	/**
	 * Remove non display attributes
	 * @param string $modelName The name of the model for which to remove non displayable attributes
	 * @param array $attributes The attributes
	 * @return array Attributes with certain attributes removed
	 */
	public function removeNonDisplayAttributes($modelName, $attributes) {
		// in addition we dont want the following - just to be sure
		foreach(['id', 'deleted', 'created', 'account_id', 'account_id', 'level_id', $modelName::parentAttribute()] as $attribute) {
			if(($key = array_search($attribute, $attributes)) !== false) {
				unset($attributes[$key]);
			}
		}
		
		return $this->removeNonIdentifyingAttributes($attributes);
	}


}

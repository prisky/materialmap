<?php

namespace backend\components;

/**
 * ClosureTableBehavior class file.
 * Provides tree set functionality for a model.
 *
 * @author Aidas Klimas, Andrew Blake ported yii2
 * @link https://github.com/AidasK/yii-closure-table-behavior/
 * @version 2.0.0
 */
class ClosureTableQuery extends \yii\db\ActiveQuery
{
    public $closureTableName;
    private $tableName;
    private $primaryKeyAttribute;
	public $childAttribute;
    public $parentAttribute;
    public $depthAttribute;

     /**
     * Constructor.
     * @param array $modelClass the model class associated with this query
     * @param array $config configurations to be applied to the newly created query object
     */
    public function __construct($modelClass, $config = [])
    {
        parent::__construct($modelClass, $config);
		
		$connection = \Yii::$app->db;
 		$modelName = $this->modelClass;
		$tableName = $modelName::tableName();
		$this->closureTableName = $connection->quoteTableName($this->closureTableName);
		$this->tableName = $connection->quoteTableName($this->tableName);
		$this->childAttribute = $connection->quoteColumnName($this->childAttribute);
		$this->parentAttribute = $connection->quoteColumnName($this->parentAttribute);
		$this->depthAttribute = $connection->quoteColumnName($this->depthAttribute);
		$this->primaryKeyAttribute = $connection->quoteColumnName($this->primaryKeyAttribute);
    }
   /**
     * Named scope. Gets ancestors for node.
     * @param int|string $primaryKey
     * @return ActiveQuery the ancestors
     */
	public function ancestorsOf($primaryKey, $depth = null)
    {
 		$modelName = $this->modelClass;
		$tableName = $modelName::tableName();
		$primaryKeyName = $modelName::primaryKey()[0];

		$this->unorderedPathOf($primaryKey);

        if($depth === null) {
			$this->andWhere("{$this->closureTableName}.{$this->childAttribute} != {$this->closureTableName}.{$this->parentAttribute}");
		} else
		{
			$this->andWhere(['BETWEEN', "{$this->closureTableName}.{$this->depthAttribute}", 1, $depth]);
        }
		
		return $this;
    }
	
    /**
     * Named scope. Gets path to the node.
     * @param int|string $primaryKey primary key
     * @return ActiveQuery the owner.
     */
    private function unorderedPathOf($primaryKey)
    {
		$modelName = $this->modelClass;
		$tableName = $modelName::tableName();
		$primaryKeyName = $modelName::primaryKey()[0];

		return $this
			->join('JOIN', $this->closureTableName, "$tableName.$primaryKeyName = {$this->closureTableName}.{$this->parentAttribute}")
			->where(["{$this->closureTableName}.{$this->childAttribute}" => $primaryKey]);
    }

    /**
     * Named scope. Gets path to the node.
     * @param int|string $primaryKey primary key
     * @return CActiveRecord the owner.
     */
    public function pathOf($primaryKey)
    {
		return $this
			->unorderedPathOf($primaryKey)
			->orderBy([$this->depthAttribute => SORT_DESC]);
    }

    /**
     * Named scope. Gets parent for node.
     * @param int|string $primaryKey
     * @return ActiveQuery the parent
     */
    public function parentOf($primaryKey)
    {
		return $this->ancestorsOf($primaryKey, 1);
    }

    /**
     * Named scope. Finds descendants
     * @param int|string $primaryKey.
     * @param int $depth the depth.
     * @return ActiveQuery the owner.
     */
    public function descendantsOf($primaryKey, $depth = null)
    {
 		$modelName = $this->modelClass;
		$tableName = $modelName::tableName();
		$primaryKeyName = $modelName::primaryKey()[0];

		$this
			->join('JOIN', $this->closureTableName, "$tableName.$primaryKeyName = {$this->closureTableName}.{$this->childAttribute}")
			->where(["{$this->closureTableName}.{$this->parentAttribute}" => $primaryKey]);

        if($depth === null) {
			$this->andWhere("{$this->closureTableName}.{$this->childAttribute} != {$this->closureTableName}.{$this->parentAttribute}");
		}
		else {
			$this->andWhere(['BETWEEN', "{$this->closureTableName}.{$this->depthAttribute}", 1, $depth]);
        }
		
		return $this;
    }

    /**
     * Named scope. Gets children for node (direct descendants only).
     * @param int|string $primaryKey
     * @return ActiveQuery the owner.
     */
    public function childrenOf($primaryKey)
    {
        return $this->descendantsOf($primaryKey, 1);
    }

    /**
     * Named scope. Get siblings
     * @param int|string $primaryKey
     * @param boolean $include whether or not to include the node or not
     * @return ActiveQuery the owner.
     */
    public function siblingsOf($primaryKey, $include = FALSE)
    {
 		$modelName = $this->modelClass;
		$table = $modelName::tableName();
		$pk = $modelName::primaryKey()[0];
		$closure = $this->closureTableName;
		$parent = $this->parentAttribute;
		$child = $this->childAttribute;
		$depth = $this->depthAttribute;
		
		$union = new \yii\db\Query;
		
		// if node is not a root
		$this
			->select("t.*")
			->from("$table t")
			->join("JOIN", "$closure c", "t.$pk = c.$child")
			->where("c.$parent = (SELECT $parent FROM $closure WHERE $child = :primaryKey AND $depth = 1) AND $depth = 1",
				[':primaryKey' => $primaryKey]);
		
		// if node is a root
		$union
			->select("t.*")
			->from("$table t")
			->join("JOIN", "$closure c1", "t.$pk = c1.$child")
			->join("LEFT JOIN", "$closure c2", "c1.$child = c2.$child AND c1.$parent != c2.$parent")
			->join("JOIN", "(SELECT NULL FROM $table t
				JOIN  $closure c1 ON t.$pk = c1.$child AND t.$pk = $primaryKey
				LEFT JOIN $closure c2 ON c1.$child = c2.$child AND c1.$parent != c2.$parent
				WHERE c2.$parent IS NULL) c3")
			->where("c2.$parent IS NULL");
			
		// exclude the node?
		if($include === FALSE) {
			$union->andWhere( "t.$pk != :primaryKey", [':primaryKey' => $primaryKey]);
			$this->andWhere( "t.$pk != :primaryKey", [':primaryKey' => $primaryKey]);
		}

		return $this->union($union);
	}

    /**
     * Finds roots
     * @return ActiveQuery the owner.
     */
    public function roots()
	{
 		$modelName = $this->modelClass;
		$t = $modelName::tableName();
		$pk = $modelName::primaryKey()[0];
		$closure = $this->closureTableName;
		$parent = $this->parentAttribute;
		$child = $this->childAttribute;

		$this
			->join("JOIN", "$closure c1", "$t.$pk = c1.$child")
			->join("LEFT JOIN", "$closure c2", "c1.$child = c2.$child AND c1.$parent != c2.$parent")
			->where("c2.$parent IS NULL");
		
		return $this;
	}
}
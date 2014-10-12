<?php

namespace backend\components;

use yii\db\ActiveRecord;

/**
 * ClosureTableActiveRecordTrait class file.
 * Provides tree set functionality for an ActiveRecord.
 *
 * @author Aidas Klimas, Andrew Blake
 * @link https://github.com/AidasK/yii-closure-table-behavior/
 * @version 2.0.0
 */
trait ClosureTableActiveRecordTrait
{

    /**
     * @inheritdoc
     * @return Query
     */
    public static function find()
    {
        $modelNameQuery = static::modelName() . 'Query';

        if (class_exists($modelNameQuery)) {
            $modelNameQuery = new $modelNameQuery(get_called_class());
            $modelNameQuery->attachBehavior(NULL, new ClosureTableQueryBehavior(get_called_class(), [
                'modelClass' => get_called_class(),
                'closureTableName' => static::closureTableName,
                'childAttribute' => static::childAttribute,
                'parentAttribute' => static::parentAttribute,
                'depthAttribute' => static::depthAttribute,
            ]));

            return $modelNameQuery;
        }
    }

    /**
     * Determine if a model is a leaf node 
     * @return bool true if model is a leaf node
     */
    public function isLeaf()
    {
        return (boolean) static::find()->childrenOf($this->id);
    }

    /**
     * Save node and insert closure table records with transaction
     * @param boolean $runValidation whether to perform validation before saving the record.
     * If the validation fails, the record will not be saved to database.
     * @param array $attributes list of attributes that need to be saved. Defaults to null,
     * meaning all attributes that are loaded from DB will be saved.
     * @throws CDbException|Exception
     * @return boolean whether the saving succeeds
     */
    public function saveNodeAsRoot($runValidation = true, $attributes = null)
    {
        $db = $this->getDb();
        if ($db->transaction === null) {
            $transaction = $db->beginTransaction();
        }
        try {
            if (!$this->save($runValidation, $attributes)) {
                if (isset($transaction)) {
                    $transaction->rollback();
                }
                return false;
            }
            $this->markAsRoot($this->primaryKey);
            if (isset($transaction)) {
                $transaction->commit();
            }
        }
        catch (DbException $e) {
            if (isset($transaction)) {
                $transaction->rollback();
            }
            throw $e;
        }
        return true;
    }

    /**
     * Insert closure table records
     * @param $primaryKey
     * @return int
     */
    public function markAsRoot()
    {
        $db = $this->getDb();
        $childAttribute = $db->quoteColumnName(static::childAttribute);
        $parentAttribute = $db->quoteColumnName(static::parentAttribute);
        $depthAttribute = $db->quoteColumnName(static::depthAttribute);
        $closureTable = $db->quoteTableName(static::closureTableName);
        $cmd = $db->createCommand(
            'INSERT INTO ' . $closureTable
            . '(' . $parentAttribute . ',' . $childAttribute . ',' . $depthAttribute . ') '
            . 'VALUES (:nodeId,:nodeId,\'0\')', [':nodeId' => $this->id]
        );
        // bind paramaters
        return $cmd->execute();
    }

    /**
     * Appends node to target as child (Only for new records).
     * @param ActiveRecord|int|string $target where to append
     * @param ActiveRecord|int|string $node node to append
     * @return number of rows inserted, on fail - 0
     */
    public function appendTo($target, $node = null)
    {
        $db = $this->getDb();
        $closureTable = $db->quoteTableName(static::closureTableName);
        if (is_object($target)) {
            $primaryKey = $target->primaryKey;
        } else {
            $primaryKey = $target;
        }
        if ($node === null) {
            $node = $this;
        }
        if ($node instanceof ActiveRecord) {
            $nodeId = $node->primaryKey;
        } else {
            $nodeId = $node;
        }
        $childAttribute = $db->quoteColumnName(static::childAttribute);
        $parentAttribute = $db->quoteColumnName(static::parentAttribute);
        $depthAttribute = $db->quoteColumnName(static::depthAttribute);
        $cmd = $db->createCommand(
            'INSERT INTO ' . $closureTable
            . '(' . $parentAttribute . ',' . $childAttribute . ',' . $depthAttribute . ') '
            . 'SELECT ' . $parentAttribute . ',:nodeId'
            . ',' . $depthAttribute . '+1 '
            . 'FROM ' . $closureTable
            . 'WHERE ' . $childAttribute . '=:pk '
            . 'UNION ALL SELECT :nodeId,:nodeId,\'0\'', [':nodeId' => $nodeId, ':pk' => $primaryKey]
        );
        return $cmd->execute();
    }

    /**
     * Appends target to node as child.
     * @param ActiveRecord $target the target.
     * @return boolean whether the appending succeeds.
     */
    public function append(ActiveRecord $target)
    {
        return $target->appendTo($this);
    }

    /**
     * Move node
     * @param ActiveRecord|int|string $target
     * @param ActiveRecord|int|string $node if null, $this primary key will be used
     * @throws CDbException|Exception
     */
    public function moveTo($target, $node = null)
    {
        $db = $this->getDb();
        $closureTable = $db->quoteTableName(static::closureTableName);
        if ($target instanceof ActiveRecord) {
            $targetId = $target->primaryKey;
        } else {
            $targetId = $target;
        }
        if ($node === null) {
            $node = $this;
        }
        if ($node instanceof ActiveRecord) {
            $nodeId = $node->primaryKey;
        } else {
            $nodeId = $node;
        }
        $childAttribute = $db->quoteColumnName(static::childAttribute);
        $parentAttribute = $db->quoteColumnName(static::parentAttribute);
        $depthAttribute = $db->quoteColumnName(static::depthAttribute);
        if ($db->transaction === null) {
            $transaction = $db->beginTransaction();
        }
        try {
            $cmd = $db->createCommand(
                'DELETE a FROM ' . $closureTable . ' a '
                . 'JOIN ' . $closureTable . ' d ON a.' . $childAttribute . '=d.' . $childAttribute
                . 'LEFT JOIN ' . $closureTable . ' x ON x.' . $parentAttribute . '=d.' . $parentAttribute
                . 'AND x.' . $childAttribute . '=a.' . $parentAttribute
                . 'WHERE d.' . $parentAttribute . '=? AND x.' . $parentAttribute . ' IS NULL', [$nodeId]
            );
            if (!$cmd->execute()) {
                throw new DbException('Node had no records in closure table', 200);
            }
            $cmd = $db->createCommand(
                'INSERT INTO ' . $closureTable . '(' . $parentAttribute . ',' . $childAttribute . ',' . $depthAttribute . ')'
                . 'SELECT u.' . $parentAttribute . ',b.' . $childAttribute
                . ',u.' . $depthAttribute . '+b.' . $depthAttribute . '+1 '
                . 'FROM ' . $closureTable . ' u JOIN ' . $closureTable . ' b '
                . 'WHERE b.' . $parentAttribute . '=? AND u.' . $childAttribute . '=?', [$nodeId, $targetId]
            );
            if (!$cmd->execute()) {
                throw new DbException('Target node does not exist', 201);
            }
            if (isset($transaction)) {
                $transaction->commit();
            }
        }
        catch (DbException $e) {
            if (isset($transaction)) {
                $transaction->rollback();
            }
            throw $e;
        }
    }

    /**
     * Deletes node and it's descendants.
     * @param $primaryKey
     * @return int number of rows deleted
     */
    public function deleteNode($primaryKey = null)
    {
        if ($primaryKey === null) {
            $primaryKey = $this->primaryKey;
        }
        $db = $this->getDb();
        $closureTable = $db->quoteTableName(static::closureTableName);
        $childAttribute = $db->quoteColumnName(static::childAttribute);
        $primaryKeyName = $db->quoteColumnName($this->tableSchema->primaryKey);
        $cmd = $db->createCommand(
            'DELETE t, f '
            . 'FROM ' . $closureTable . ' t '
            . 'JOIN ' . $closureTable . ' tt ON t.' . $childAttribute . '= tt.' . $childAttribute
            . 'JOIN ' . $this->tableName() . ' f ON t.' . $childAttribute . '=f.' . $primaryKeyName
            . 'WHERE tt.' . $db->quoteColumnName(static::parentAttribute) . '=?', [$primaryKey]
        );
        return $cmd->execute();
    }

}

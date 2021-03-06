<?php

namespace common\models;

use backend\components\ClosureTableQuery;

/**
 * This is the model class for table "tbl_model".
 *
 * @property integer $id
 * @property string $auth_item_name
 * @property string $label
 * @property string $label_plural
 * @property string $help_html
 *
 * @property Column[] $columns
 * @property ModelTree[] $modelTrees
 */
class Model extends \common\components\ActiveRecord
{
	use \backend\components\ClosureTableActiveRecordTrait;

	const closureTableName = 'tbl_model_tree';
    const childAttribute = 'child';
    const parentAttribute = 'parent';
    const depthAttribute = 'depth';
 	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auth_item_name'], 'required'],
            [['help_html'], 'string'],
            [['auth_item_name', 'label', 'label_plural'], 'string', 'max' => 64],
            [['auth_item_name'], 'unique']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColumns()
    {
        return $this->hasMany(Column::className(), ['model_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModelTrees()
    {
        return $this->hasMany(ModelTree::className(), ['child' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModelTreeChilds()
    {
        return $this->hasMany(ModelTree::className(), ['child' => 'auth_item_name']);
}

}

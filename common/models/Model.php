<?php

namespace common\models;

/**
 * This is the model class for table "tbl_model".
 *
 * @property string $id
 * @property string $auth_item_name
 * @property string $label
 * @property string $label_plural
 * @property string $help
 *
 * @property Column[] $columns
 * @property AuthItem $authItemName
 * @property Navigation[] $navigations
 */
class Model extends \common\components\ActiveRecord
{
	use \vendor\aidask\ClosureTableActiveRecordTrait\ClosureTableActiveRecordTrait;

	const closureTableName = 'tbl_navigation';
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
            [['help'], 'string'],
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
    public function getAuthItemName()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'auth_item_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNavigations()
    {
        return $this->hasMany(Navigation::className(), ['child' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNavigationChilds()
    {
        return $this->hasMany(Navigation::className(), ['child' => 'auth_item_name']);
}
}
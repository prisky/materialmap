<?php

namespace common\models;

/**
 * This is the model class for table "tbl_field_set_to_item_group".
 *
 * @property string $id
 * @property string $account_id
 * @property string $field_set_id
 * @property string $item_group_id
 * @property integer $deleted
 *
 * @property Account $account
 * @property FieldSet $fieldSet
 * @property ItemGroup $itemGroup
 */
class FieldSetToItemGroup extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_field_set_to_item_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'field_set_id', 'item_group_id'], 'required'],
            [['account_id', 'field_set_id', 'item_group_id'], 'integer']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldSet()
    {
        return $this->hasOne(FieldSet::className(), ['id' => 'field_set_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemGroup()
    {
        return $this->hasOne(ItemGroup::className(), ['id' => 'item_group_id']);
    }
}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_summary_to_item".
 *
 * @property string $id
 * @property string $account_id
 * @property string $summary_id
 * @property string $field_set_id
 * @property string $item_group_id
 * @property string $item_id
 * @property string $amount
 * @property integer $quantity
 *
 * @property Summary $account
 * @property Item $item
 * @property ItemGroup $itemGroup
 * @property FieldSetToItemGroup $fieldSet
 */
class SummaryToItem extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_summary_to_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'summary_id', 'field_set_id', 'item_group_id', 'item_id'], 'required'],
            [['account_id', 'summary_id', 'field_set_id', 'item_group_id', 'item_id', 'quantity'], 'integer'],
            [['amount'], 'number']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Summary::className(), ['account_id' => 'account_id', 'id' => 'summary_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id', 'account_id' => 'account_id', 'item_group_id' => 'item_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemGroup()
    {
        return $this->hasOne(ItemGroup::className(), ['id' => 'item_group_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldSet()
    {
        return $this->hasOne(FieldSetToItemGroup::className(), ['field_set_id' => 'field_set_id', 'account_id' => 'account_id', 'item_group_id' => 'item_group_id']);
    }
}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_summary_to_item".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $summary_id
 * @property integer $field_set_id
 * @property integer $item_group_id
 * @property integer $item_id
 * @property integer $level_id
 * @property string $amount
 * @property integer $quantity
 *
 * @property Account $account
 * @property Item $item
 * @property Summary $summary
 * @property ItemGroup $itemGroup
 * @property SummaryLevel $level
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
            [['account_id', 'summary_id', 'field_set_id', 'item_group_id', 'item_id', 'level_id', 'amount', 'quantity'], 'required'],
            [['account_id', 'summary_id', 'field_set_id', 'item_group_id', 'item_id', 'level_id', 'quantity'], 'integer'],
            [['amount'], 'number']
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
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummary()
    {
        return $this->hasOne(Summary::className(), ['id' => 'summary_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemGroup()
    {
        return $this->hasOne(ItemGroup::className(), ['id' => 'item_group_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(SummaryLevel::className(), ['id' => 'level_id']);
    }

}

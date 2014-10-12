<?php

namespace common\models;

/**
 * This is the model class for table "tbl_item_group".
 *
 * @property integer $id
 * @property integer $account_id
 * @property string $name
 * @property integer $deleted
 *
 * @property FieldSetToItemGroup[] $fieldSetToItemGroups
 * @property Item[] $items
 * @property Account $account
 * @property SummaryToItem[] $summaryToItems
 */
class ItemGroup extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_item_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'name'], 'required'],
            [['account_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['account_id', 'name'], 'unique', 'targetAttribute' => ['account_id', 'name'], 'message' => 'The combination of Account and Name has already been taken.']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldSetToItemGroups()
    {
        return $this->hasMany(FieldSetToItemGroup::className(), ['item_group_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['item_group_id' => 'id']);
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
    public function getSummaryToItems()
    {
        return $this->hasMany(SummaryToItem::className(), ['item_group_id' => 'id']);
    }

}

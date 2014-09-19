<?php

namespace common\models;

/**
 * This is the model class for table "tbl_item".
 *
 * @property string $id
 * @property string $account_id
 * @property string $item_group_id
 * @property string $name
 * @property string $amount
 * @property integer $deleted
 *
 * @property BookingToItem[] $bookingToItems
 * @property ItemGroup $itemGroup
 * @property ItemInventory[] $itemInventories
 * @property SummaryToItem[] $summaryToItems
 * @property TicketToItem[] $ticketToItems
 * @property TicketToSeatToItem[] $ticketToSeatToItems
 */
class Item extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'item_group_id', 'name'], 'required'],
            [['account_id', 'item_group_id'], 'integer'],
            [['amount'], 'number'],
            [['name'], 'string', 'max' => 64],
            [['item_group_id', 'name'], 'unique', 'targetAttribute' => ['item_group_id', 'name'], 'message' => 'The combination of Item group and Name has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingToItems()
    {
        return $this->hasMany(BookingToItem::className(), ['item_id' => 'id']);
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
    public function getItemInventories()
    {
        return $this->hasMany(ItemInventory::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToItems()
    {
        return $this->hasMany(SummaryToItem::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToItems()
    {
        return $this->hasMany(TicketToItem::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToItems()
    {
        return $this->hasMany(TicketToSeatToItem::className(), ['item_id' => 'id']);
    }
}

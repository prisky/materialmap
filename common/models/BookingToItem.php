<?php

namespace common\models;

/**
 * This is the model class for table "tbl_booking_to_item".
 *
 * @property string $id
 * @property string $account_id
 * @property string $booking_id
 * @property string $event_type_id
 * @property string $item_id
 * @property string $field_set_id
 * @property string $item_group_id
 * @property integer $level_id
 * @property string $amount
 * @property integer $quantity
 *
 * @property Account $account
 * @property Item $item
 * @property Booking $booking
 * @property BookingLevel $level
 */
class BookingToItem extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_booking_to_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'booking_id', 'event_type_id', 'item_id', 'field_set_id', 'item_group_id', 'level_id', 'amount', 'quantity'], 'required'],
            [['account_id', 'booking_id', 'event_type_id', 'item_id', 'field_set_id', 'item_group_id', 'level_id', 'quantity'], 'integer'],
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
    public function getBooking()
    {
        return $this->hasOne(Booking::className(), ['id' => 'booking_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(BookingLevel::className(), ['id' => 'level_id']);
    }
}

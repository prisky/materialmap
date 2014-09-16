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
 * @property string $amount
 * @property integer $quantity
 *
 * @property Account $account
 * @property Item $item
 * @property Booking $booking
 * @property EventTypeToFieldSet $eventType
 * @property FieldSetToItemGroup $fieldSet
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
            [['account_id', 'booking_id', 'event_type_id', 'item_id', 'field_set_id', 'item_group_id'], 'required'],
            [['account_id', 'booking_id', 'event_type_id', 'item_id', 'field_set_id', 'item_group_id', 'quantity'], 'integer'],
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
        return $this->hasOne(Item::className(), ['id' => 'item_id', 'account_id' => 'account_id', 'item_group_id' => 'item_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooking()
    {
        return $this->hasOne(Booking::className(), ['id' => 'booking_id', 'account_id' => 'account_id', 'event_type_id' => 'event_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventType()
    {
        return $this->hasOne(EventTypeToFieldSet::className(), ['event_type_id' => 'event_type_id', 'account_id' => 'account_id', 'field_set_id' => 'field_set_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldSet()
    {
        return $this->hasOne(FieldSetToItemGroup::className(), ['field_set_id' => 'field_set_id', 'account_id' => 'account_id', 'item_group_id' => 'item_group_id']);
    }
}

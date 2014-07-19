<?php

namespace common\models;

/**
 * This is the model class for table "tbl_booking_to_event_to_resource_to_extra".
 *
 * @property string $id
 * @property string $account_id
 * @property string $event_to_resource_to_extra_id
 * @property string $booking_id
 * @property string $amount
 * @property integer $quantity
 *
 * @property EventToResourceToExtra $eventToResourceToExtra
 * @property Booking $booking
 * @property Account $account
 */
class BookingToEventToResourceToExtra extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_booking_to_event_to_resource_to_extra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'event_to_resource_to_extra_id', 'booking_id'], 'required'],
            [['account_id', 'event_to_resource_to_extra_id', 'booking_id', 'quantity'], 'integer'],
            [['amount'], 'number'],
            [['event_to_resource_to_extra_id', 'booking_id'], 'unique', 'targetAttribute' => ['event_to_resource_to_extra_id', 'booking_id'], 'message' => 'The combination of Extra and Booking has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventToResourceToExtra()
    {
        return $this->hasOne(EventToResourceToExtra::className(), ['id' => 'event_to_resource_to_extra_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooking()
    {
        return $this->hasOne(Booking::className(), ['id' => 'booking_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

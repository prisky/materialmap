<?php

namespace common\models;

/**
 * This is the model class for table "tbl_booking_to_charge".
 *
 * @property string $id
 * @property string $account_id
 * @property string $booking_id
 * @property string $charge_id
 *
 * @property Booking $booking
 * @property Charge $charge
 * @property Account $account
 */
class BookingToCharge extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_booking_to_charge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'booking_id', 'charge_id'], 'required'],
            [['account_id', 'booking_id', 'charge_id'], 'integer'],
            [['booking_id', 'charge_id'], 'unique', 'targetAttribute' => ['booking_id', 'charge_id'], 'message' => 'The combination of Booking and Charge has already been taken.']
        ];
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
    public function getCharge()
    {
        return $this->hasOne(Charge::className(), ['id' => 'charge_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

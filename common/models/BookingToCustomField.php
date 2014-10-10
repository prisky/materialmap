<?php

namespace common\models;

/**
 * This is the model class for table "tbl_booking_to_custom_field".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $booking_id
 * @property integer $event_type_id
 * @property integer $field_set_id
 * @property integer $custom_field_id
 * @property integer $level_id
 * @property string $custom_value
 *
 * @property Booking $booking
 * @property Account $account
 * @property BookingLevel $level
 */
class BookingToCustomField extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_booking_to_custom_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'booking_id', 'event_type_id', 'field_set_id', 'custom_field_id', 'level_id'], 'required'],
            [['account_id', 'booking_id', 'event_type_id', 'field_set_id', 'custom_field_id', 'level_id'], 'integer'],
            [['custom_value'], 'string', 'max' => 255],
            [['booking_id', 'custom_field_id'], 'unique', 'targetAttribute' => ['booking_id', 'custom_field_id'], 'message' => 'The combination of Booking and Custom field has already been taken.']
        ];
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
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(BookingLevel::className(), ['id' => 'level_id']);
    }
}

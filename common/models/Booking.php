<?php

namespace common\models;

/**
 * This is the model class for table "tbl_booking".
 *
 * @property string $id
 * @property string $account_id
 * @property string $event_id
 * @property string $summary_id
 * @property string $status
 *
 * @property Summary $summary
 * @property Event $event
 * @property Account $account
 * @property BookingToCharge[] $bookingToCharges
 * @property BookingToEventToResourceToCustomField[] $bookingToEventToResourceToCustomFields
 * @property BookingToEventToResourceToExtra[] $bookingToEventToResourceToExtras
 * @property SurveyResultToBooking[] $surveyResultToBookings
 * @property Ticket[] $tickets
 */
class Booking extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_booking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'event_id', 'summary_id', 'status'], 'required'],
            [['account_id', 'event_id', 'summary_id'], 'integer'],
            [['status'], 'string'],
            [['event_id', 'summary_id'], 'unique', 'targetAttribute' => ['event_id', 'summary_id'], 'message' => 'The combination of Event and Summary has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummary()
    {
        return $this->hasOne(Summary::className(), ['id' => 'summary_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id', 'account_id' => 'account_id']);
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
    public function getBookingToCharges()
    {
        return $this->hasMany(BookingToCharge::className(), ['booking_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingToEventToResourceToCustomFields()
    {
        return $this->hasMany(BookingToEventToResourceToCustomField::className(), ['booking_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingToEventToResourceToExtras()
    {
        return $this->hasMany(BookingToEventToResourceToExtra::className(), ['booking_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToBookings()
    {
        return $this->hasMany(SurveyResultToBooking::className(), ['booking_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['booking_id' => 'id', 'account_id' => 'account_id']);
    }
}

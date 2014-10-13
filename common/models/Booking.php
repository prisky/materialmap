<?php

namespace common\models;

/**
 * This is the model class for table "tbl_booking".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $event_id
 * @property integer $event_type_id
 * @property integer $summary_id
 * @property string $status
 *
 * @property Summary $summary
 * @property Account $account
 * @property Event $event
 * @property BookingToCharge[] $bookingToCharges
 * @property BookingToCustomField[] $bookingToCustomFields
 * @property BookingToItem[] $bookingToItems
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
            [['account_id', 'event_id', 'event_type_id', 'summary_id', 'status'], 'required'],
            [['account_id', 'event_id', 'event_type_id', 'summary_id'], 'integer'],
            [['status'], 'string'],
            [['event_id', 'summary_id'], 'unique', 'targetAttribute' => ['event_id', 'summary_id'], 'message' => 'The combination of Event and Summary has already been taken.']
        ];
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
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingToCharges()
    {
        return $this->hasMany(BookingToCharge::className(), ['booking_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingToCustomFields()
    {
        return $this->hasMany(BookingToCustomField::className(), ['booking_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingToItems()
    {
        return $this->hasMany(BookingToItem::className(), ['booking_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['booking_id' => 'id']);
    }

}

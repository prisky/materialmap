<?php

namespace common\models;

/**
 * This is the model class for table "tbl_ticket".
 *
 * @property string $id
 * @property string $account_id
 * @property string $booking_id
 * @property string $ticket_type_id
 * @property string $amount
 *
 * @property EventTypeToResourceTypeToExtraToTicket[] $eventTypeToResourceTypeToExtraToTickets
 * @property SurveyResultToTicket[] $surveyResultToTickets
 * @property TicketType $ticketType
 * @property Booking $booking
 * @property Account $account
 * @property TicketToCharge[] $ticketToCharges
 * @property TicketToEventTypeToResourceTypeToCustomField[] $ticketToEventTypeToResourceTypeToCustomFields
 * @property TicketToSeat[] $ticketToSeats
 */
class Ticket extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ticket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'booking_id', 'ticket_type_id'], 'required'],
            [['account_id', 'booking_id', 'ticket_type_id'], 'integer'],
            [['amount'], 'number'],
            [['booking_id', 'ticket_type_id'], 'unique', 'targetAttribute' => ['booking_id', 'ticket_type_id'], 'message' => 'The combination of Booking and Ticket type has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTypeToResourceTypeToExtraToTickets()
    {
        return $this->hasMany(EventTypeToResourceTypeToExtraToTicket::className(), ['ticket_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToTickets()
    {
        return $this->hasMany(SurveyResultToTicket::className(), ['ticket_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketType()
    {
        return $this->hasOne(TicketType::className(), ['id' => 'ticket_type_id', 'account_id' => 'account_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToCharges()
    {
        return $this->hasMany(TicketToCharge::className(), ['ticket_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToEventTypeToResourceTypeToCustomFields()
    {
        return $this->hasMany(TicketToEventTypeToResourceTypeToCustomField::className(), ['ticket_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeats()
    {
        return $this->hasMany(TicketToSeat::className(), ['ticket_id' => 'id', 'account_id' => 'account_id']);
    }
}

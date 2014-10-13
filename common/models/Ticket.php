<?php

namespace common\models;

/**
 * This is the model class for table "tbl_ticket".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $booking_id
 * @property integer $ticket_type_id
 * @property integer $event_type_id
 * @property string $amount
 *
 * @property SurveyResultToTicket[] $surveyResultToTickets
 * @property TicketType $ticketType
 * @property Booking $booking
 * @property Account $account
 * @property TicketToCharge[] $ticketToCharges
 * @property TicketToCustomField[] $ticketToCustomFields
 * @property TicketToItem[] $ticketToItems
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
            [['account_id', 'booking_id', 'ticket_type_id', 'event_type_id', 'amount'], 'required'],
            [['account_id', 'booking_id', 'ticket_type_id', 'event_type_id'], 'integer'],
            [['amount'], 'number'],
            [['booking_id', 'ticket_type_id'], 'unique', 'targetAttribute' => ['booking_id', 'ticket_type_id'], 'message' => 'The combination of Booking and Ticket type has already been taken.']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToTickets()
    {
        return $this->hasMany(SurveyResultToTicket::className(), ['ticket_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketType()
    {
        return $this->hasOne(TicketType::className(), ['id' => 'ticket_type_id']);
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
    public function getTicketToCharges()
    {
        return $this->hasMany(TicketToCharge::className(), ['ticket_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToCustomFields()
    {
        return $this->hasMany(TicketToCustomField::className(), ['ticket_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToItems()
    {
        return $this->hasMany(TicketToItem::className(), ['ticket_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeats()
    {
        return $this->hasMany(TicketToSeat::className(), ['ticket_id' => 'id']);
    }

}

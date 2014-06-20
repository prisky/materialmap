<?php

namespace common\models;

/**
 * This is the model class for table "tbl_ticket_to_seat".
 *
 * @property string $id
 * @property string $account_id
 * @property string $ticket_id
 * @property string $seat_id
 *
 * @property EventToResourceToExtraToTicketToSeat[] $eventToResourceToExtraToTicketToSeats
 * @property SurveyResultToTicketToSeat[] $surveyResultToTicketToSeats
 * @property Ticket $ticket
 * @property Seat $seat
 * @property Account $account
 * @property TicketToSeatToCharge[] $ticketToSeatToCharges
 * @property TicketToSeatToContact[] $ticketToSeatToContacts
 * @property TicketToSeatToEventToResourceToCustomField[] $ticketToSeatToEventToResourceToCustomFields
 */
class TicketToSeat extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ticket_to_seat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'ticket_id', 'seat_id'], 'required'],
            [['account_id', 'ticket_id', 'seat_id'], 'integer'],
            [['ticket_id', 'seat_id'], 'unique', 'targetAttribute' => ['ticket_id', 'seat_id'], 'message' => 'The combination of Ticket and Seat has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventToResourceToExtraToTicketToSeats()
    {
        return $this->hasMany(EventToResourceToExtraToTicketToSeat::className(), ['ticket_to_seat_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToTicketToSeats()
    {
        return $this->hasMany(SurveyResultToTicketToSeat::className(), ['ticket_to_seat_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeat()
    {
        return $this->hasOne(Seat::className(), ['id' => 'seat_id', 'account_id' => 'account_id']);
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
    public function getTicketToSeatToCharges()
    {
        return $this->hasMany(TicketToSeatToCharge::className(), ['ticket_to_seat_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToContacts()
    {
        return $this->hasMany(TicketToSeatToContact::className(), ['account_id' => 'account_id', 'ticket_to_seat_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToEventToResourceToCustomFields()
    {
        return $this->hasMany(TicketToSeatToEventToResourceToCustomField::className(), ['ticket_to_seat_id' => 'id', 'account_id' => 'account_id']);
    }
}

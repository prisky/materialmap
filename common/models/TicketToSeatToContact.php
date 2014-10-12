<?php

namespace common\models;

/**
 * This is the model class for table "tbl_ticket_to_seat_to_contact".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $ticket_to_seat_id
 * @property integer $contact_id
 *
 * @property TicketToSeat $ticketToSeat
 * @property Contact $contact
 * @property Account $account
 * @property TicketToSeatToContactToSms[] $ticketToSeatToContactToSms
 */
class TicketToSeatToContact extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ticket_to_seat_to_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'ticket_to_seat_id', 'contact_id'], 'required'],
            [['account_id', 'ticket_to_seat_id', 'contact_id'], 'integer'],
            [['ticket_to_seat_id', 'contact_id'], 'unique', 'targetAttribute' => ['ticket_to_seat_id', 'contact_id'], 'message' => 'The combination of Seat and Contact has already been taken.']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeat()
    {
        return $this->hasOne(TicketToSeat::className(), ['id' => 'ticket_to_seat_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Contact::className(), ['id' => 'contact_id']);
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
    public function getTicketToSeatToContactToSms()
    {
        return $this->hasMany(TicketToSeatToContactToSms::className(), ['ticket_to_seat_to_contact_id' => 'id']);
    }

}

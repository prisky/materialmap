<?php

namespace common\models;

/**
 * This is the model class for table "tbl_seat_to_ticket_type".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $seat_id
 * @property integer $ticket_type_id
 * @property integer $deleted
 *
 * @property TicketType $ticketType
 * @property Seat $seat
 * @property Account $account
 */
class SeatToTicketType extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_seat_to_ticket_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'seat_id', 'ticket_type_id'], 'required'],
            [['account_id', 'seat_id', 'ticket_type_id'], 'integer'],
            [['ticket_type_id', 'seat_id'], 'unique', 'targetAttribute' => ['ticket_type_id', 'seat_id'], 'message' => 'The combination of Seat and Ticket type has already been taken.']
        ];
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
    public function getSeat()
    {
        return $this->hasOne(Seat::className(), ['id' => 'seat_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

}

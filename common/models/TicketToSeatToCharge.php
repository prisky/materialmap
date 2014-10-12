<?php

namespace common\models;

/**
 * This is the model class for table "tbl_ticket_to_seat_to_charge".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $ticket_to_seat_id
 * @property integer $charge_id
 *
 * @property TicketToSeat $ticketToSeat
 * @property Charge $charge
 * @property Account $account
 */
class TicketToSeatToCharge extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ticket_to_seat_to_charge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'ticket_to_seat_id', 'charge_id'], 'required'],
            [['account_id', 'ticket_to_seat_id', 'charge_id'], 'integer'],
            [['ticket_to_seat_id', 'charge_id'], 'unique', 'targetAttribute' => ['ticket_to_seat_id', 'charge_id'], 'message' => 'The combination of Seat and Charge has already been taken.']
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
    public function getCharge()
    {
        return $this->hasOne(Charge::className(), ['id' => 'charge_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_ticket_to_charge".
 *
 * @property string $id
 * @property string $account_id
 * @property string $ticket_id
 * @property string $charge_id
 *
 * @property Ticket $ticket
 * @property Charge $charge
 * @property Account $account
 */
class TicketToCharge extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ticket_to_charge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'ticket_id', 'charge_id'], 'required'],
            [['account_id', 'ticket_id', 'charge_id'], 'integer'],
            [['charge_id'], 'unique'],
            [['ticket_id'], 'unique']
        ];
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

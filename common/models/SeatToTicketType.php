<?php

namespace common\models;

/**
 * This is the model class for table "tbl_seat_to_ticket_type".
 *
 * @property string $id
 * @property string $account_id
 * @property string $seat_id
 * @property string $ticket_type_id
 * @property integer $deleted
 *
 * @property Account $account
 * @property Seat $seat
 * @property TicketType $ticketType
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
            [['ticket_type_id', 'seat_id'], 'unique', 'targetAttribute' => ['ticket_type_id', 'seat_id'], 'message' => 'The combination of  and  has already been taken.']
        ];
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
    public function getSeat()
    {
        return $this->hasOne(Seat::className(), ['id' => 'seat_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketType()
    {
        return $this->hasOne(TicketType::className(), ['id' => 'ticket_type_id', 'account_id' => 'account_id']);
    }
}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_ticket_type".
 *
 * @property string $id
 * @property string $account_id
 * @property integer $seats
 * @property string $name
 * @property string $amount
 * @property string $comment
 * @property integer $event_max
 * @property integer $booking_max
 * @property integer $deleted
 *
 * @property EventDetailToTicketType[] $eventDetailToTicketTypes
 * @property SeatToTicketType[] $seatToTicketTypes
 * @property Ticket[] $tickets
 * @property Account $account
 */
class TicketType extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ticket_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'seats'], 'required'],
            [['account_id', 'seats', 'event_max', 'booking_max'], 'integer'],
            [['amount'], 'number'],
            [['comment'], 'string'],
            [['account_id', 'name'], 'unique', 'targetAttribute' => ['account_id', 'name'], 'message' => 'The combination of Account and  has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventDetailToTicketTypes()
    {
        return $this->hasMany(EventDetailToTicketType::className(), ['ticket_type_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeatToTicketTypes()
    {
        return $this->hasMany(SeatToTicketType::className(), ['ticket_type_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['ticket_type_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

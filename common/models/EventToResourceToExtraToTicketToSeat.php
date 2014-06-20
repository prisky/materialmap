<?php

namespace common\models;

/**
 * This is the model class for table "tbl_event_to_resource_to_extra_to_ticket_to_seat".
 *
 * @property string $id
 * @property string $account_id
 * @property string $event_to_resource_to_extra_id
 * @property string $ticket_to_seat_id
 * @property string $amount
 * @property integer $quantity
 *
 * @property EventToResourceToExtra $eventToResourceToExtra
 * @property TicketToSeat $ticketToSeat
 * @property Account $account
 */
class EventToResourceToExtraToTicketToSeat extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_event_to_resource_to_extra_to_ticket_to_seat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'event_to_resource_to_extra_id', 'ticket_to_seat_id'], 'required'],
            [['account_id', 'event_to_resource_to_extra_id', 'ticket_to_seat_id', 'quantity'], 'integer'],
            [['amount'], 'number'],
            [['event_to_resource_to_extra_id', 'ticket_to_seat_id'], 'unique', 'targetAttribute' => ['event_to_resource_to_extra_id', 'ticket_to_seat_id'], 'message' => 'The combination of Extra and Seat has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventToResourceToExtra()
    {
        return $this->hasOne(EventToResourceToExtra::className(), ['id' => 'event_to_resource_to_extra_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeat()
    {
        return $this->hasOne(TicketToSeat::className(), ['id' => 'ticket_to_seat_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

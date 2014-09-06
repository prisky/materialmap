<?php

namespace common\models;

/**
 * This is the model class for table "tbl_event_type_to_ticket_type".
 *
 * @property string $id
 * @property string $account_id
 * @property string $event_type_id
 * @property string $ticket_type_id
 *
 * @property EventType $eventType
 * @property TicketType $ticketType
 * @property Account $account
 */
class EventTypeToTicketType extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_event_type_to_ticket_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'event_type_id', 'ticket_type_id'], 'required'],
            [['account_id', 'event_type_id', 'ticket_type_id'], 'integer'],
            [['event_type_id', 'ticket_type_id'], 'unique', 'targetAttribute' => ['event_type_id', 'ticket_type_id'], 'message' => 'The combination of Event type and Ticket type has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventType()
    {
        return $this->hasOne(EventType::className(), ['id' => 'event_type_id', 'account_id' => 'account_id']);
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
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

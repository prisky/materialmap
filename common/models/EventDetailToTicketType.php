<?php

namespace common\models;

/**
 * This is the model class for table "tbl_event_detail_to_ticket_type".
 *
 * @property string $id
 * @property string $account_id
 * @property string $event_detail_id
 * @property string $ticket_type_id
 *
 * @property Account $account
 * @property EventDetail $eventDetail
 * @property TicketType $ticketType
 */
class EventDetailToTicketType extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_event_detail_to_ticket_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'event_detail_id', 'ticket_type_id'], 'required'],
            [['account_id', 'event_detail_id', 'ticket_type_id'], 'integer'],
            [['event_detail_id', 'ticket_type_id'], 'unique', 'targetAttribute' => ['event_detail_id', 'ticket_type_id'], 'message' => 'The combination of Event detail and Ticket type has already been taken.']
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
    public function getEventDetail()
    {
        return $this->hasOne(EventDetail::className(), ['id' => 'event_detail_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketType()
    {
        return $this->hasOne(TicketType::className(), ['id' => 'ticket_type_id', 'account_id' => 'account_id']);
    }
}

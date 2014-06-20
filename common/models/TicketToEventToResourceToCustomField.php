<?php

namespace common\models;

/**
 * This is the model class for table "tbl_ticket_to_event_to_resource_to_custom_field".
 *
 * @property string $id
 * @property string $account_id
 * @property string $ticket_id
 * @property string $event_to_resource_to_custom_field_id
 * @property string $custom_value
 *
 * @property Ticket $ticket
 * @property EventToResourceToCustomField $eventToResourceToCustomField
 * @property Account $account
 */
class TicketToEventToResourceToCustomField extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ticket_to_event_to_resource_to_custom_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'ticket_id', 'event_to_resource_to_custom_field_id'], 'required'],
            [['account_id', 'ticket_id', 'event_to_resource_to_custom_field_id'], 'integer'],
            [['custom_value'], 'string', 'max' => 255],
            [['ticket_id', 'event_to_resource_to_custom_field_id'], 'unique', 'targetAttribute' => ['ticket_id', 'event_to_resource_to_custom_field_id'], 'message' => 'The combination of Ticket and Custom field has already been taken.']
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
    public function getEventToResourceToCustomField()
    {
        return $this->hasOne(EventToResourceToCustomField::className(), ['id' => 'event_to_resource_to_custom_field_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

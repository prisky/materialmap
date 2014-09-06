<?php

namespace common\models;

/**
 * This is the model class for table "tbl_ticket_to_seat_to_event_type_to_resource_type_to_custom_fie".
 *
 * @property string $id
 * @property string $account_id
 * @property string $ticket_to_seat_id
 * @property string $event_type_to_resource_type_to_custom_field_id
 * @property string $custom_value
 *
 * @property Account $account
 * @property EventTypeToResourceTypeToCustomField $eventTypeToResourceTypeToCustomField
 * @property TicketToSeat $ticketToSeat
 */
class TicketToSeatToEventTypeToResourceTypeToCustomField extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ticket_to_seat_to_event_type_to_resource_type_to_custom_fie';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ticket_to_seat_id', 'event_type_to_resource_type_to_custom_field_id'], 'unique', 'targetAttribute' => ['ticket_to_seat_id', 'event_type_to_resource_type_to_custom_field_id'], 'message' => 'The combination of  and  has already been taken.']
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
    public function getEventTypeToResourceTypeToCustomField()
    {
        return $this->hasOne(EventTypeToResourceTypeToCustomField::className(), ['id' => 'event_type_to_resource_type_to_custom_field_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeat()
    {
        return $this->hasOne(TicketToSeat::className(), ['id' => 'ticket_to_seat_id', 'account_id' => 'account_id']);
    }
}

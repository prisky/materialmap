<?php

namespace common\models;

/**
 * This is the model class for table "tbl_ticket_to_seat_to_custom_field".
 *
 * @property string $id
 * @property string $account_id
 * @property string $ticket_to_seat_id
 * @property string $event_type_id
 * @property string $field_set_id
 * @property string $custom_field_id
 * @property string $custom_value
 *
 * @property TicketToSeat $ticketToSeat
 * @property FieldSetToCustomField $fieldSet
 * @property Account $account
 * @property EventTypeToFieldSet $eventType
 */
class TicketToSeatToCustomField extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ticket_to_seat_to_custom_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'ticket_to_seat_id', 'event_type_id', 'field_set_id', 'custom_field_id'], 'required'],
            [['account_id', 'ticket_to_seat_id', 'event_type_id', 'field_set_id', 'custom_field_id'], 'integer'],
            [['custom_value'], 'string', 'max' => 255],
            [['ticket_to_seat_id', 'event_type_id'], 'unique', 'targetAttribute' => ['ticket_to_seat_id', 'event_type_id'], 'message' => 'The combination of Seat and Event type has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeat()
    {
        return $this->hasOne(TicketToSeat::className(), ['id' => 'ticket_to_seat_id', 'account_id' => 'account_id', 'event_type_id' => 'event_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldSet()
    {
        return $this->hasOne(FieldSetToCustomField::className(), ['field_set_id' => 'field_set_id', 'custom_field_id' => 'custom_field_id', 'account_id' => 'account_id']);
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
    public function getEventType()
    {
        return $this->hasOne(EventTypeToFieldSet::className(), ['event_type_id' => 'event_type_id', 'account_id' => 'account_id', 'field_set_id' => 'field_set_id']);
    }
}

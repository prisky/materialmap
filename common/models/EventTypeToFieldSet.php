<?php

namespace common\models;

/**
 * This is the model class for table "tbl_event_type_to_field_set".
 *
 * @property string $id
 * @property string $account_id
 * @property string $event_type_id
 * @property string $field_set_id
 * @property integer $deleted
 *
 * @property BookingToCustomField[] $bookingToCustomFields
 * @property BookingToItem[] $bookingToItems
 * @property Account $account
 * @property EventType $eventType
 * @property FieldSet $fieldSet
 * @property TicketToCustomField[] $ticketToCustomFields
 * @property TicketToItem[] $ticketToItems
 * @property TicketToSeatToCustomField[] $ticketToSeatToCustomFields
 * @property TicketToSeatToItem[] $ticketToSeatToItems
 */
class EventTypeToFieldSet extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_event_type_to_field_set';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'event_type_id', 'field_set_id'], 'required'],
            [['account_id', 'event_type_id', 'field_set_id'], 'integer']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingToCustomFields()
    {
        return $this->hasMany(BookingToCustomField::className(), ['event_type_id' => 'event_type_id', 'account_id' => 'account_id', 'field_set_id' => 'field_set_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingToItems()
    {
        return $this->hasMany(BookingToItem::className(), ['event_type_id' => 'event_type_id', 'account_id' => 'account_id', 'field_set_id' => 'field_set_id']);
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
        return $this->hasOne(EventType::className(), ['id' => 'event_type_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldSet()
    {
        return $this->hasOne(FieldSet::className(), ['id' => 'field_set_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToCustomFields()
    {
        return $this->hasMany(TicketToCustomField::className(), ['event_type_id' => 'event_type_id', 'account_id' => 'account_id', 'field_set_id' => 'field_set_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToItems()
    {
        return $this->hasMany(TicketToItem::className(), ['event_type_id' => 'event_type_id', 'account_id' => 'account_id', 'field_set_id' => 'field_set_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToCustomFields()
    {
        return $this->hasMany(TicketToSeatToCustomField::className(), ['event_type_id' => 'event_type_id', 'account_id' => 'account_id', 'field_set_id' => 'field_set_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToItems()
    {
        return $this->hasMany(TicketToSeatToItem::className(), ['event_type_id' => 'event_type_id', 'account_id' => 'account_id', 'field_set_id' => 'field_set_id']);
    }
}

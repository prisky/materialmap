<?php

namespace common\models;

/**
 * This is the model class for table "tbl_event_to_resource_to_custom_field".
 *
 * @property string $id
 * @property string $account_id
 * @property string $event_id
 * @property string $resource_to_custom_field_id
 *
 * @property BookingToEventToResourceToCustomField[] $bookingToEventToResourceToCustomFields
 * @property Event $event
 * @property ResourceToCustomField $resourceToCustomField
 * @property SummaryToEventToResourceToCustomField[] $summaryToEventToResourceToCustomFields
 * @property TicketToEventToResourceToCustomField[] $ticketToEventToResourceToCustomFields
 * @property TicketToSeatToEventToResourceToCustomField[] $ticketToSeatToEventToResourceToCustomFields
 */
class EventToResourceToCustomField extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_event_to_resource_to_custom_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'event_id', 'resource_to_custom_field_id'], 'required'],
            [['account_id', 'event_id', 'resource_to_custom_field_id'], 'integer'],
            [['event_id', 'resource_to_custom_field_id'], 'unique', 'targetAttribute' => ['event_id', 'resource_to_custom_field_id'], 'message' => 'The combination of Event and Custom field has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingToEventToResourceToCustomFields()
    {
        return $this->hasMany(BookingToEventToResourceToCustomField::className(), ['event_to_resource_to_custom_field_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceToCustomField()
    {
        return $this->hasOne(ResourceToCustomField::className(), ['id' => 'resource_to_custom_field_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToEventToResourceToCustomFields()
    {
        return $this->hasMany(SummaryToEventToResourceToCustomField::className(), ['event_to_resource_to_custom_field_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToEventToResourceToCustomFields()
    {
        return $this->hasMany(TicketToEventToResourceToCustomField::className(), ['event_to_resource_to_custom_field_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToEventToResourceToCustomFields()
    {
        return $this->hasMany(TicketToSeatToEventToResourceToCustomField::className(), ['event_to_resource_to_custom_field_id' => 'id', 'account_id' => 'account_id']);
    }
}

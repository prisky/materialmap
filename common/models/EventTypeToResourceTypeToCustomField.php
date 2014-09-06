<?php

namespace common\models;

/**
 * This is the model class for table "tbl_event_type_to_resource_type_to_custom_field".
 *
 * @property string $id
 * @property string $account_id
 * @property string $event_type_id
 * @property string $resource_type_to_custom_field_id
 *
 * @property BookingToEventTypeToResourceTypeToCustomField[] $bookingToEventTypeToResourceTypeToCustomFields
 * @property EventType $account
 * @property ResourceTypeToCustomField $resourceTypeToCustomField
 * @property SummaryToEventTypeToResourceToCustomField[] $summaryToEventTypeToResourceToCustomFields
 * @property TicketToEventTypeToResourceTypeToCustomField[] $ticketToEventTypeToResourceTypeToCustomFields
 * @property TicketToSeatToEventTypeToResourceTypeToCustomFie[] $ticketToSeatToEventTypeToResourceTypeToCustomFies
 */
class EventTypeToResourceTypeToCustomField extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_event_type_to_resource_type_to_custom_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'event_type_id', 'resource_type_to_custom_field_id'], 'required'],
            [['account_id', 'event_type_id', 'resource_type_to_custom_field_id'], 'integer'],
            [['event_type_id', 'resource_type_to_custom_field_id'], 'unique', 'targetAttribute' => ['event_type_id', 'resource_type_to_custom_field_id'], 'message' => 'The combination of Event type and Custom field has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingToEventTypeToResourceTypeToCustomFields()
    {
        return $this->hasMany(BookingToEventTypeToResourceTypeToCustomField::className(), ['event_type_to_resource_type_to_custom_field_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(EventType::className(), ['account_id' => 'account_id', 'id' => 'event_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceTypeToCustomField()
    {
        return $this->hasOne(ResourceTypeToCustomField::className(), ['id' => 'resource_type_to_custom_field_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToEventTypeToResourceToCustomFields()
    {
        return $this->hasMany(SummaryToEventTypeToResourceToCustomField::className(), ['event_type_to_resource_to_custom_field_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToEventTypeToResourceTypeToCustomFields()
    {
        return $this->hasMany(TicketToEventTypeToResourceTypeToCustomField::className(), ['event_type_to_resource_type_to_custom_field_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToEventTypeToResourceTypeToCustomFies()
    {
        return $this->hasMany(TicketToSeatToEventTypeToResourceTypeToCustomFie::className(), ['event_type_to_resource_type_to_custom_field_id' => 'id', 'account_id' => 'account_id']);
    }
}

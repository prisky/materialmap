<?php

namespace common\models;

/**
 * This is the model class for table "tbl_event_type_to_resource_type_to_extra".
 *
 * @property string $id
 * @property string $account_id
 * @property string $event_type_id
 * @property string $resource_type_to_extra_id
 * @property integer $deleted
 *
 * @property BookingToEventTypeToResourceTypeToExtra[] $bookingToEventTypeToResourceTypeToExtras
 * @property Account $account
 * @property ResourceTypeToExtra $resourceTypeToExtra
 * @property EventTypeToResourceTypeToExtraToSummary[] $eventTypeToResourceTypeToExtraToSummaries
 * @property EventTypeToResourceTypeToExtraToTicket[] $eventTypeToResourceTypeToExtraToTickets
 * @property EventTypeToResourceTypeToExtraToTicketToSeat[] $eventTypeToResourceTypeToExtraToTicketToSeats
 */
class EventTypeToResourceTypeToExtra extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_event_type_to_resource_type_to_extra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'event_type_id', 'resource_type_to_extra_id'], 'required'],
            [['account_id', 'event_type_id', 'resource_type_to_extra_id'], 'integer'],
            [['event_type_id', 'resource_type_to_extra_id'], 'unique', 'targetAttribute' => ['event_type_id', 'resource_type_to_extra_id'], 'message' => 'The combination of Event type and Extra has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingToEventTypeToResourceTypeToExtras()
    {
        return $this->hasMany(BookingToEventTypeToResourceTypeToExtra::className(), ['event_type_to_resource_type_to_extra_id' => 'id', 'account_id' => 'account_id']);
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
    public function getResourceTypeToExtra()
    {
        return $this->hasOne(ResourceTypeToExtra::className(), ['id' => 'resource_type_to_extra_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTypeToResourceTypeToExtraToSummaries()
    {
        return $this->hasMany(EventTypeToResourceTypeToExtraToSummary::className(), ['account_id' => 'account_id', 'event_type_to_resource_type_to_extra_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTypeToResourceTypeToExtraToTickets()
    {
        return $this->hasMany(EventTypeToResourceTypeToExtraToTicket::className(), ['event_type_to_resource_type_to_extra_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTypeToResourceTypeToExtraToTicketToSeats()
    {
        return $this->hasMany(EventTypeToResourceTypeToExtraToTicketToSeat::className(), ['event_type_to_resource_type_to_extra_id' => 'id', 'account_id' => 'account_id']);
    }
}

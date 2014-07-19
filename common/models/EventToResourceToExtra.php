<?php

namespace common\models;

/**
 * This is the model class for table "tbl_event_to_resource_to_extra".
 *
 * @property string $id
 * @property string $account_id
 * @property string $event_id
 * @property string $resource_to_extra_id
 * @property integer $deleted
 *
 * @property BookingToEventToResourceToExtra[] $bookingToEventToResourceToExtras
 * @property Event $event
 * @property ResourceToExtra $resourceToExtra
 * @property Account $account
 * @property EventToResourceToExtraToSummary[] $eventToResourceToExtraToSummaries
 * @property EventToResourceToExtraToTicket[] $eventToResourceToExtraToTickets
 * @property EventToResourceToExtraToTicketToSeat[] $eventToResourceToExtraToTicketToSeats
 */
class EventToResourceToExtra extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_event_to_resource_to_extra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'event_id', 'resource_to_extra_id'], 'required'],
            [['account_id', 'event_id', 'resource_to_extra_id'], 'integer'],
            [['event_id', 'resource_to_extra_id'], 'unique', 'targetAttribute' => ['event_id', 'resource_to_extra_id'], 'message' => 'The combination of Event and Extra has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingToEventToResourceToExtras()
    {
        return $this->hasMany(BookingToEventToResourceToExtra::className(), ['event_to_resource_to_extra_id' => 'id', 'account_id' => 'account_id']);
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
    public function getResourceToExtra()
    {
        return $this->hasOne(ResourceToExtra::className(), ['id' => 'resource_to_extra_id', 'account_id' => 'account_id']);
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
    public function getEventToResourceToExtraToSummaries()
    {
        return $this->hasMany(EventToResourceToExtraToSummary::className(), ['account_id' => 'account_id', 'event_to_resource_to_extra_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventToResourceToExtraToTickets()
    {
        return $this->hasMany(EventToResourceToExtraToTicket::className(), ['event_to_resource_to_extra_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventToResourceToExtraToTicketToSeats()
    {
        return $this->hasMany(EventToResourceToExtraToTicketToSeat::className(), ['event_to_resource_to_extra_id' => 'id', 'account_id' => 'account_id']);
    }
}

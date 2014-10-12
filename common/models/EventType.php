<?php

namespace common\models;

/**
 * This is the model class for table "tbl_event_type".
 *
 * @property integer $id
 * @property integer $account_id
 * @property string $name
 * @property integer $seats_max
 * @property string $deposit
 * @property integer $deposit_hours
 * @property integer $seats_min
 * @property integer $seats_min_hours
 * @property string $private_note
 * @property string $tooltip
 * @property integer $deleted
 *
 * @property Event[] $events
 * @property Account $account
 * @property EventTypeToFieldSet[] $eventTypeToFieldSets
 * @property EventTypeToResourceType[] $eventTypeToResourceTypes
 * @property EventTypeToTicketType[] $eventTypeToTicketTypes
 */
class EventType extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_event_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'name', 'seats_max', 'deposit', 'deposit_hours', 'seats_min', 'seats_min_hours'], 'required'],
            [['account_id', 'seats_max', 'deposit_hours', 'seats_min', 'seats_min_hours'], 'integer'],
            [['deposit'], 'number'],
            [['private_note', 'tooltip'], 'string'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['event_type_id' => 'id']);
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
    public function getEventTypeToFieldSets()
    {
        return $this->hasMany(EventTypeToFieldSet::className(), ['event_type_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTypeToResourceTypes()
    {
        return $this->hasMany(EventTypeToResourceType::className(), ['event_type_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTypeToTicketTypes()
    {
        return $this->hasMany(EventTypeToTicketType::className(), ['event_type_id' => 'id']);
    }

}

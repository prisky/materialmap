<?php

namespace common\models;

/**
 * This is the model class for table "tbl_event_detail".
 *
 * @property string $id
 * @property string $account_id
 * @property string $resource_id
 * @property integer $seats_max
 * @property string $name
 * @property string $deposit
 * @property integer $deposit_hours
 * @property integer $seats_min
 * @property integer $seats_min_hours
 * @property string $private_note
 * @property string $tooltip
 *
 * @property Event[] $events
 * @property Resource $resource
 * @property Account $account
 * @property EventDetailToTicketType[] $eventDetailToTicketTypes
 */
class EventDetail extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_event_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'resource_id', 'seats_max', 'name'], 'required'],
            [['account_id', 'resource_id', 'seats_max', 'deposit_hours', 'seats_min', 'seats_min_hours'], 'integer'],
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
        return $this->hasMany(Event::className(), ['event_detail_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResource()
    {
        return $this->hasOne(Resource::className(), ['id' => 'resource_id', 'account_id' => 'account_id']);
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
    public function getEventDetailToTicketTypes()
    {
        return $this->hasMany(EventDetailToTicketType::className(), ['event_detail_id' => 'id', 'account_id' => 'account_id']);
    }
}

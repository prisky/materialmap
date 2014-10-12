<?php

namespace common\models;

/**
 * This is the model class for table "tbl_event".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $event_type_id
 * @property integer $resource_id
 * @property string $start
 * @property string $end
 * @property string $status
 *
 * @property Booking[] $bookings
 * @property Comment[] $comments
 * @property EventType $eventType
 * @property Account $account
 * @property Resource $resource
 */
class Event extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'event_type_id', 'resource_id', 'start', 'end', 'status'], 'required'],
            [['account_id', 'event_type_id', 'resource_id'], 'integer'],
            [['start', 'end'], 'safe'],
            [['status'], 'string']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['event_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['event_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventType()
    {
        return $this->hasOne(EventType::className(), ['id' => 'event_type_id']);
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
    public function getResource()
    {
        return $this->hasOne(Resource::className(), ['id' => 'resource_id']);
    }

}

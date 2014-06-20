<?php

namespace common\models;

/**
 * This is the model class for table "tbl_event".
 *
 * @property string $id
 * @property string $account_id
 * @property string $event_detail_id
 * @property string $start
 * @property string $end
 * @property string $status
 *
 * @property Booking[] $bookings
 * @property Comment[] $comments
 * @property EventDetail $eventDetail
 * @property Account $account
 * @property EventToResourceToCustomField[] $eventToResourceToCustomFields
 * @property EventToResourceToExtra[] $eventToResourceToExtras
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
            [['account_id', 'event_detail_id', 'start', 'end', 'status'], 'required'],
            [['account_id', 'event_detail_id'], 'integer'],
            [['start', 'end'], 'safe'],
            [['status'], 'string']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['event_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['event_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventDetail()
    {
        return $this->hasOne(EventDetail::className(), ['id' => 'event_detail_id', 'account_id' => 'account_id']);
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
    public function getEventToResourceToCustomFields()
    {
        return $this->hasMany(EventToResourceToCustomField::className(), ['event_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventToResourceToExtras()
    {
        return $this->hasMany(EventToResourceToExtra::className(), ['event_id' => 'id', 'account_id' => 'account_id']);
    }
}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_resource".
 *
 * @property string $id
 * @property string $account_id
 * @property string $name
 * @property string $comment
 * @property integer $deleted
 *
 * @property EventDetail[] $eventDetails
 * @property Account $account
 * @property ResourceToAddress[] $resourceToAddresses
 * @property ResourceToCustomField[] $resourceToCustomFields
 * @property ResourceToExtra[] $resourceToExtras
 * @property ResourceToMessage[] $resourceToMessages
 * @property Seat[] $seats
 * @property SurveyToResource[] $surveyToResources
 */
class Resource extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_resource';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'name'], 'required'],
            [['account_id'], 'integer'],
            [['comment'], 'string'],
            [['name'], 'string', 'max' => 64],
            [['account_id', 'name'], 'unique', 'targetAttribute' => ['account_id', 'name'], 'message' => 'The combination of Account and Name has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventDetails()
    {
        return $this->hasMany(EventDetail::className(), ['resource_id' => 'id', 'account_id' => 'account_id']);
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
    public function getResourceToAddresses()
    {
        return $this->hasMany(ResourceToAddress::className(), ['resource_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceToCustomFields()
    {
        return $this->hasMany(ResourceToCustomField::className(), ['resource_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceToExtras()
    {
        return $this->hasMany(ResourceToExtra::className(), ['resource_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceToMessages()
    {
        return $this->hasMany(ResourceToMessage::className(), ['resource_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeats()
    {
        return $this->hasMany(Seat::className(), ['resource_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyToResources()
    {
        return $this->hasMany(SurveyToResource::className(), ['resource_id' => 'id', 'account_id' => 'account_id']);
    }
}

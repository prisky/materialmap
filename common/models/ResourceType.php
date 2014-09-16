<?php

namespace common\models;

/**
 * This is the model class for table "tbl_resource_type".
 *
 * @property string $id
 * @property string $account_id
 * @property string $name
 * @property string $comment
 * @property integer $deleted
 *
 * @property EventTypeToResourceType[] $eventTypeToResourceTypes
 * @property Resource[] $resources
 * @property Account $account
 * @property ResourceTypeToMessage[] $resourceTypeToMessages
 * @property SurveyToResourceType[] $surveyToResourceTypes
 */
class ResourceType extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_resource_type';
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
    public function getEventTypeToResourceTypes()
    {
        return $this->hasMany(EventTypeToResourceType::className(), ['resource_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResources()
    {
        return $this->hasMany(Resource::className(), ['resource_type_id' => 'id']);
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
    public function getResourceTypeToMessages()
    {
        return $this->hasMany(ResourceTypeToMessage::className(), ['resource_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyToResourceTypes()
    {
        return $this->hasMany(SurveyToResourceType::className(), ['resource_type_id' => 'id']);
    }
}

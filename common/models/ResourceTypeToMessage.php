<?php

namespace common\models;

/**
 * This is the model class for table "tbl_resource_type_to_message".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $resource_type_id
 * @property integer $message_id
 * @property string $email_html
 * @property string $email_subject
 * @property string $sms_message
 *
 * @property ResourceType $resourceType
 * @property Message $message
 * @property Account $account
 * @property ResourceTypeToMessageToUser[] $resourceTypeToMessageToUsers
 */
class ResourceTypeToMessage extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_resource_type_to_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'resource_type_id', 'message_id'], 'required'],
            [['account_id', 'resource_type_id', 'message_id'], 'integer'],
            [['email_html'], 'string'],
            [['email_subject'], 'string', 'max' => 100],
            [['sms_message'], 'string', 'max' => 140],
            [['message_id', 'resource_type_id', 'account_id'], 'unique', 'targetAttribute' => ['message_id', 'resource_type_id', 'account_id'], 'message' => 'The combination of Account, Resource type and Message has already been taken.']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceType()
    {
        return $this->hasOne(ResourceType::className(), ['id' => 'resource_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessage()
    {
        return $this->hasOne(Message::className(), ['id' => 'message_id']);
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
    public function getResourceTypeToMessageToUsers()
    {
        return $this->hasMany(ResourceTypeToMessageToUser::className(), ['resource_type_to_message' => 'id']);
    }
}

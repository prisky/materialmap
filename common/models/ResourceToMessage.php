<?php

namespace common\models;

/**
 * This is the model class for table "tbl_resource_to_message".
 *
 * @property string $id
 * @property string $account_id
 * @property string $resource_id
 * @property string $message_id
 * @property string $email_message
 * @property string $sms_message
 * @property string $email_submect
 *
 * @property Resource $resource
 * @property Message $message
 * @property Account $account
 * @property ResourceToMessageToUser[] $resourceToMessageToUsers
 */
class ResourceToMessage extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_resource_to_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'resource_id', 'message_id'], 'required'],
            [['account_id', 'resource_id', 'message_id'], 'integer'],
            [['email_message'], 'string'],
            [['sms_message'], 'string', 'max' => 140],
            [['email_submect'], 'string', 'max' => 100],
            [['message_id', 'resource_id', 'account_id'], 'unique', 'targetAttribute' => ['message_id', 'resource_id', 'account_id'], 'message' => 'The combination of Account, Resource and Message has already been taken.']
        ];
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
    public function getResourceToMessageToUsers()
    {
        return $this->hasMany(ResourceToMessageToUser::className(), ['resource_to_message' => 'id', 'account_id' => 'account_id']);
    }
}

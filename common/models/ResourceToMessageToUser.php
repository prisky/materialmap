<?php

namespace common\models;

/**
 * This is the model class for table "tbl_resource_to_message_to_user".
 *
 * @property string $id
 * @property string $account_id
 * @property string $resource_to_message
 * @property string $user_id
 *
 * @property ResourceToMessage $resourceToMessage
 * @property Account $account
 */
class ResourceToMessageToUser extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_resource_to_message_to_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'resource_to_message', 'user_id'], 'required'],
            [['account_id', 'resource_to_message', 'user_id'], 'integer'],
            [['resource_to_message', 'user_id'], 'unique', 'targetAttribute' => ['resource_to_message', 'user_id'], 'message' => 'The combination of Message and User has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceToMessage()
    {
        return $this->hasOne(ResourceToMessage::className(), ['id' => 'resource_to_message', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

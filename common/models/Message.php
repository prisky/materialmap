<?php

namespace common\models;

/**
 * This is the model class for table "tbl_message".
 *
 * @property integer $id
 * @property string $name
 * @property integer $system
 * @property string $email_html
 * @property string $email_subject
 * @property string $sms_text
 *
 * @property AccountToMessage[] $accountToMessages
 * @property MessageToMessageField[] $messageToMessageFields
 * @property ResourceTypeToMessage[] $resourceTypeToMessages
 */
class Message extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'system'], 'required'],
            [['system'], 'integer'],
            [['email_html'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['email_subject'], 'string', 'max' => 100],
            [['sms_text'], 'string', 'max' => 140],
            [['name'], 'unique']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountToMessages()
    {
        return $this->hasMany(AccountToMessage::className(), ['message_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessageToMessageFields()
    {
        return $this->hasMany(MessageToMessageField::className(), ['message_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceTypeToMessages()
    {
        return $this->hasMany(ResourceTypeToMessage::className(), ['message_id' => 'id']);
    }

}

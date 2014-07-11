<?php

namespace common\models;

/**
 * This is the model class for table "tbl_message".
 *
 * @property string $id
 * @property string $name
 * @property integer $system
 * @property string $email_html
 * @property string $sms_text
 * @property string $email_subject
 *
 * @property AccountToMessage[] $accountToMessages
 * @property MessageToMessageField[] $messageToMessageFields
 * @property ResourceToMessage[] $resourceToMessages
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
            [['name'], 'required'],
            [['system'], 'integer'],
            [['email_html'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['sms_text'], 'string', 'max' => 140],
            [['email_subject'], 'string', 'max' => 100],
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
    public function getResourceToMessages()
    {
        return $this->hasMany(ResourceToMessage::className(), ['message_id' => 'id']);
    }
}

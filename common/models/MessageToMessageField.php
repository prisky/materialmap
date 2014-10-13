<?php

namespace common\models;

/**
 * This is the model class for table "tbl_message_to_message_field".
 *
 * @property integer $id
 * @property integer $message_id
 * @property integer $message_field_id
 *
 * @property Message $message
 * @property MessageField $messageField
 */
class MessageToMessageField extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_message_to_message_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message_id', 'message_field_id'], 'required'],
            [['message_id', 'message_field_id'], 'integer'],
            [['message_id', 'message_field_id'], 'unique', 'targetAttribute' => ['message_id', 'message_field_id'], 'message' => 'The combination of Message and Message field has already been taken.']
        ];
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
    public function getMessageField()
    {
        return $this->hasOne(MessageField::className(), ['id' => 'message_field_id']);
    }

}

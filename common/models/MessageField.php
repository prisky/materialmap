<?php

namespace common\models;

/**
 * This is the model class for table "tbl_message_field".
 *
 * @property string $id
 * @property string $name
 * @property string $comment
 *
 * @property MessageToMessageField[] $messageToMessageFields
 */
class MessageField extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_message_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string'],
            [['name'], 'unique']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessageToMessageFields()
    {
        return $this->hasMany(MessageToMessageField::className(), ['message_field_id' => 'id']);
    }
}

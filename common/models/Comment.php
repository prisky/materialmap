<?php

namespace common\models;

/**
 * This is the model class for table "tbl_comment".
 *
 * @property string $id
 * @property string $account_id
 * @property string $event_id
 * @property string $content
 * @property string $created
 * @property string $email
 *
 * @property Account $account
 * @property Event $event
 */
class Comment extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'event_id', 'content', 'email'], 'required'],
            [['account_id', 'event_id'], 'integer'],
            [['content'], 'string'],
            [['email'], 'string', 'max' => 255]
        ];
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
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id', 'account_id' => 'account_id']);
    }
}

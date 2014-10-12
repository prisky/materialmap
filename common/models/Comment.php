<?php

namespace common\models;

/**
 * This is the model class for table "tbl_comment".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $event_id
 * @property integer $contact_id
 * @property string $content_html_basic
 * @property string $created
 *
 * @property Account $account
 * @property Event $event
 * @property Contact $contact
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
            [['account_id', 'event_id', 'contact_id', 'content_html_basic'], 'required'],
            [['account_id', 'event_id', 'contact_id'], 'integer'],
            [['content_html_basic'], 'string']
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
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Contact::className(), ['id' => 'contact_id']);
    }
}

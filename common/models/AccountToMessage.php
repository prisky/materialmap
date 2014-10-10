<?php

namespace common\models;

/**
 * This is the model class for table "tbl_account_to_message".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $message_id
 * @property string $email_message
 * @property string $email_subject
 * @property string $sms_message
 *
 * @property Message $message
 * @property Account $account
 * @property AccountToMessageToUser[] $accountToMessageToUsers
 */
class AccountToMessage extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_account_to_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'message_id'], 'required'],
            [['account_id', 'message_id'], 'integer'],
            [['email_message'], 'string'],
            [['email_subject'], 'string', 'max' => 100],
            [['sms_message'], 'string', 'max' => 140],
            [['message_id', 'account_id'], 'unique', 'targetAttribute' => ['message_id', 'account_id'], 'message' => 'The combination of Account and Message has already been taken.']
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
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountToMessageToUsers()
    {
        return $this->hasMany(AccountToMessageToUser::className(), ['account_to_message' => 'id']);
    }
}

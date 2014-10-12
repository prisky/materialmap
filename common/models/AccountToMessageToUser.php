<?php

namespace common\models;

/**
 * This is the model class for table "tbl_account_to_message_to_user".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $account_to_message
 * @property integer $user_id
 *
 * @property AccountToMessage $accountToMessage
 * @property Account $account
 */
class AccountToMessageToUser extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_account_to_message_to_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'account_to_message', 'user_id'], 'required'],
            [['account_id', 'account_to_message', 'user_id'], 'integer'],
            [['account_to_message', 'user_id', 'account_id'], 'unique', 'targetAttribute' => ['account_to_message', 'user_id', 'account_id'], 'message' => 'The combination of Account, Message and User has already been taken.']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountToMessage()
    {
        return $this->hasOne(AccountToMessage::className(), ['id' => 'account_to_message']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

}

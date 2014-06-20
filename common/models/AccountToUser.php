<?php

namespace common\models;

/**
 * This is the model class for table "tbl_account_to_user".
 *
 * @property string $id
 * @property string $account_id
 * @property string $user_id
 * @property string $rate
 * @property integer $immediate
 * @property integer $deleted
 *
 * @property Account $account
 * @property User $user
 * @property Invoice[] $invoices
 * @property Referral[] $referrals
 * @property SummaryToAccountToUser[] $summaryToAccountToUsers
 */
class AccountToUser extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_account_to_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'user_id'], 'required'],
            [['account_id', 'user_id', 'immediate'], 'integer'],
            [['rate'], 'number'],
            [['account_id', 'user_id'], 'unique', 'targetAttribute' => ['account_id', 'user_id'], 'message' => 'The combination of Account and User has already been taken.']
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['account_to_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferrals()
    {
        return $this->hasMany(Referral::className(), ['account_to_user_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToAccountToUsers()
    {
        return $this->hasMany(SummaryToAccountToUser::className(), ['account_to_user_id' => 'id', 'user_id' => 'user_id', 'account_id' => 'account_id']);
    }
}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_summary_to_account_to_user".
 *
 * @property string $id
 * @property string $account_id
 * @property string $user_id
 * @property string $summary_id
 * @property string $account_to_user_id
 * @property string $invoice_id
 * @property string $rate
 *
 * @property Referral[] $referrals
 * @property Account $account
 * @property AccountToUser $accountToUser
 * @property Summary $summary
 * @property Invoice $invoice
 */
class SummaryToAccountToUser extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_summary_to_account_to_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'user_id', 'summary_id', 'account_to_user_id', 'invoice_id'], 'required'],
            [['account_id', 'user_id', 'summary_id', 'account_to_user_id', 'invoice_id'], 'integer'],
            [['rate'], 'number'],
            [['summary_id', 'account_to_user_id'], 'unique', 'targetAttribute' => ['summary_id', 'account_to_user_id'], 'message' => 'The combination of Summary and User has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferrals()
    {
        return $this->hasMany(Referral::className(), ['summary_to_account_to_user_id' => 'id']);
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
    public function getAccountToUser()
    {
        return $this->hasOne(AccountToUser::className(), ['id' => 'account_to_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummary()
    {
        return $this->hasOne(Summary::className(), ['id' => 'summary_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'invoice_id']);
    }
}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_referral".
 *
 * @property integer $id
 * @property string $account_id
 * @property string $first_referrer_user_id
 * @property string $summary_to_account_to_user_id
 * @property string $account_to_user_id
 * @property string $invoice_id
 * @property string $rate
 *
 * @property Account $account
 * @property SummaryToAccountToUser $summaryToAccountToUser
 * @property AccountToUser $accountToUser
 * @property Invoice $invoice
 */
class Referral extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_referral';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'first_referrer_user_id', 'summary_to_account_to_user_id', 'account_to_user_id', 'invoice_id'], 'required'],
            [['account_id', 'first_referrer_user_id', 'summary_to_account_to_user_id', 'account_to_user_id', 'invoice_id'], 'integer'],
            [['rate'], 'number'],
            [['summary_to_account_to_user_id'], 'unique']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id', 'user_id' => 'first_referrer_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToAccountToUser()
    {
        return $this->hasOne(SummaryToAccountToUser::className(), ['id' => 'summary_to_account_to_user_id', 'user_id' => 'first_referrer_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountToUser()
    {
        return $this->hasOne(AccountToUser::className(), ['id' => 'account_to_user_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'invoice_id', 'account_to_user_id' => 'account_to_user_id']);
    }
}

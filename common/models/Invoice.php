<?php

namespace common\models;

/**
 * This is the model class for table "tbl_invoice".
 *
 * @property integer $id
 * @property integer $account_to_user_id
 * @property string $invoiced
 * @property string $paid
 *
 * @property AccountToUser $accountToUser
 * @property Referral[] $referrals
 * @property SummaryToAccountToUser[] $summaryToAccountToUsers
 */
class Invoice extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_to_user_id'], 'required'],
            [['account_to_user_id'], 'integer'],
            [['invoiced', 'paid'], 'safe']
        ];
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
    public function getReferrals()
    {
        return $this->hasMany(Referral::className(), ['invoice_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToAccountToUsers()
    {
        return $this->hasMany(SummaryToAccountToUser::className(), ['invoice_id' => 'id']);
    }

}

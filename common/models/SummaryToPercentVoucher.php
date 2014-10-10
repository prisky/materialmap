<?php

namespace common\models;

/**
 * This is the model class for table "tbl_summary_to_percent_voucher".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $summary_id
 * @property integer $percent_voucher_id
 *
 * @property Summary $summary
 * @property PercentVoucher $percentVoucher
 * @property Account $account
 */
class SummaryToPercentVoucher extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_summary_to_percent_voucher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'summary_id', 'percent_voucher_id'], 'required'],
            [['account_id', 'summary_id', 'percent_voucher_id'], 'integer'],
            [['summary_id'], 'unique'],
            [['percent_voucher_id'], 'unique']
        ];
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
    public function getPercentVoucher()
    {
        return $this->hasOne(PercentVoucher::className(), ['id' => 'percent_voucher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

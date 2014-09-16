<?php

namespace common\models;

/**
 * This is the model class for table "tbl_summary_to_voucher".
 *
 * @property string $id
 * @property string $account_id
 * @property string $summary_id
 * @property string $voucher_id
 * @property string $amount
 *
 * @property Summary $summary
 * @property Voucher $voucher
 * @property Account $account
 */
class SummaryToVoucher extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_summary_to_voucher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'summary_id', 'voucher_id'], 'required'],
            [['account_id', 'summary_id', 'voucher_id'], 'integer'],
            [['amount'], 'number'],
            [['summary_id', 'voucher_id'], 'unique', 'targetAttribute' => ['summary_id', 'voucher_id'], 'message' => 'The combination of Summary and Voucher has already been taken.']
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
    public function getVoucher()
    {
        return $this->hasOne(Voucher::className(), ['id' => 'voucher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

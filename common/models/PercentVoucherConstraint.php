<?php

namespace common\models;

/**
 * This is the model class for table "tbl_percent_voucher_constraint".
 *
 * @property string $id
 * @property string $account_id
 * @property string $percent_voucher_id
 * @property string $invalid_from
 * @property string $invalaid_to
 *
 * @property Account $account
 * @property PercentVoucher $percentVoucher
 */
class PercentVoucherConstraint extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_percent_voucher_constraint';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'percent_voucher_id'], 'required'],
            [['account_id', 'percent_voucher_id'], 'integer'],
            [['invalid_from', 'invalaid_to'], 'safe'],
            [['percent_voucher_id', 'invalid_from'], 'unique', 'targetAttribute' => ['percent_voucher_id', 'invalid_from'], 'message' => 'The combination of Percent voucher and Invalid from has already been taken.'],
            [['percent_voucher_id', 'invalaid_to'], 'unique', 'targetAttribute' => ['percent_voucher_id', 'invalaid_to'], 'message' => 'The combination of  and Percent voucher has already been taken.']
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
    public function getPercentVoucher()
    {
        return $this->hasOne(PercentVoucher::className(), ['id' => 'percent_voucher_id', 'account_id' => 'account_id']);
    }
}

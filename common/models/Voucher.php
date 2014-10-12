<?php

namespace common\models;

/**
 * This is the model class for table "tbl_voucher".
 *
 * @property integer $id
 * @property integer $account_id
 * @property string $amount
 * @property string $uniqueid
 *
 * @property SummaryToVoucher[] $summaryToVouchers
 * @property Account $account
 * @property VoucherConstraint[] $voucherConstraints
 */
class Voucher extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_voucher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'amount', 'uniqueid'], 'required'],
            [['account_id'], 'integer'],
            [['amount'], 'number'],
            [['uniqueid'], 'string', 'max' => 13],
            [['uniqueid'], 'unique']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToVouchers()
    {
        return $this->hasMany(SummaryToVoucher::className(), ['voucher_id' => 'id']);
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
    public function getVoucherConstraints()
    {
        return $this->hasMany(VoucherConstraint::className(), ['voucher_id' => 'id']);
    }

}

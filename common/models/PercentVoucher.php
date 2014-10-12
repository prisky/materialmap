<?php

namespace common\models;

/**
 * This is the model class for table "tbl_percent_voucher".
 *
 * @property integer $id
 * @property integer $account_id
 * @property string $rate
 *
 * @property Account $account
 * @property PercentVoucherConstraint[] $percentVoucherConstraints
 * @property SummaryToPercentVoucher[] $summaryToPercentVouchers
 */
class PercentVoucher extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_percent_voucher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'rate'], 'required'],
            [['account_id'], 'integer'],
            [['rate'], 'number']
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
    public function getPercentVoucherConstraints()
    {
        return $this->hasMany(PercentVoucherConstraint::className(), ['percent_voucher_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToPercentVouchers()
    {
        return $this->hasMany(SummaryToPercentVoucher::className(), ['percent_voucher_id' => 'id']);
    }

}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_payment".
 *
 * @property string $id
 * @property string $account_id
 * @property string $summary_id
 * @property string $payment_gateway_id
 * @property string $amount
 * @property string $uniqueid
 *
 * @property Summary $summary
 * @property PaymentGateway $paymentGateway
 * @property Account $account
 */
class Payment extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'summary_id', 'payment_gateway_id', 'uniqueid'], 'required'],
            [['account_id', 'summary_id', 'payment_gateway_id'], 'integer'],
            [['amount'], 'number'],
            [['uniqueid'], 'string', 'max' => 13],
            [['uniqueid'], 'unique']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummary()
    {
        return $this->hasOne(Summary::className(), ['id' => 'summary_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentGateway()
    {
        return $this->hasOne(PaymentGateway::className(), ['id' => 'payment_gateway_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

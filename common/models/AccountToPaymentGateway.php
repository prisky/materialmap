<?php

namespace common\models;

/**
 * This is the model class for table "tbl_account_to_payment_gateway".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $payment_gateway_id
 * @property integer $deleted
 *
 * @property Account $account
 * @property PaymentGateway $paymentGateway
 */
class AccountToPaymentGateway extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_account_to_payment_gateway';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'payment_gateway_id'], 'required'],
            [['account_id', 'payment_gateway_id'], 'integer'],
            [['account_id', 'payment_gateway_id'], 'unique', 'targetAttribute' => ['account_id', 'payment_gateway_id'], 'message' => 'The combination of Account and Payment gateway has already been taken.']
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
    public function getPaymentGateway()
    {
        return $this->hasOne(PaymentGateway::className(), ['id' => 'payment_gateway_id']);
    }

}

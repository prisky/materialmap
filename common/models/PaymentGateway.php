<?php

namespace common\models;

/**
 * This is the model class for table "tbl_payment_gateway".
 *
 * @property string $id
 * @property string $name
 * @property string $account_id
 * @property integer $deleted
 * @property string $api_url
 * @property string $api_username
 * @property string $api_password
 *
 * @property AccountToPaymentGateway[] $accountToPaymentGateways
 * @property Payment[] $payments
 * @property Account $account
 */
class PaymentGateway extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_payment_gateway';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['account_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['api_url', 'api_username', 'api_password'], 'string', 'max' => 255],
            [['account_id', 'name'], 'unique', 'targetAttribute' => ['account_id', 'name'], 'message' => 'The combination of Name and Account has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountToPaymentGateways()
    {
        return $this->hasMany(AccountToPaymentGateway::className(), ['account_id' => 'account_id', 'payment_gateway_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['payment_gateway_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

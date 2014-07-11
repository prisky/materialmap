<?php

namespace common\models;

/**
 * This is the model class for table "tbl_payment_gateway".
 *
 * @property string $id
 * @property string $name
 *
 * @property AccountToPaymentGateway[] $accountToPaymentGateways
 * @property Payment[] $payments
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
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountToPaymentGateways()
    {
        return $this->hasMany(AccountToPaymentGateway::className(), ['payment_gateway_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['payment_gateway_id' => 'id']);
    }
}

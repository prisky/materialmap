<?php

namespace common\models;

/**
 * This is the model class for table "tbl_payment".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $summary_id
 * @property integer $payment_gateway_id
 * @property integer $contact_id
 * @property string $amount
 * @property string $created
 *
 * @property Summary $summary
 * @property PaymentGateway $paymentGateway
 * @property Account $account
 * @property Contact $contact
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
            [['account_id', 'summary_id', 'payment_gateway_id', 'contact_id', 'amount'], 'required'],
            [['account_id', 'summary_id', 'payment_gateway_id', 'contact_id'], 'integer'],
            [['amount'], 'number']
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Contact::className(), ['id' => 'contact_id']);
    }

}

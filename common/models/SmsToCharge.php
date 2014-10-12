<?php

namespace common\models;

/**
 * This is the model class for table "tbl_sms_to_charge".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $sms_id
 * @property integer $charge_id
 *
 * @property Account $account
 * @property Sms $sms
 * @property Charge $charge
 */
class SmsToCharge extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_sms_to_charge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'sms_id', 'charge_id'], 'required'],
            [['account_id', 'sms_id', 'charge_id'], 'integer'],
            [['sms_id'], 'unique'],
            [['charge_id'], 'unique']
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
    public function getSms()
    {
        return $this->hasOne(Sms::className(), ['id' => 'sms_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharge()
    {
        return $this->hasOne(Charge::className(), ['id' => 'charge_id']);
    }

}

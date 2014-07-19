<?php

namespace common\models;

/**
 * This is the model class for table "tbl_annual_charge".
 *
 * @property string $id
 * @property string $account_id
 * @property string $charge_id
 *
 * @property Charge $charge
 * @property Account $account
 */
class AnnualCharge extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_annual_charge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'charge_id'], 'required'],
            [['account_id', 'charge_id'], 'integer'],
            [['charge_id'], 'unique']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharge()
    {
        return $this->hasOne(Charge::className(), ['id' => 'charge_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_summary_to_charge".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $summary_id
 * @property integer $charge_id
 *
 * @property Account $account
 * @property Summary $summary
 * @property Charge $charge
 */
class SummaryToCharge extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_summary_to_charge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'summary_id', 'charge_id'], 'required'],
            [['account_id', 'summary_id', 'charge_id'], 'integer'],
            [['summary_id', 'charge_id'], 'unique', 'targetAttribute' => ['summary_id', 'charge_id'], 'message' => 'The combination of Summary and Charge has already been taken.']
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
    public function getSummary()
    {
        return $this->hasOne(Summary::className(), ['id' => 'summary_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharge()
    {
        return $this->hasOne(Charge::className(), ['id' => 'charge_id']);
    }

}

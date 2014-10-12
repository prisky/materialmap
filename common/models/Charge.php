<?php

namespace common\models;

/**
 * This is the model class for table "tbl_charge".
 *
 * @property integer $id
 * @property integer $account_id
 * @property string $amount
 *
 * @property AnnualCharge[] $annualCharges
 * @property BookingToCharge[] $bookingToCharges
 * @property Account $account
 * @property SmsToCharge[] $smsToCharges
 * @property SummaryToCharge[] $summaryToCharges
 * @property TicketToCharge[] $ticketToCharges
 * @property TicketToSeatToCharge[] $ticketToSeatToCharges
 */
class Charge extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_charge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'amount'], 'required'],
            [['account_id'], 'integer'],
            [['amount'], 'number']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnnualCharges()
    {
        return $this->hasMany(AnnualCharge::className(), ['charge_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingToCharges()
    {
        return $this->hasMany(BookingToCharge::className(), ['charge_id' => 'id']);
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
    public function getSmsToCharges()
    {
        return $this->hasMany(SmsToCharge::className(), ['charge_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToCharges()
    {
        return $this->hasMany(SummaryToCharge::className(), ['charge_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToCharges()
    {
        return $this->hasMany(TicketToCharge::className(), ['charge_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToCharges()
    {
        return $this->hasMany(TicketToSeatToCharge::className(), ['charge_id' => 'id']);
    }

}

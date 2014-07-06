<?php

namespace common\models;

/**
 * This is the model class for table "tbl_summary".
 *
 * @property string $id
 * @property string $account_id
 * @property string $created
 *
 * @property Booking[] $bookings
 * @property EventToResourceToExtraToSummary[] $eventToResourceToExtraToSummaries
 * @property Payment[] $payments
 * @property Account $account
 * @property SummaryToAccountToUser[] $summaryToAccountToUsers
 * @property SummaryToCharge[] $summaryToCharges
 * @property SummaryToEventToResourceToCustomField[] $summaryToEventToResourceToCustomFields
 * @property SummaryToPercentPromotion[] $summaryToPercentPromotions
 * @property SummaryToPercentVoucher[] $summaryToPercentVouchers
 * @property SummaryToPromotion[] $summaryToPromotions
 * @property SummaryToVoucher[] $summaryToVouchers
 */
class Summary extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_summary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id'], 'required'],
            [['account_id'], 'integer']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['summary_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventToResourceToExtraToSummaries()
    {
        return $this->hasMany(EventToResourceToExtraToSummary::className(), ['summary_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['summary_id' => 'id', 'account_id' => 'account_id']);
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
    public function getSummaryToAccountToUsers()
    {
        return $this->hasMany(SummaryToAccountToUser::className(), ['summary_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToCharges()
    {
        return $this->hasMany(SummaryToCharge::className(), ['summary_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToEventToResourceToCustomFields()
    {
        return $this->hasMany(SummaryToEventToResourceToCustomField::className(), ['summary_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToPercentPromotions()
    {
        return $this->hasMany(SummaryToPercentPromotion::className(), ['summary_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToPercentVouchers()
    {
        return $this->hasMany(SummaryToPercentVoucher::className(), ['summary_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToPromotions()
    {
        return $this->hasMany(SummaryToPromotion::className(), ['summary_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToVouchers()
    {
        return $this->hasMany(SummaryToVoucher::className(), ['summary_id' => 'id', 'account_id' => 'account_id']);
    }
}
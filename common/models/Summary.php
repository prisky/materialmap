<?php

namespace common\models;

/**
 * This is the model class for table "tbl_summary".
 *
 * @property string $id
 * @property string $account_id
 * @property string $contact_id
 * @property string $created
 *
 * @property Booking[] $bookings
 * @property EventTypeToResourceTypeToExtraToSummary[] $eventTypeToResourceTypeToExtraToSummaries
 * @property Payment[] $payments
 * @property Account $account
 * @property Contact $contact
 * @property SummaryToAccountToUser[] $summaryToAccountToUsers
 * @property SummaryToCharge[] $summaryToCharges
 * @property SummaryToEventTypeToResourceToCustomField[] $summaryToEventTypeToResourceToCustomFields
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
            [['account_id', 'contact_id'], 'required'],
            [['account_id', 'contact_id'], 'integer']
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
    public function getEventTypeToResourceTypeToExtraToSummaries()
    {
        return $this->hasMany(EventTypeToResourceTypeToExtraToSummary::className(), ['account_id' => 'account_id', 'summary_id' => 'id']);
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
    public function getContact()
    {
        return $this->hasOne(Contact::className(), ['id' => 'contact_id']);
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
    public function getSummaryToEventTypeToResourceToCustomFields()
    {
        return $this->hasMany(SummaryToEventTypeToResourceToCustomField::className(), ['summary_id' => 'id', 'account_id' => 'account_id']);
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

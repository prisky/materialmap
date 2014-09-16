<?php

namespace common\models;

/**
 * This is the model class for table "tbl_field_set_to_custom_field".
 *
 * @property string $id
 * @property string $account_id
 * @property string $field_set_id
 * @property string $custom_field_id
 * @property integer $deleted
 *
 * @property BookingToCustomField[] $bookingToCustomFields
 * @property FieldSet $fieldSet
 * @property CustomField $account
 * @property SummaryToCustomField[] $summaryToCustomFields
 * @property SurveyResultToBooking[] $surveyResultToBookings
 * @property SurveyResultToSummary[] $surveyResultToSummaries
 * @property SurveyResultToTicket[] $surveyResultToTickets
 * @property SurveyResultToTicketToSeat[] $surveyResultToTicketToSeats
 * @property TicketToCustomField[] $ticketToCustomFields
 * @property TicketToSeatToCustomField[] $ticketToSeatToCustomFields
 */
class FieldSetToCustomField extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_field_set_to_custom_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'field_set_id', 'custom_field_id'], 'required'],
            [['account_id', 'field_set_id', 'custom_field_id'], 'integer'],
            [['field_set_id', 'custom_field_id', 'account_id'], 'unique', 'targetAttribute' => ['field_set_id', 'custom_field_id', 'account_id'], 'message' => 'The combination of Account, Field set and Custom field has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingToCustomFields()
    {
        return $this->hasMany(BookingToCustomField::className(), ['field_set_id' => 'field_set_id', 'custom_field_id' => 'custom_field_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldSet()
    {
        return $this->hasOne(FieldSet::className(), ['id' => 'field_set_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(CustomField::className(), ['account_id' => 'account_id', 'id' => 'custom_field_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToCustomFields()
    {
        return $this->hasMany(SummaryToCustomField::className(), ['field_set_id' => 'field_set_id', 'custom_field_id' => 'custom_field_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToBookings()
    {
        return $this->hasMany(SurveyResultToBooking::className(), ['field_set_id' => 'field_set_id', 'custom_field_id' => 'custom_field_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToSummaries()
    {
        return $this->hasMany(SurveyResultToSummary::className(), ['field_set_id' => 'field_set_id', 'custom_field_id' => 'custom_field_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToTickets()
    {
        return $this->hasMany(SurveyResultToTicket::className(), ['field_set_id' => 'field_set_id', 'custom_field_id' => 'custom_field_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToTicketToSeats()
    {
        return $this->hasMany(SurveyResultToTicketToSeat::className(), ['field_set_id' => 'field_set_id', 'custom_field_id' => 'custom_field_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToCustomFields()
    {
        return $this->hasMany(TicketToCustomField::className(), ['field_set_id' => 'field_set_id', 'custom_field_id' => 'custom_field_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToCustomFields()
    {
        return $this->hasMany(TicketToSeatToCustomField::className(), ['field_set_id' => 'field_set_id', 'custom_field_id' => 'custom_field_id', 'account_id' => 'account_id']);
    }
}

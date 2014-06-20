<?php

namespace common\models;

/**
 * This is the model class for table "tbl_survey_result".
 *
 * @property string $id
 * @property string $account_id
 * @property string $survey_to_custom_field_id
 * @property string $custom_value
 * @property string $created
 *
 * @property SurveyToCustomField $surveyToCustomField
 * @property Account $account
 * @property SurveyResultToBooking[] $surveyResultToBookings
 * @property SurveyResultToSummary[] $surveyResultToSummaries
 * @property SurveyResultToTicket[] $surveyResultToTickets
 * @property SurveyResultToTicketToSeat[] $surveyResultToTicketToSeats
 */
class SurveyResult extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_survey_result';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'survey_to_custom_field_id'], 'required'],
            [['account_id', 'survey_to_custom_field_id'], 'integer'],
            [['custom_value'], 'string', 'max' => 255]
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyToCustomField()
    {
        return $this->hasOne(SurveyToCustomField::className(), ['id' => 'survey_to_custom_field_id', 'account_id' => 'account_id']);
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
    public function getSurveyResultToBookings()
    {
        return $this->hasMany(SurveyResultToBooking::className(), ['survey_result_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToSummaries()
    {
        return $this->hasMany(SurveyResultToSummary::className(), ['survey_result_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToTickets()
    {
        return $this->hasMany(SurveyResultToTicket::className(), ['survey_result_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToTicketToSeats()
    {
        return $this->hasMany(SurveyResultToTicketToSeat::className(), ['survey_result_id' => 'id', 'account_id' => 'account_id']);
    }
}

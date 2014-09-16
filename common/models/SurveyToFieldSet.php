<?php

namespace common\models;

/**
 * This is the model class for table "tbl_survey_to_field_set".
 *
 * @property string $id
 * @property string $account_id
 * @property string $survey_id
 * @property string $field_set_id
 * @property integer $deleted
 *
 * @property SurveyResultToBooking[] $surveyResultToBookings
 * @property SurveyResultToSummary[] $surveyResultToSummaries
 * @property SurveyResultToTicket[] $surveyResultToTickets
 * @property SurveyResultToTicketToSeat[] $surveyResultToTicketToSeats
 * @property Survey $survey
 * @property FieldSet $fieldSet
 * @property Account $account
 */
class SurveyToFieldSet extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_survey_to_field_set';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'survey_id', 'field_set_id'], 'required'],
            [['account_id', 'survey_id', 'field_set_id'], 'integer'],
            [['survey_id', 'field_set_id', 'account_id'], 'unique', 'targetAttribute' => ['survey_id', 'field_set_id', 'account_id'], 'message' => 'The combination of Account, Survey and Field set has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToBookings()
    {
        return $this->hasMany(SurveyResultToBooking::className(), ['survey_id' => 'survey_id', 'field_set_id' => 'field_set_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToSummaries()
    {
        return $this->hasMany(SurveyResultToSummary::className(), ['survey_id' => 'survey_id', 'field_set_id' => 'field_set_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToTickets()
    {
        return $this->hasMany(SurveyResultToTicket::className(), ['survey_id' => 'survey_id', 'field_set_id' => 'field_set_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToTicketToSeats()
    {
        return $this->hasMany(SurveyResultToTicketToSeat::className(), ['survey_id' => 'survey_id', 'field_set_id' => 'field_set_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurvey()
    {
        return $this->hasOne(Survey::className(), ['id' => 'survey_id', 'account_id' => 'account_id']);
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
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

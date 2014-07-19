<?php

namespace common\models;

/**
 * This is the model class for table "tbl_survey_result_to_booking".
 *
 * @property string $id
 * @property string $account_id
 * @property string $survey_result_id
 * @property string $booking_id
 *
 * @property SurveyResult $surveyResult
 * @property Booking $booking
 * @property Account $account
 */
class SurveyResultToBooking extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_survey_result_to_booking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'survey_result_id', 'booking_id'], 'required'],
            [['account_id', 'survey_result_id', 'booking_id'], 'integer'],
            [['survey_result_id', 'booking_id'], 'unique', 'targetAttribute' => ['survey_result_id', 'booking_id'], 'message' => 'The combination of Survey result and Booking has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResult()
    {
        return $this->hasOne(SurveyResult::className(), ['id' => 'survey_result_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooking()
    {
        return $this->hasOne(Booking::className(), ['id' => 'booking_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

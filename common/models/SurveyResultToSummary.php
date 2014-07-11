<?php

namespace common\models;

/**
 * This is the model class for table "tbl_survey_result_to_summary".
 *
 * @property string $id
 * @property string $account_id
 * @property string $survey_result_id
 *
 * @property Account $account
 * @property SurveyResult $surveyResult
 */
class SurveyResultToSummary extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_survey_result_to_summary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'survey_result_id'], 'required'],
            [['account_id', 'survey_result_id'], 'integer'],
            [['survey_result_id'], 'unique']
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
    public function getSurveyResult()
    {
        return $this->hasOne(SurveyResult::className(), ['id' => 'survey_result_id', 'account_id' => 'account_id']);
    }
}

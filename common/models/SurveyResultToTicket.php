<?php

namespace common\models;

/**
 * This is the model class for table "tbl_survey_result_to_ticket".
 *
 * @property string $id
 * @property string $account_id
 * @property string $survey_result_id
 * @property string $ticket_id
 *
 * @property Account $account
 * @property SurveyResult $surveyResult
 * @property Ticket $ticket
 */
class SurveyResultToTicket extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_survey_result_to_ticket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'survey_result_id', 'ticket_id'], 'required'],
            [['account_id', 'survey_result_id', 'ticket_id'], 'integer'],
            [['survey_result_id', 'ticket_id'], 'unique', 'targetAttribute' => ['survey_result_id', 'ticket_id'], 'message' => 'The combination of Survey result and Ticket has already been taken.']
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id', 'account_id' => 'account_id']);
    }
}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_prisk".
 *
 * @property integer $id
 * @property string $first name
 * @property integer $survey_result_to_ticket_id
 * @property integer $deleted
 *
 * @property SurveyResultToTicket $surveyResultToTicket
 */
class Prisk extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_prisk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToTicket()
    {
        return $this->hasOne(SurveyResultToTicket::className(), ['id' => 'survey_result_to_ticket_id']);
    }

}

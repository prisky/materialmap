<?php

namespace common\models;

/**
 * This is the model class for table "tbl_summary_level".
 *
 * @property integer $id
 *
 * @property SummaryToCustomField[] $summaryToCustomFields
 * @property SummaryToItem[] $summaryToItems
 * @property SurveyResultToSummary[] $surveyResultToSummaries
 */
class SummaryLevel extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_summary_level';
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
    public function getSummaryToCustomFields()
    {
        return $this->hasMany(SummaryToCustomField::className(), ['level_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToItems()
    {
        return $this->hasMany(SummaryToItem::className(), ['level_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToSummaries()
    {
        return $this->hasMany(SurveyResultToSummary::className(), ['level_id' => 'id']);
    }

}

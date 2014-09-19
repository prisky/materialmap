<?php

namespace common\models;

/**
 * This is the model class for table "tbl_survey_result_to_summary".
 *
 * @property string $id
 * @property string $account_id
 * @property string $summary_id
 * @property string $survey_id
 * @property string $custom_field_id
 * @property string $field_set_id
 * @property integer $level_id
 * @property string $custom_value
 *
 * @property Account $account
 * @property Summary $summary
 * @property CustomField $customField
 * @property SummaryLevel $level
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
            [['account_id', 'summary_id', 'survey_id', 'custom_field_id', 'field_set_id'], 'required'],
            [['account_id', 'summary_id', 'survey_id', 'custom_field_id', 'field_set_id', 'level_id'], 'integer'],
            [['custom_value'], 'string', 'max' => 255],
            [['survey_id'], 'unique']
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
    public function getSummary()
    {
        return $this->hasOne(Summary::className(), ['id' => 'summary_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomField()
    {
        return $this->hasOne(CustomField::className(), ['id' => 'custom_field_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(SummaryLevel::className(), ['id' => 'level_id']);
    }
}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_survey_to_custom_field".
 *
 * @property string $id
 * @property string $account_id
 * @property string $survey_id
 * @property string $custom_field_id
 * @property double $order
 * @property integer $deleted
 *
 * @property SurveyResult[] $surveyResults
 * @property Survey $survey
 * @property CustomField $customField
 * @property Account $account
 */
class SurveyToCustomField extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_survey_to_custom_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'survey_id', 'custom_field_id'], 'required'],
            [['account_id', 'survey_id', 'custom_field_id'], 'integer'],
            [['order'], 'number'],
            [['survey_id', 'custom_field_id'], 'unique', 'targetAttribute' => ['survey_id', 'custom_field_id'], 'message' => 'The combination of Survey and Custom field has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResults()
    {
        return $this->hasMany(SurveyResult::className(), ['survey_to_custom_field_id' => 'id', 'account_id' => 'account_id']);
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
    public function getCustomField()
    {
        return $this->hasOne(CustomField::className(), ['id' => 'custom_field_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

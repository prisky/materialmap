<?php

namespace common\models;

/**
 * This is the model class for table "tbl_survey_to_field_set".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $survey_id
 * @property integer $field_set_id
 * @property integer $level_id
 * @property integer $deleted
 *
 * @property Survey $survey
 * @property FieldSet $fieldSet
 * @property Account $account
 * @property Level $level
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
            [['account_id', 'survey_id', 'field_set_id', 'level_id'], 'required'],
            [['account_id', 'survey_id', 'field_set_id', 'level_id'], 'integer'],
            [['survey_id', 'field_set_id', 'account_id'], 'unique', 'targetAttribute' => ['survey_id', 'field_set_id', 'account_id'], 'message' => 'The combination of Account, Survey and Field set has already been taken.']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurvey()
    {
        return $this->hasOne(Survey::className(), ['id' => 'survey_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldSet()
    {
        return $this->hasOne(FieldSet::className(), ['id' => 'field_set_id']);
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
    public function getLevel()
    {
        return $this->hasOne(Level::className(), ['id' => 'level_id']);
    }
}

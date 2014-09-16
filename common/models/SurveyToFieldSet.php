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
}
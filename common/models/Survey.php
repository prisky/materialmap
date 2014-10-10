<?php

namespace common\models;

/**
 * This is the model class for table "tbl_survey".
 *
 * @property integer $id
 * @property integer $account_id
 * @property string $name
 * @property string $comment
 * @property string $deleted
 *
 * @property Account $account
 * @property SurveyToFieldSet[] $surveyToFieldSets
 * @property SurveyToResourceType[] $surveyToResourceTypes
 */
class Survey extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_survey';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'name'], 'required'],
            [['account_id'], 'integer'],
            [['comment'], 'string'],
            [['name'], 'string', 'max' => 64],
            [['account_id', 'name'], 'unique', 'targetAttribute' => ['account_id', 'name'], 'message' => 'The combination of Account and Name has already been taken.']
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
    public function getSurveyToFieldSets()
    {
        return $this->hasMany(SurveyToFieldSet::className(), ['survey_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyToResourceTypes()
    {
        return $this->hasMany(SurveyToResourceType::className(), ['survey_id' => 'id']);
    }
}

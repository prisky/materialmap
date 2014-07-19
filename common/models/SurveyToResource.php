<?php

namespace common\models;

/**
 * This is the model class for table "tbl_survey_to_resource".
 *
 * @property string $id
 * @property string $account_id
 * @property string $survey_id
 * @property string $resource_id
 * @property integer $deleted
 *
 * @property Survey $survey
 * @property Resource $resource
 * @property Account $account
 */
class SurveyToResource extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_survey_to_resource';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'survey_id', 'resource_id'], 'required'],
            [['account_id', 'survey_id', 'resource_id'], 'integer'],
            [['survey_id', 'resource_id'], 'unique', 'targetAttribute' => ['survey_id', 'resource_id'], 'message' => 'The combination of Survey and Resource has already been taken.']
        ];
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
    public function getResource()
    {
        return $this->hasOne(Resource::className(), ['id' => 'resource_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

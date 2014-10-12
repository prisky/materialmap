<?php

namespace common\models;

/**
 * This is the model class for table "tbl_survey_to_resource_type".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $survey_id
 * @property integer $resource_type_id
 * @property integer $deleted
 *
 * @property Survey $survey
 * @property ResourceType $resourceType
 * @property Account $account
 */
class SurveyToResourceType extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_survey_to_resource_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'survey_id', 'resource_type_id'], 'required'],
            [['account_id', 'survey_id', 'resource_type_id'], 'integer'],
            [['survey_id', 'resource_type_id'], 'unique', 'targetAttribute' => ['survey_id', 'resource_type_id'], 'message' => 'The combination of Survey and Resource type has already been taken.']
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
    public function getResourceType()
    {
        return $this->hasOne(ResourceType::className(), ['id' => 'resource_type_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

}

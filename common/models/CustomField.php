<?php

namespace common\models;

/**
 * This is the model class for table "tbl_custom_field".
 *
 * @property string $id
 * @property string $account_id
 * @property string $label
 * @property integer $allow_new
 * @property string $validation_type
 * @property string $data_type
 * @property integer $mandatory
 * @property string $comment
 * @property string $validation_text
 * @property string $validation_error
 * @property integer $deleted
 *
 * @property Account $account
 * @property ResourceToCustomField[] $resourceToCustomFields
 * @property SurveyToCustomField[] $surveyToCustomFields
 */
class CustomField extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_custom_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'label', 'validation_type', 'data_type'], 'required'],
            [['account_id', 'allow_new', 'mandatory'], 'integer'],
            [['validation_type', 'data_type', 'validation_text', 'validation_error'], 'string'],
            [['label'], 'string', 'max' => 64],
            [['comment'], 'string', 'max' => 255],
            [['account_id', 'label'], 'unique', 'targetAttribute' => ['account_id', 'label'], 'message' => 'The combination of Account and Label has already been taken.']
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
    public function getResourceToCustomFields()
    {
        return $this->hasMany(ResourceToCustomField::className(), ['custom_field_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyToCustomFields()
    {
        return $this->hasMany(SurveyToCustomField::className(), ['custom_field_id' => 'id', 'account_id' => 'account_id']);
    }
}

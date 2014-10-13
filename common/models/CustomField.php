<?php

namespace common\models;

/**
 * This is the model class for table "tbl_custom_field".
 *
 * @property integer $id
 * @property integer $account_id
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
 * @property FieldSetToCustomField[] $fieldSetToCustomFields
 * @property SurveyResultToBooking[] $surveyResultToBookings
 * @property SurveyResultToSummary[] $surveyResultToSummaries
 * @property SurveyResultToTicket[] $surveyResultToTickets
 * @property SurveyResultToTicketToSeat[] $surveyResultToTicketToSeats
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
            [['account_id', 'label', 'allow_new', 'validation_type', 'data_type', 'mandatory'], 'required'],
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
    public function getFieldSetToCustomFields()
    {
        return $this->hasMany(FieldSetToCustomField::className(), ['custom_field_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToBookings()
    {
        return $this->hasMany(SurveyResultToBooking::className(), ['custom_field_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToSummaries()
    {
        return $this->hasMany(SurveyResultToSummary::className(), ['custom_field_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToTickets()
    {
        return $this->hasMany(SurveyResultToTicket::className(), ['custom_field_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToTicketToSeats()
    {
        return $this->hasMany(SurveyResultToTicketToSeat::className(), ['custom_field_id' => 'id']);
    }

}

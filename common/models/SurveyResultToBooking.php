<?php

namespace common\models;

/**
 * This is the model class for table "tbl_survey_result_to_booking".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $booking_id
 * @property integer $survey_id
 * @property integer $custom_field_id
 * @property integer $field_set_id
 * @property integer $level_id
 * @property string $custom_value
 *
 * @property Account $account
 * @property CustomField $customField
 * @property BookingLevel $level
 */
class SurveyResultToBooking extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_survey_result_to_booking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'booking_id', 'survey_id', 'custom_field_id', 'field_set_id', 'level_id'], 'required'],
            [['account_id', 'booking_id', 'survey_id', 'custom_field_id', 'field_set_id', 'level_id'], 'integer'],
            [['custom_value'], 'string', 'max' => 255],
            [['survey_id', 'booking_id'], 'unique', 'targetAttribute' => ['survey_id', 'booking_id'], 'message' => 'The combination of Booking and Survey has already been taken.']
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
    public function getCustomField()
    {
        return $this->hasOne(CustomField::className(), ['id' => 'custom_field_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(BookingLevel::className(), ['id' => 'level_id']);
    }
}

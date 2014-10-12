<?php

namespace common\models;

/**
 * This is the model class for table "tbl_survey_result_to_ticket_to_seat".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $ticket_to_seat_id
 * @property integer $survey_id
 * @property integer $custom_field_id
 * @property integer $field_set_id
 * @property integer $level_id
 * @property string $custom_value
 *
 * @property TicketToSeat $ticketToSeat
 * @property Account $account
 * @property CustomField $customField
 * @property TicketToSeatToLevel $level
 */
class SurveyResultToTicketToSeat extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_survey_result_to_ticket_to_seat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'ticket_to_seat_id', 'survey_id', 'custom_field_id', 'field_set_id', 'level_id'], 'required'],
            [['account_id', 'ticket_to_seat_id', 'survey_id', 'custom_field_id', 'field_set_id', 'level_id'], 'integer'],
            [['custom_value'], 'string', 'max' => 255],
            [['survey_id', 'ticket_to_seat_id'], 'unique', 'targetAttribute' => ['survey_id', 'ticket_to_seat_id'], 'message' => 'The combination of Seat and Survey has already been taken.']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeat()
    {
        return $this->hasOne(TicketToSeat::className(), ['id' => 'ticket_to_seat_id']);
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
        return $this->hasOne(TicketToSeatToLevel::className(), ['id' => 'level_id']);
    }

}

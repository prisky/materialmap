<?php

namespace common\models;

/**
 * This is the model class for table "tbl_survey_result_to_ticket".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $ticket_id
 * @property integer $survey_id
 * @property integer $custom_field_id
 * @property integer $field_set_id
 * @property integer $level_id
 * @property string $custom_value
 *
 * @property Ticket $ticket
 * @property Account $account
 * @property CustomField $customField
 * @property TicketToLevel $level
 */
class SurveyResultToTicket extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_survey_result_to_ticket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'ticket_id', 'survey_id', 'custom_field_id', 'field_set_id', 'level_id'], 'required'],
            [['account_id', 'ticket_id', 'survey_id', 'custom_field_id', 'field_set_id', 'level_id'], 'integer'],
            [['custom_value'], 'string', 'max' => 255],
            [['survey_id', 'ticket_id'], 'unique', 'targetAttribute' => ['survey_id', 'ticket_id'], 'message' => 'The combination of Ticket and Survey has already been taken.']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
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
        return $this->hasOne(TicketToLevel::className(), ['id' => 'level_id']);
    }
}

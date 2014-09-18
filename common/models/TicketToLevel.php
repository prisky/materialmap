<?php

namespace common\models;

/**
 * This is the model class for table "tbl_ticket_to_level".
 *
 * @property integer $id
 *
 * @property SurveyResultToTicket[] $surveyResultToTickets
 * @property TicketToCustomField[] $ticketToCustomFields
 * @property TicketToItem[] $ticketToItems
 */
class TicketToLevel extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ticket_to_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToTickets()
    {
        return $this->hasMany(SurveyResultToTicket::className(), ['level_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToCustomFields()
    {
        return $this->hasMany(TicketToCustomField::className(), ['level_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToItems()
    {
        return $this->hasMany(TicketToItem::className(), ['level_id' => 'id']);
    }
}

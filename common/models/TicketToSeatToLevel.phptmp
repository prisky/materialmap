<?php

namespace common\models;

/**
 * This is the model class for table "tbl_ticket_to_seat_to_level".
 *
 * @property integer $id
 *
 * @property SurveyResultToTicketToSeat[] $surveyResultToTicketToSeats
 * @property TicketToSeatToCustomField[] $ticketToSeatToCustomFields
 * @property TicketToSeatToItem[] $ticketToSeatToItems
 */
class TicketToSeatToLevel extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ticket_to_seat_to_level';
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
    public function getSurveyResultToTicketToSeats()
    {
        return $this->hasMany(SurveyResultToTicketToSeat::className(), ['level_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToCustomFields()
    {
        return $this->hasMany(TicketToSeatToCustomField::className(), ['level_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToItems()
    {
        return $this->hasMany(TicketToSeatToItem::className(), ['level_id' => 'id']);
    }

}

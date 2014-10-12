<?php

namespace common\models;

/**
 * This is the model class for table "tbl_booking_level".
 *
 * @property integer $id
 *
 * @property BookingToCustomField[] $bookingToCustomFields
 * @property BookingToItem[] $bookingToItems
 * @property SurveyResultToBooking[] $surveyResultToBookings
 */
class BookingLevel extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_booking_level';
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
    public function getBookingToCustomFields()
    {
        return $this->hasMany(BookingToCustomField::className(), ['level_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingToItems()
    {
        return $this->hasMany(BookingToItem::className(), ['level_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToBookings()
    {
        return $this->hasMany(SurveyResultToBooking::className(), ['level_id' => 'id']);
    }

}

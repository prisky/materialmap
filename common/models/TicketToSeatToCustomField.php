<?php

namespace common\models;

/**
 * This is the model class for table "tbl_ticket_to_seat_to_custom_field".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $ticket_to_seat_id
 * @property integer $event_type_id
 * @property integer $field_set_id
 * @property integer $custom_field_id
 * @property integer $level_id
 * @property string $custom_value
 *
 * @property TicketToSeat $ticketToSeat
 * @property Account $account
 * @property TicketToSeatToLevel $level
 */
class TicketToSeatToCustomField extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ticket_to_seat_to_custom_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'ticket_to_seat_id', 'event_type_id', 'field_set_id', 'custom_field_id', 'level_id'], 'required'],
            [['account_id', 'ticket_to_seat_id', 'event_type_id', 'field_set_id', 'custom_field_id', 'level_id'], 'integer'],
            [['custom_value'], 'string', 'max' => 255],
            [['ticket_to_seat_id', 'event_type_id'], 'unique', 'targetAttribute' => ['ticket_to_seat_id', 'event_type_id'], 'message' => 'The combination of Seat and Event type has already been taken.']
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
    public function getLevel()
    {
        return $this->hasOne(TicketToSeatToLevel::className(), ['id' => 'level_id']);
    }

}

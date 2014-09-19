<?php

namespace common\models;

/**
 * This is the model class for table "tbl_ticket_to_custom_field".
 *
 * @property string $id
 * @property string $account_id
 * @property string $ticket_id
 * @property string $event_type_id
 * @property string $field_set_id
 * @property string $custom_field_id
 * @property integer $level_id
 * @property string $custom_value
 *
 * @property Ticket $ticket
 * @property Account $account
 * @property TicketToLevel $level
 */
class TicketToCustomField extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ticket_to_custom_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'ticket_id', 'event_type_id', 'field_set_id', 'custom_field_id', 'level_id'], 'required'],
            [['account_id', 'ticket_id', 'event_type_id', 'field_set_id', 'custom_field_id', 'level_id'], 'integer'],
            [['custom_value'], 'string', 'max' => 255],
            [['ticket_id', 'event_type_id'], 'unique', 'targetAttribute' => ['ticket_id', 'event_type_id'], 'message' => 'The combination of Ticket and Event type has already been taken.']
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
    public function getLevel()
    {
        return $this->hasOne(TicketToLevel::className(), ['id' => 'level_id']);
    }
}

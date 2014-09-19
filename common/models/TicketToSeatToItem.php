<?php

namespace common\models;

/**
 * This is the model class for table "tbl_ticket_to_seat_to_item".
 *
 * @property string $id
 * @property string $account_id
 * @property string $ticket_to_seat_id
 * @property string $event_type_id
 * @property string $item_id
 * @property string $field_set_id
 * @property string $item_group_id
 * @property integer $level_id
 * @property string $amount
 * @property integer $quantity
 *
 * @property Account $account
 * @property Item $item
 * @property TicketToSeat $ticketToSeat
 * @property TicketToSeatToLevel $level
 */
class TicketToSeatToItem extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ticket_to_seat_to_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'ticket_to_seat_id', 'event_type_id', 'item_id', 'field_set_id', 'item_group_id'], 'required'],
            [['account_id', 'ticket_to_seat_id', 'event_type_id', 'item_id', 'field_set_id', 'item_group_id', 'level_id', 'quantity'], 'integer'],
            [['amount'], 'number']
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
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
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
    public function getLevel()
    {
        return $this->hasOne(TicketToSeatToLevel::className(), ['id' => 'level_id']);
    }
}

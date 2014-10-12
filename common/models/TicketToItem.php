<?php

namespace common\models;

/**
 * This is the model class for table "tbl_ticket_to_item".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $ticket_id
 * @property integer $event_type_id
 * @property integer $item_id
 * @property integer $field_set_id
 * @property integer $item_group_id
 * @property integer $level_id
 * @property string $amount
 * @property integer $quantity
 *
 * @property Account $account
 * @property Item $item
 * @property Ticket $ticket
 * @property TicketToLevel $level
 */
class TicketToItem extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ticket_to_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'ticket_id', 'event_type_id', 'item_id', 'field_set_id', 'item_group_id', 'level_id', 'amount', 'quantity'], 'required'],
            [['account_id', 'ticket_id', 'event_type_id', 'item_id', 'field_set_id', 'item_group_id', 'level_id', 'quantity'], 'integer'],
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
    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(TicketToLevel::className(), ['id' => 'level_id']);
    }

}

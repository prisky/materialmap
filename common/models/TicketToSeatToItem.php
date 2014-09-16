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
 * @property string $amount
 * @property integer $quantity
 *
 * @property Account $account
 * @property Item $item
 * @property TicketToSeat $ticketToSeat
 * @property FieldSetToItemGroup $fieldSet
 * @property EventTypeToFieldSet $eventType
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
            [['account_id', 'ticket_to_seat_id', 'event_type_id', 'item_id', 'field_set_id', 'item_group_id', 'quantity'], 'integer'],
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
        return $this->hasOne(Item::className(), ['id' => 'item_id', 'account_id' => 'account_id', 'item_group_id' => 'item_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeat()
    {
        return $this->hasOne(TicketToSeat::className(), ['id' => 'ticket_to_seat_id', 'account_id' => 'account_id', 'event_type_id' => 'event_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldSet()
    {
        return $this->hasOne(FieldSetToItemGroup::className(), ['field_set_id' => 'field_set_id', 'account_id' => 'account_id', 'item_group_id' => 'item_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventType()
    {
        return $this->hasOne(EventTypeToFieldSet::className(), ['event_type_id' => 'event_type_id', 'account_id' => 'account_id', 'field_set_id' => 'field_set_id']);
    }
}

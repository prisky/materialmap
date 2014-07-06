<?php

namespace common\models;

/**
 * This is the model class for table "tbl_seat".
 *
 * @property string $id
 * @property string $account_id
 * @property string $resource_id
 * @property string $seat_type_id
 * @property string $root
 * @property string $lft
 * @property string $rgt
 * @property string $level
 * @property string $name
 * @property integer $x
 * @property integer $y
 * @property integer $deleted
 *
 * @property Resource $resource
 * @property SeatType $seatType
 * @property Account $account
 * @property SeatToTicketType[] $seatToTicketTypes
 * @property TicketToSeat[] $ticketToSeats
 */
class Seat extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_seat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'resource_id', 'seat_type_id', 'root', 'lft', 'rgt', 'level'], 'required'],
            [['account_id', 'resource_id', 'seat_type_id', 'root', 'lft', 'rgt', 'level', 'x', 'y'], 'integer'],
            [['account_id', 'resource_id', 'level', 'name'], 'unique', 'targetAttribute' => ['account_id', 'resource_id', 'level', 'name'], 'message' => 'The combination of Account, Resource, Level and  has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResource()
    {
        return $this->hasOne(Resource::className(), ['id' => 'resource_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeatType()
    {
        return $this->hasOne(SeatType::className(), ['id' => 'seat_type_id', 'account_id' => 'account_id']);
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
    public function getSeatToTicketTypes()
    {
        return $this->hasMany(SeatToTicketType::className(), ['seat_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeats()
    {
        return $this->hasMany(TicketToSeat::className(), ['seat_id' => 'id', 'account_id' => 'account_id']);
    }
}
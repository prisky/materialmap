<?php

namespace common\models;

/**
 * This is the model class for table "tbl_seat_type".
 *
 * @property string $id
 * @property string $account_id
 * @property string $name
 * @property integer $deleted
 *
 * @property Seat[] $seats
 * @property Account $account
 */
class SeatType extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_seat_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id'], 'required'],
            [['account_id'], 'integer'],
            [['account_id', 'name'], 'unique', 'targetAttribute' => ['account_id', 'name'], 'message' => 'The combination of Account and  has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeats()
    {
        return $this->hasMany(Seat::className(), ['seat_type_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

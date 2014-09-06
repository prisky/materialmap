<?php

namespace common\models;

/**
 * This is the model class for table "tbl_resource".
 *
 * @property string $id
 * @property string $account_id
 * @property string $resource_type_id
 * @property string $name
 * @property integer $deleted
 *
 * @property Event[] $events
 * @property ResourceType $account
 * @property Seat[] $seats
 */
class Resource extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_resource';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'resource_type_id', 'name'], 'required'],
            [['account_id', 'resource_type_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['account_id', 'name'], 'unique', 'targetAttribute' => ['account_id', 'name'], 'message' => 'The combination of Account and Name has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['account_id' => 'account_id', 'resource_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(ResourceType::className(), ['account_id' => 'account_id', 'id' => 'resource_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeats()
    {
        return $this->hasMany(Seat::className(), ['resource_id' => 'id', 'account_id' => 'account_id']);
    }
}

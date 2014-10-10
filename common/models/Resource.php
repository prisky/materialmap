<?php

namespace common\models;

/**
 * This is the model class for table "tbl_resource".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $resource_type_id
 * @property string $name
 * @property integer $deleted
 *
 * @property Event[] $events
 * @property Account $account
 * @property ResourceType $resourceType
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
        return $this->hasMany(Event::className(), ['resource_id' => 'id']);
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
    public function getResourceType()
    {
        return $this->hasOne(ResourceType::className(), ['id' => 'resource_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeats()
    {
        return $this->hasMany(Seat::className(), ['resource_id' => 'id']);
    }
}

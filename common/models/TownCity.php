<?php

namespace common\models;

/**
 * This is the model class for table "tbl_town_city".
 *
 * @property string $id
 * @property string $name
 * @property integer $state_province_id
 *
 * @property Address[] $addresses
 * @property StateProvince $stateProvince
 */
class TownCity extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_town_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'state_province_id'], 'required'],
            [['state_province_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['state_province_id', 'name'], 'unique', 'targetAttribute' => ['state_province_id', 'name'], 'message' => 'The combination of Name and State province has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['town_city_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStateProvince()
    {
        return $this->hasOne(StateProvince::className(), ['id' => 'state_province_id']);
    }
}

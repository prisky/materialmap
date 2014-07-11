<?php

namespace common\models;

/**
 * This is the model class for table "tbl_state_province".
 *
 * @property integer $id
 * @property string $name
 * @property integer $country_id
 *
 * @property Country $country
 * @property TownCity[] $townCities
 */
class StateProvince extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_state_province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'country_id'], 'required'],
            [['country_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['country_id', 'name'], 'unique', 'targetAttribute' => ['country_id', 'name'], 'message' => 'The combination of Name and Country has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTownCities()
    {
        return $this->hasMany(TownCity::className(), ['state_province_id' => 'id']);
    }
}

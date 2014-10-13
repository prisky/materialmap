<?php

namespace common\models;

/**
 * This is the model class for table "tbl_town_city".
 *
 * @property integer $id
 * @property string $name
 * @property integer $state_province_region
 *
 * @property Contact[] $contacts
 * @property StateProvinceRegion $stateProvinceRegion
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
            [['name', 'state_province_region'], 'required'],
            [['state_province_region'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['state_province_region', 'name'], 'unique', 'targetAttribute' => ['state_province_region', 'name'], 'message' => 'The combination of Name and State province region has already been taken.']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::className(), ['town_city_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStateProvinceRegion()
    {
        return $this->hasOne(StateProvinceRegion::className(), ['id' => 'state_province_region']);
    }

}

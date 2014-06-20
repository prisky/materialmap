<?php

namespace common\models;

/**
 * This is the model class for table "tbl_address".
 *
 * @property string $id
 * @property string $town_city_id
 * @property string $address_line1
 * @property string $address_line2
 * @property string $post_code
 *
 * @property Account[] $accounts
 * @property TownCity $townCity
 * @property ResourceToAddress[] $resourceToAddresses
 */
class Address extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['town_city_id', 'address_line1', 'address_line2', 'post_code'], 'required'],
            [['town_city_id'], 'integer'],
            [['address_line1', 'address_line2'], 'string', 'max' => 255],
            [['post_code'], 'string', 'max' => 16],
            [['town_city_id', 'address_line1', 'address_line2'], 'unique', 'targetAttribute' => ['town_city_id', 'address_line1', 'address_line2'], 'message' => 'The combination of Town city, Address line1 and Address line2 has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Account::className(), ['address_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTownCity()
    {
        return $this->hasOne(TownCity::className(), ['id' => 'town_city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceToAddresses()
    {
        return $this->hasMany(ResourceToAddress::className(), ['address_id' => 'id']);
    }
}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_country".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $currency_code
 * @property string $currency_symbol
 * @property string $phone_prefix
 * @property string $tax_name
 *
 * @property StateProvinceRegion[] $stateProvinceRegions
 */
class Country extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['code'], 'string', 'max' => 2],
            [['currency_code'], 'string', 'max' => 3],
            [['currency_symbol'], 'string', 'max' => 1],
            [['phone_prefix'], 'string', 'max' => 6],
            [['tax_name'], 'string', 'max' => 256],
            [['name'], 'unique'],
            [['code'], 'unique']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStateProvinceRegions()
    {
        return $this->hasMany(StateProvinceRegion::className(), ['country_id' => 'id']);
    }
}

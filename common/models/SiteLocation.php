<?php

namespace common\models;

/**
 * This is the model class for table "tbl_site_location".
 *
 * @property integer $id
 * @property string $name
 * @property string $latitude
 * @property string $longitude
 * @property integer $deleted
 */
class SiteLocation extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_site_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'latitude', 'longitude'], 'required'],
            [['name'], 'string', 'max' => 264],
            [['latitude', 'longitude'], 'string', 'max' => 255]
        ];
    }

}

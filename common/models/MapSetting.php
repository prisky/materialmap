<?php

namespace common\models;

/**
 * This is the model class for table "tbl_map_setting".
 *
 * @property integer $id
 * @property integer $map_type_id
 * @property integer $zoom_level
 * @property string $latitude
 * @property string $longitude
 *
 * @property MapType $mapType
 */
class MapSetting extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_map_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['map_type_id'], 'required'],
            [['map_type_id', 'zoom_level'], 'integer'],
            [['latitude', 'longitude'], 'string', 'max' => 255]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMapType()
    {
        return $this->hasOne(MapType::className(), ['id' => 'map_type_id']);
    }

}

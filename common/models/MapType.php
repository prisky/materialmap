<?php

namespace common\models;

/**
 * This is the model class for table "tbl_map_type".
 *
 * @property integer $id
 * @property string $name
 *
 * @property MapSetting[] $mapSettings
 */
class MapType extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_map_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMapSettings()
    {
        return $this->hasMany(MapSetting::className(), ['map_type_id' => 'id']);
    }

}

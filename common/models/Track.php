<?php

namespace common\models;

/**
 * This is the model class for table "tbl_track".
 *
 * @property integer $id
 * @property integer $marker_id
 * @property string $longitude
 * @property string $latitude
 * @property string $created
 *
 * @property Marker $marker
 */
class Track extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_track';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['marker_id'], 'required'],
            [['marker_id'], 'integer'],
            [['longitude', 'latitude'], 'string', 'max' => 255]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarker()
    {
        return $this->hasOne(Marker::className(), ['id' => 'marker_id']);
    }

}

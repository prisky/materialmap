<?php

namespace common\models;

/**
 * This is the model class for table "tbl_marker".
 *
 * @property integer $id
 * @property integer $rfid_tag_id
 * @property string $latitude
 * @property string $longitude
 *
 * @property RfidTag $rfidTag
 * @property Track[] $tracks
 */
class Marker extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_marker';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rfid_tag_id'], 'required'],
            [['rfid_tag_id'], 'integer'],
            [['latitude', 'longitude'], 'string', 'max' => 255]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRfidTag()
    {
        return $this->hasOne(RfidTag::className(), ['id' => 'rfid_tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTracks()
    {
        return $this->hasMany(Track::className(), ['marker_id' => 'id']);
    }

}

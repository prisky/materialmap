<?php

namespace common\models;

/**
 * This is the model class for table "tbl_rfid_tag".
 *
 * @property integer $id
 * @property integer $rfid_model_id
 * @property string $activation
 * @property string $name_plate
 * @property string $commodity_code
 * @property string $latitude
 * @property string $longitude
 * @property integer $deleted
 *
 * @property RfidModel $rfidModel
 * @property Track[] $tracks
 */
class RfidTag extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_rfid_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rfid_model_id', 'activation'], 'required'],
            [['rfid_model_id'], 'integer'],
            [['activation'], 'string'],
            [['name_plate', 'commodity_code', 'latitude', 'longitude'], 'string', 'max' => 255]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRfidModel()
    {
        return $this->hasOne(RfidModel::className(), ['id' => 'rfid_model_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTracks()
    {
        return $this->hasMany(Track::className(), ['rfid_tag_id' => 'id']);
    }

}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_rfid_tag".
 *
 * @property integer $id
 * @property integer $rfid_model_id
 * @property string $activation
 * @property integer $deleted
 * @property string $name_plate
 * @property string $commodity_code
 *
 * @property Marker[] $markers
 * @property RfidModel $rfidModel
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
            [['name_plate', 'commodity_code'], 'string', 'max' => 255]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarkers()
    {
        return $this->hasMany(Marker::className(), ['rfid_tag_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRfidModel()
    {
        return $this->hasOne(RfidModel::className(), ['id' => 'rfid_model_id']);
    }

}

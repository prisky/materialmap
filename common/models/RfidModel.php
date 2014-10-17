<?php

namespace common\models;

/**
 * This is the model class for table "tbl_rfid_model".
 *
 * @property integer $id
 * @property integer $manufacturer_id
 * @property string $name
 * @property integer $deleted
 *
 * @property Manufacturer $manufacturer
 * @property RfidTag[] $rfidTags
 */
class RfidModel extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_rfid_model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manufacturer_id', 'name'], 'required'],
            [['manufacturer_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['manufacturer_id', 'name'], 'unique', 'targetAttribute' => ['manufacturer_id', 'name'], 'message' => 'The combination of Manufacturer and Name has already been taken.']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturer()
    {
        return $this->hasOne(Manufacturer::className(), ['id' => 'manufacturer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRfidTags()
    {
        return $this->hasMany(RfidTag::className(), ['rfid_model_id' => 'id']);
    }

}

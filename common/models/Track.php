<?php

namespace common\models;

/**
 * This is the model class for table "tbl_track".
 *
 * @property integer $id
 * @property integer $rfid_tag_id
 * @property string $longitude
 * @property string $latitude
 * @property string $created
 *
 * @property RfidTag $rfidTag
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
            [['rfid_tag_id'], 'required'],
            [['rfid_tag_id'], 'integer'],
            [['longitude', 'latitude'], 'string', 'max' => 255]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRfidTag()
    {
        return $this->hasOne(RfidTag::className(), ['id' => 'rfid_tag_id']);
    }

}

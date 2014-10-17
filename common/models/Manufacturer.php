<?php

namespace common\models;

/**
 * This is the model class for table "tbl_manufacturer".
 *
 * @property integer $id
 * @property string $name
 * @property integer $deleted
 *
 * @property ReaderModel[] $readerModels
 * @property RfidModel[] $rfidModels
 */
class Manufacturer extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_manufacturer';
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
    public function getReaderModels()
    {
        return $this->hasMany(ReaderModel::className(), ['manufacturer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRfidModels()
    {
        return $this->hasMany(RfidModel::className(), ['manufacturer_id' => 'id']);
    }

}

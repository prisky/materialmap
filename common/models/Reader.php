<?php

namespace common\models;

/**
 * This is the model class for table "tbl_reader".
 *
 * @property integer $id
 * @property integer $rfid_model_id
 * @property string $name
 * @property string $activation
 * @property integer $deleted
 *
 * @property ReaderModel $rfidModel
 */
class Reader extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_reader';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rfid_model_id', 'name', 'activation'], 'required'],
            [['rfid_model_id'], 'integer'],
            [['activation'], 'string'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRfidModel()
    {
        return $this->hasOne(ReaderModel::className(), ['id' => 'rfid_model_id']);
    }

}

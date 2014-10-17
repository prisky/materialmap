<?php

namespace common\models;

/**
 * This is the model class for table "tbl_bom".
 *
 * @property integer $id
 * @property integer $commodity_code_id
 * @property string $name
 * @property string $size1
 * @property string $size2
 * @property string $wbs
 *
 * @property CommodityCode $commodityCode
 */
class Bom extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['commodity_code_id', 'name'], 'required'],
            [['commodity_code_id'], 'integer'],
            [['name', 'size1', 'size2', 'wbs'], 'string', 'max' => 255],
            [['name'], 'unique']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommodityCode()
    {
        return $this->hasOne(CommodityCode::className(), ['id' => 'commodity_code_id']);
    }

}

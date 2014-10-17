<?php

namespace common\models;

/**
 * This is the model class for table "tbl_commodity_code".
 *
 * @property integer $id
 * @property string $code
 * @property string $description
 * @property string $purchase_description
 *
 * @property Bom[] $boms
 */
class CommodityCode extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_commodity_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'description'], 'required'],
            [['code', 'description', 'purchase_description'], 'string', 'max' => 255],
            [['code'], 'unique']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoms()
    {
        return $this->hasMany(Bom::className(), ['commodity_code_id' => 'id']);
    }

}

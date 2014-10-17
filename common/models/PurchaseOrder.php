<?php

namespace common\models;

/**
 * This is the model class for table "tbl_purchase_order".
 *
 * @property integer $id
 * @property string $name
 * @property string $construction_work_pack
 */
class PurchaseOrder extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_purchase_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'construction_work_pack'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['construction_work_pack'], 'string', 'max' => 255]
        ];
    }

}

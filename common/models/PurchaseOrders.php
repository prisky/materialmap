<?php

namespace common\models;

/**
 * This is the model class for table "tbl_purchase_orders".
 *
 * @property integer $id
 * @property string $name
 * @property string $construction_work_pack
 */
class PurchaseOrders extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_purchase_orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
        ];
    }

}

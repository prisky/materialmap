<?php

namespace common\models;

/**
 * This is the model class for table "tbl_item_inventory".
 *
 * @property integer $id
 * @property integer $item_id
 * @property integer $account_id
 * @property integer $quantity
 * @property string $received
 *
 * @property Item $item
 */
class ItemInventory extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_item_inventory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'account_id', 'quantity', 'received'], 'required'],
            [['item_id', 'account_id', 'quantity'], 'integer'],
            [['received'], 'safe']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

}

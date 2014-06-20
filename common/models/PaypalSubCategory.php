<?php

namespace common\models;

/**
 * This is the model class for table "tbl_paypal_sub_category".
 *
 * @property string $id
 * @property string $paypal_category_id
 * @property string $name
 *
 * @property PaypalCategory $paypalCategory
 */
class PaypalSubCategory extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_paypal_sub_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['paypal_category_id'], 'required'],
            [['paypal_category_id'], 'integer'],
            [['paypal_category_id', 'name'], 'unique', 'targetAttribute' => ['paypal_category_id', 'name'], 'message' => 'The combination of Paypal category and  has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaypalCategory()
    {
        return $this->hasOne(PaypalCategory::className(), ['id' => 'paypal_category_id']);
    }
}

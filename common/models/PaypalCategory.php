<?php

namespace common\models;

/**
 * This is the model class for table "tbl_paypal_category".
 *
 * @property string $id
 * @property string $name
 *
 * @property PaypalSubCategory[] $paypalSubCategories
 */
class PaypalCategory extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_paypal_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'unique']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaypalSubCategories()
    {
        return $this->hasMany(PaypalSubCategory::className(), ['paypal_category_id' => 'id']);
    }
}

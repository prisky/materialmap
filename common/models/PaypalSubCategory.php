<?php

namespace common\models;

/**
 * This is the model class for table "tbl_paypal_sub_category".
 *
 * @property integer $id
 * @property integer $paypal_category_id
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
            [['paypal_category_id', 'name'], 'required'],
            [['paypal_category_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['paypal_category_id', 'name'], 'unique', 'targetAttribute' => ['paypal_category_id', 'name'], 'message' => 'The combination of Paypal category and Name has already been taken.']
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

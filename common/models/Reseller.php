<?php

namespace common\models;

/**
 * This is the model class for table "tbl_reseller".
 *
 * @property string $id
 * @property string $account_id
 * @property integer $trial_days
 * @property integer $expiry_days
 * @property string $rate
 * @property integer $child_admin
 *
 * @property Coupon[] $coupons
 * @property Account $account
 * @property StandardSetup[] $standardSetups
 */
class Reseller extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_reseller';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id'], 'required'],
            [['account_id', 'trial_days', 'expiry_days', 'child_admin'], 'integer'],
            [['rate'], 'number'],
            [['account_id'], 'unique']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoupons()
    {
        return $this->hasMany(Coupon::className(), ['reseller_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStandardSetups()
    {
        return $this->hasMany(StandardSetup::className(), ['reseller_id' => 'id']);
    }
}

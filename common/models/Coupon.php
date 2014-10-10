<?php

namespace common\models;

/**
 * This is the model class for table "tbl_coupon".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $reseller_id
 * @property string $uniqueid
 * @property string $expiry
 * @property string $created
 *
 * @property Account $account
 * @property Reseller $reseller
 */
class Coupon extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_coupon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'reseller_id'], 'integer'],
            [['reseller_id', 'uniqueid'], 'required'],
            [['expiry'], 'safe'],
            [['uniqueid'], 'string', 'max' => 13],
            [['uniqueid'], 'unique'],
            [['account_id'], 'unique']
        ];
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
    public function getReseller()
    {
        return $this->hasOne(Reseller::className(), ['id' => 'reseller_id']);
    }
}

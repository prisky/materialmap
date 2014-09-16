<?php

namespace common\models;

/**
 * This is the model class for table "tbl_account_to_affiliate_category".
 *
 * @property string $id
 * @property string $account_id
 * @property string $affiliate_category_id
 * @property string $rate
 *
 * @property Account $account
 * @property AffiliateCategory $affiliateCategory
 */
class AccountToAffiliateCategory extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_account_to_affiliate_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'affiliate_category_id'], 'required'],
            [['account_id', 'affiliate_category_id'], 'integer'],
            [['rate'], 'number'],
            [['account_id', 'affiliate_category_id'], 'unique', 'targetAttribute' => ['account_id', 'affiliate_category_id'], 'message' => 'The combination of Account and Affiliate category has already been taken.']
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
    public function getAffiliateCategory()
    {
        return $this->hasOne(AffiliateCategory::className(), ['id' => 'affiliate_category_id']);
    }
}

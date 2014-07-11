<?php

namespace common\models;

/**
 * This is the model class for table "tbl_affiliate_category".
 *
 * @property string $id
 * @property string $account_id
 * @property string $root
 * @property string $lft
 * @property string $rgt
 * @property string $level
 * @property string $name
 *
 * @property AccountToAffiliateCategory[] $accountToAffiliateCategories
 * @property Account $account
 */
class AffiliateCategory extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_affiliate_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'root', 'lft', 'rgt', 'level', 'name'], 'required'],
            [['account_id', 'root', 'lft', 'rgt', 'level'], 'integer'],
            [['name'], 'string', 'max' => 64]
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountToAffiliateCategories()
    {
        return $this->hasMany(AccountToAffiliateCategory::className(), ['account_id' => 'account_id', 'affiliate_category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

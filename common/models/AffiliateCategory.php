<?php

namespace common\models;

/**
 * This is the model class for table "tbl_affiliate_category".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
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
        return $this->hasMany(AccountToAffiliateCategory::className(), ['affiliate_category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

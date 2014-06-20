<?php

namespace common\models;

/**
 * This is the model class for table "tbl_percent_promotion".
 *
 * @property string $id
 * @property string $account_id
 * @property string $rate
 *
 * @property Account $account
 * @property PercentPromotionConstraint[] $percentPromotionConstraints
 * @property SummaryToPercentPromotion[] $summaryToPercentPromotions
 */
class PercentPromotion extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_percent_promotion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'rate'], 'required'],
            [['account_id'], 'integer'],
            [['rate'], 'number']
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
    public function getPercentPromotionConstraints()
    {
        return $this->hasMany(PercentPromotionConstraint::className(), ['percent_promotion_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToPercentPromotions()
    {
        return $this->hasMany(SummaryToPercentPromotion::className(), ['percent_promotion_id' => 'id', 'account_id' => 'account_id']);
    }
}

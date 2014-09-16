<?php

namespace common\models;

/**
 * This is the model class for table "tbl_promotion".
 *
 * @property string $id
 * @property string $account_id
 * @property string $amount
 * @property string $uniqueid
 *
 * @property Account $account
 * @property PromotionConstraint[] $promotionConstraints
 * @property SummaryToPromotion[] $summaryToPromotions
 */
class Promotion extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_promotion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'amount', 'uniqueid'], 'required'],
            [['account_id'], 'integer'],
            [['amount'], 'number'],
            [['uniqueid'], 'string', 'max' => 13],
            [['uniqueid'], 'unique']
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
    public function getPromotionConstraints()
    {
        return $this->hasMany(PromotionConstraint::className(), ['promotion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToPromotions()
    {
        return $this->hasMany(SummaryToPromotion::className(), ['promotion_id' => 'id']);
    }
}

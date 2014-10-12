<?php

namespace common\models;

/**
 * This is the model class for table "tbl_percent_promotion_constraint".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $percent_promotion_id
 * @property string $invalid_from
 * @property string $invalid_to
 *
 * @property Account $account
 * @property PercentPromotion $percentPromotion
 */
class PercentPromotionConstraint extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_percent_promotion_constraint';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'percent_promotion_id'], 'required'],
            [['account_id', 'percent_promotion_id'], 'integer'],
            [['invalid_from', 'invalid_to'], 'safe'],
            [['percent_promotion_id', 'invalid_from'], 'unique', 'targetAttribute' => ['percent_promotion_id', 'invalid_from'], 'message' => 'The combination of Percent promotion and Invalid from has already been taken.'],
            [['percent_promotion_id', 'invalid_to'], 'unique', 'targetAttribute' => ['percent_promotion_id', 'invalid_to'], 'message' => 'The combination of  and Percent promotion has already been taken.']
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
    public function getPercentPromotion()
    {
        return $this->hasOne(PercentPromotion::className(), ['id' => 'percent_promotion_id']);
    }

}

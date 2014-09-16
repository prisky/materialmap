<?php

namespace common\models;

/**
 * This is the model class for table "tbl_promotion_constraint".
 *
 * @property string $id
 * @property string $account_id
 * @property string $promotion_id
 * @property string $invalid_from
 * @property string $invalid_to
 *
 * @property Account $account
 * @property Promotion $promotion
 */
class PromotionConstraint extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_promotion_constraint';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'promotion_id'], 'required'],
            [['account_id', 'promotion_id'], 'integer'],
            [['invalid_from', 'invalid_to'], 'safe'],
            [['promotion_id', 'invalid_from'], 'unique', 'targetAttribute' => ['promotion_id', 'invalid_from'], 'message' => 'The combination of Promotion and Invalid from has already been taken.'],
            [['promotion_id', 'invalid_to'], 'unique', 'targetAttribute' => ['promotion_id', 'invalid_to'], 'message' => 'The combination of  and Promotion has already been taken.']
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
    public function getPromotion()
    {
        return $this->hasOne(Promotion::className(), ['id' => 'promotion_id']);
    }
}

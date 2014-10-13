<?php

namespace common\models;

/**
 * This is the model class for table "tbl_summary_to_promotion".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $summary_id
 * @property integer $promotion_id
 *
 * @property Summary $summary
 * @property Promotion $promotion
 * @property Account $account
 */
class SummaryToPromotion extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_summary_to_promotion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'summary_id', 'promotion_id'], 'required'],
            [['account_id', 'summary_id', 'promotion_id'], 'integer'],
            [['summary_id', 'promotion_id'], 'unique', 'targetAttribute' => ['summary_id', 'promotion_id'], 'message' => 'The combination of Summary and Promotion has already been taken.']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummary()
    {
        return $this->hasOne(Summary::className(), ['id' => 'summary_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotion()
    {
        return $this->hasOne(Promotion::className(), ['id' => 'promotion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_summary_to_percent_promotion".
 *
 * @property string $id
 * @property string $account_id
 * @property string $summary_id
 * @property string $percent_promotion_id
 *
 * @property Account $account
 * @property PercentPromotion $percentPromotion
 * @property Summary $summary
 */
class SummaryToPercentPromotion extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_summary_to_percent_promotion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'summary_id', 'percent_promotion_id'], 'required'],
            [['account_id', 'summary_id', 'percent_promotion_id'], 'integer'],
            [['summary_id', 'percent_promotion_id'], 'unique', 'targetAttribute' => ['summary_id', 'percent_promotion_id'], 'message' => 'The combination of Summary and Percent promotion has already been taken.']
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
        return $this->hasOne(PercentPromotion::className(), ['id' => 'percent_promotion_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummary()
    {
        return $this->hasOne(Summary::className(), ['id' => 'summary_id', 'account_id' => 'account_id']);
    }
}

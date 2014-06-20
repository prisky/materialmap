<?php

namespace common\models;

/**
 * This is the model class for table "tbl_cancellation_policy".
 *
 * @property string $id
 * @property string $account_id
 * @property string $begin
 * @property string $finish
 * @property integer $days
 * @property string $rate
 * @property string $base_fee
 *
 * @property Account $account
 */
class CancellationPolicy extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_cancellation_policy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'begin', 'days'], 'required'],
            [['account_id', 'days'], 'integer'],
            [['begin', 'finish'], 'safe'],
            [['rate', 'base_fee'], 'number']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

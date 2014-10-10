<?php

namespace common\models;

/**
 * This is the model class for table "tbl_reminder".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $hours_prior
 *
 * @property Account $account
 */
class Reminder extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_reminder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'hours_prior'], 'required'],
            [['account_id', 'hours_prior'], 'integer'],
            [['account_id', 'hours_prior'], 'unique', 'targetAttribute' => ['account_id', 'hours_prior'], 'message' => 'The combination of Account and Hours prior has already been taken.']
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

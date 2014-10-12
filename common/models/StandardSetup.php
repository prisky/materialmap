<?php

namespace common\models;

/**
 * This is the model class for table "tbl_standard_setup".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $reseller_id
 *
 * @property Account $account
 * @property Reseller $reseller
 */
class StandardSetup extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_standard_setup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id'], 'required'],
            [['account_id', 'reseller_id'], 'integer'],
            [['account_id', 'reseller_id'], 'unique', 'targetAttribute' => ['account_id', 'reseller_id'], 'message' => 'The combination of Account and Reseller has already been taken.']
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
    public function getReseller()
    {
        return $this->hasOne(Reseller::className(), ['id' => 'reseller_id']);
    }

}

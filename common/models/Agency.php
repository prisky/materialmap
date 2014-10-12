<?php

namespace common\models;

/**
 * This is the model class for table "tbl_agency".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $supplier_account_id
 *
 * @property Account $supplierAccount
 * @property Account $account
 */
class Agency extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_agency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'supplier_account_id'], 'required'],
            [['account_id', 'supplier_account_id'], 'integer'],
            [['account_id', 'supplier_account_id'], 'unique', 'targetAttribute' => ['account_id', 'supplier_account_id'], 'message' => 'The combination of Account and Supplier account has already been taken.']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplierAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'supplier_account_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

}

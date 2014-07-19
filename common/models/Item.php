<?php

namespace common\models;

/**
 * This is the model class for table "tbl_item".
 *
 * @property string $id
 * @property string $account_id
 * @property string $extra_id
 * @property string $name
 * @property string $amount
 * @property integer $inventory
 * @property integer $deleted
 *
 * @property Extra $extra
 * @property Account $account
 */
class Item extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'extra_id', 'name'], 'required'],
            [['account_id', 'extra_id', 'inventory'], 'integer'],
            [['amount'], 'number'],
            [['name'], 'string', 'max' => 64],
            [['extra_id', 'name'], 'unique', 'targetAttribute' => ['extra_id', 'name'], 'message' => 'The combination of Extra and Name has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExtra()
    {
        return $this->hasOne(Extra::className(), ['id' => 'extra_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

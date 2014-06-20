<?php

namespace common\models;

/**
 * This is the model class for table "tbl_extra".
 *
 * @property string $id
 * @property string $account_id
 * @property string $name
 * @property integer $mandatory
 * @property integer $minimum
 * @property integer $maximum
 * @property integer $deleted
 *
 * @property Account $account
 * @property Item[] $items
 * @property ResourceToExtra[] $resourceToExtras
 */
class Extra extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_extra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id'], 'required'],
            [['account_id', 'mandatory', 'minimum', 'maximum'], 'integer'],
            [['account_id', 'name'], 'unique', 'targetAttribute' => ['account_id', 'name'], 'message' => 'The combination of Account and  has already been taken.']
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
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['extra_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceToExtras()
    {
        return $this->hasMany(ResourceToExtra::className(), ['extra_id' => 'id', 'account_id' => 'account_id']);
    }
}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_auth_item_child".
 *
 * @property integer $id
 * @property string $parent
 * @property string $child
 * @property integer $account_id
 *
 * @property Account $account
 */
class AuthItemChild extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_auth_item_child';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent', 'child'], 'required'],
            [['account_id'], 'integer'],
            [['parent', 'child'], 'string', 'max' => 64],
            [['parent', 'child'], 'unique', 'targetAttribute' => ['parent', 'child'], 'message' => 'The combination of Parent and Child has already been taken.']
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

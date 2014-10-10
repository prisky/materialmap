<?php

namespace common\models;

/**
 * This is the model class for table "tbl_auth_item".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property string $data
 * @property string $rule_name
 * @property string $description
 * @property integer $account_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Account $account
 */
class AuthItem extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_auth_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'account_id'], 'integer'],
            [['data', 'description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['name'], 'unique']
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

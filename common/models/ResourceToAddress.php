<?php

namespace common\models;

/**
 * This is the model class for table "tbl_resource_to_address".
 *
 * @property string $id
 * @property string $account_id
 * @property string $address_id
 * @property string $resource_id
 *
 * @property Address $address
 * @property Resource $resource
 * @property Account $account
 */
class ResourceToAddress extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_resource_to_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'address_id', 'resource_id'], 'required'],
            [['account_id', 'address_id', 'resource_id'], 'integer'],
            [['resource_id', 'address_id'], 'unique', 'targetAttribute' => ['resource_id', 'address_id'], 'message' => 'The combination of Address and Resource has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResource()
    {
        return $this->hasOne(Resource::className(), ['id' => 'resource_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

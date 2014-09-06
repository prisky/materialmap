<?php

namespace common\models;

/**
 * This is the model class for table "tbl_resource_type_to_extra".
 *
 * @property string $id
 * @property string $account_id
 * @property string $resource_type_id
 * @property string $extra_id
 * @property integer $deleted
 *
 * @property EventTypeToResourceTypeToExtra[] $eventTypeToResourceTypeToExtras
 * @property Account $account
 * @property Extra $extra
 */
class ResourceTypeToExtra extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_resource_type_to_extra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'resource_type_id', 'extra_id'], 'required'],
            [['account_id', 'resource_type_id', 'extra_id'], 'integer'],
            [['resource_type_id', 'extra_id'], 'unique', 'targetAttribute' => ['resource_type_id', 'extra_id'], 'message' => 'The combination of Resource type and Extra has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTypeToResourceTypeToExtras()
    {
        return $this->hasMany(EventTypeToResourceTypeToExtra::className(), ['resource_type_to_extra_id' => 'id', 'account_id' => 'account_id']);
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
    public function getExtra()
    {
        return $this->hasOne(Extra::className(), ['id' => 'extra_id', 'account_id' => 'account_id']);
    }
}

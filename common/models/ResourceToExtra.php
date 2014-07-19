<?php

namespace common\models;

/**
 * This is the model class for table "tbl_resource_to_extra".
 *
 * @property string $id
 * @property string $account_id
 * @property string $resource_id
 * @property string $extra_id
 * @property integer $deleted
 *
 * @property EventToResourceToExtra[] $eventToResourceToExtras
 * @property Resource $resource
 * @property Extra $extra
 * @property Account $account
 */
class ResourceToExtra extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_resource_to_extra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'resource_id', 'extra_id'], 'required'],
            [['account_id', 'resource_id', 'extra_id'], 'integer'],
            [['resource_id', 'extra_id'], 'unique', 'targetAttribute' => ['resource_id', 'extra_id'], 'message' => 'The combination of Resource and Extra has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventToResourceToExtras()
    {
        return $this->hasMany(EventToResourceToExtra::className(), ['resource_to_extra_id' => 'id', 'account_id' => 'account_id']);
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

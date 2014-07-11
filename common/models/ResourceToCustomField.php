<?php

namespace common\models;

/**
 * This is the model class for table "tbl_resource_to_custom_field".
 *
 * @property string $id
 * @property string $account_id
 * @property string $resource_id
 * @property string $custom_field_id
 * @property integer $deleted
 *
 * @property EventToResourceToCustomField[] $eventToResourceToCustomFields
 * @property Account $account
 * @property CustomField $customField
 * @property Resource $resource
 */
class ResourceToCustomField extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_resource_to_custom_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'resource_id', 'custom_field_id'], 'required'],
            [['account_id', 'resource_id', 'custom_field_id'], 'integer'],
            [['resource_id', 'custom_field_id'], 'unique', 'targetAttribute' => ['resource_id', 'custom_field_id'], 'message' => 'The combination of Resource and Custom field has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventToResourceToCustomFields()
    {
        return $this->hasMany(EventToResourceToCustomField::className(), ['resource_to_custom_field_id' => 'id', 'account_id' => 'account_id']);
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
    public function getCustomField()
    {
        return $this->hasOne(CustomField::className(), ['id' => 'custom_field_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResource()
    {
        return $this->hasOne(Resource::className(), ['id' => 'resource_id', 'account_id' => 'account_id']);
    }
}

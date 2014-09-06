<?php

namespace common\models;

/**
 * This is the model class for table "tbl_event_type_to_resource_type".
 *
 * @property string $id
 * @property string $account_id
 * @property string $event_type_id
 * @property string $resource_type_id
 *
 * @property Account $account
 */
class EventTypeToResourceType extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_event_type_to_resource_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'event_type_id', 'resource_type_id'], 'required'],
            [['account_id', 'event_type_id', 'resource_type_id'], 'integer']
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

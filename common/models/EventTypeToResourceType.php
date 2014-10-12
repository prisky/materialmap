<?php

namespace common\models;

/**
 * This is the model class for table "tbl_event_type_to_resource_type".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $event_type_id
 * @property integer $resource_type_id
 * @property integer $deleted
 *
 * @property EventType $eventType
 * @property ResourceType $resourceType
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
    public function getEventType()
    {
        return $this->hasOne(EventType::className(), ['id' => 'event_type_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceType()
    {
        return $this->hasOne(ResourceType::className(), ['id' => 'resource_type_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

}

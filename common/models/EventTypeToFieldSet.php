<?php

namespace common\models;

/**
 * This is the model class for table "tbl_event_type_to_field_set".
 *
 * @property string $id
 * @property string $account_id
 * @property string $event_type_id
 * @property string $field_set_id
 * @property integer $deleted
 *
 * @property Account $account
 * @property EventType $eventType
 * @property FieldSet $fieldSet
 */
class EventTypeToFieldSet extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_event_type_to_field_set';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'event_type_id', 'field_set_id'], 'required'],
            [['account_id', 'event_type_id', 'field_set_id'], 'integer']
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
    public function getEventType()
    {
        return $this->hasOne(EventType::className(), ['id' => 'event_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldSet()
    {
        return $this->hasOne(FieldSet::className(), ['id' => 'field_set_id']);
    }
}

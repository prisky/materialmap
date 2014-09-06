<?php

namespace common\models;

/**
 * This is the model class for table "tbl_summary_to_event_type_to_resource_to_custom_field".
 *
 * @property string $id
 * @property string $account_id
 * @property string $summary_id
 * @property string $event_type_to_resource_to_custom_field_id
 * @property string $custom_value
 *
 * @property Summary $summary
 * @property EventTypeToResourceTypeToCustomField $eventTypeToResourceToCustomField
 * @property Account $account
 */
class SummaryToEventTypeToResourceToCustomField extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_summary_to_event_type_to_resource_to_custom_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['summary_id', 'event_type_to_resource_to_custom_field_id'], 'unique', 'targetAttribute' => ['summary_id', 'event_type_to_resource_to_custom_field_id'], 'message' => 'The combination of  and  has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummary()
    {
        return $this->hasOne(Summary::className(), ['id' => 'summary_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTypeToResourceToCustomField()
    {
        return $this->hasOne(EventTypeToResourceTypeToCustomField::className(), ['id' => 'event_type_to_resource_to_custom_field_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

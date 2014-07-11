<?php

namespace common\models;

/**
 * This is the model class for table "tbl_summary_to_event_to_resource_to_custom_field".
 *
 * @property string $id
 * @property string $account_id
 * @property string $summary_id
 * @property string $event_to_resource_to_custom_field_id
 * @property string $custom_value
 *
 * @property Account $account
 * @property EventToResourceToCustomField $eventToResourceToCustomField
 * @property Summary $summary
 */
class SummaryToEventToResourceToCustomField extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_summary_to_event_to_resource_to_custom_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'summary_id', 'event_to_resource_to_custom_field_id'], 'required'],
            [['account_id', 'summary_id', 'event_to_resource_to_custom_field_id'], 'integer'],
            [['custom_value'], 'string', 'max' => 255],
            [['summary_id', 'event_to_resource_to_custom_field_id'], 'unique', 'targetAttribute' => ['summary_id', 'event_to_resource_to_custom_field_id'], 'message' => 'The combination of Summary and Custom field has already been taken.']
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
    public function getEventToResourceToCustomField()
    {
        return $this->hasOne(EventToResourceToCustomField::className(), ['id' => 'event_to_resource_to_custom_field_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummary()
    {
        return $this->hasOne(Summary::className(), ['id' => 'summary_id', 'account_id' => 'account_id']);
    }
}

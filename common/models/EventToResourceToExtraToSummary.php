<?php

namespace common\models;

/**
 * This is the model class for table "tbl_event_to_resource_to_extra_to_summary".
 *
 * @property string $id
 * @property string $account_id
 * @property string $event_to_resource_to_extra_id
 * @property string $summary_id
 * @property string $amount
 * @property integer $quantity
 *
 * @property EventToResourceToExtra $account
 * @property Summary $summary
 */
class EventToResourceToExtraToSummary extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_event_to_resource_to_extra_to_summary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'event_to_resource_to_extra_id', 'summary_id'], 'required'],
            [['account_id', 'event_to_resource_to_extra_id', 'summary_id', 'quantity'], 'integer'],
            [['amount'], 'number'],
            [['event_to_resource_to_extra_id'], 'unique']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(EventToResourceToExtra::className(), ['account_id' => 'account_id', 'id' => 'event_to_resource_to_extra_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummary()
    {
        return $this->hasOne(Summary::className(), ['id' => 'summary_id']);
    }
}

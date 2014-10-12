<?php

namespace common\models;

/**
 * This is the model class for table "tbl_summary_to_custom_field".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $summary_id
 * @property integer $field_set_id
 * @property integer $custom_field_id
 * @property integer $level_id
 * @property string $custom_value
 *
 * @property Summary $summary
 * @property Account $account
 * @property SummaryLevel $level
 */
class SummaryToCustomField extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_summary_to_custom_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'summary_id', 'field_set_id', 'custom_field_id', 'level_id'], 'required'],
            [['account_id', 'summary_id', 'field_set_id', 'custom_field_id', 'level_id'], 'integer'],
            [['custom_value'], 'string', 'max' => 255],
            [['summary_id', 'field_set_id'], 'unique', 'targetAttribute' => ['summary_id', 'field_set_id'], 'message' => 'The combination of Summary and Field set has already been taken.']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummary()
    {
        return $this->hasOne(Summary::className(), ['id' => 'summary_id']);
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
    public function getLevel()
    {
        return $this->hasOne(SummaryLevel::className(), ['id' => 'level_id']);
    }

}

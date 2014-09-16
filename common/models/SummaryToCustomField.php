<?php

namespace common\models;

/**
 * This is the model class for table "tbl_summary_to_custom_field".
 *
 * @property string $id
 * @property string $account_id
 * @property string $summary_id
 * @property string $field_set_id
 * @property string $custom_field_id
 * @property string $custom_value
 *
 * @property Summary $summary
 * @property FieldSetToCustomField $fieldSet
 * @property Account $account
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
            [['account_id', 'summary_id', 'field_set_id', 'custom_field_id'], 'required'],
            [['account_id', 'summary_id', 'field_set_id', 'custom_field_id'], 'integer'],
            [['custom_value'], 'string', 'max' => 255],
            [['summary_id', 'field_set_id'], 'unique', 'targetAttribute' => ['summary_id', 'field_set_id'], 'message' => 'The combination of Summary and Field set has already been taken.']
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
    public function getFieldSet()
    {
        return $this->hasOne(FieldSetToCustomField::className(), ['field_set_id' => 'field_set_id', 'custom_field_id' => 'custom_field_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

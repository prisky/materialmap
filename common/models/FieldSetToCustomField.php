<?php

namespace common\models;

/**
 * This is the model class for table "tbl_field_set_to_custom_field".
 *
 * @property string $id
 * @property string $account_id
 * @property string $field_set_id
 * @property string $custom_field_id
 * @property integer $deleted
 *
 * @property FieldSet $fieldSet
 * @property CustomField $customField
 */
class FieldSetToCustomField extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_field_set_to_custom_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'field_set_id', 'custom_field_id'], 'required'],
            [['account_id', 'field_set_id', 'custom_field_id'], 'integer'],
            [['field_set_id', 'custom_field_id', 'account_id'], 'unique', 'targetAttribute' => ['field_set_id', 'custom_field_id', 'account_id'], 'message' => 'The combination of Account, Field set and Custom field has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldSet()
    {
        return $this->hasOne(FieldSet::className(), ['id' => 'field_set_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomField()
    {
        return $this->hasOne(CustomField::className(), ['id' => 'custom_field_id']);
    }
}

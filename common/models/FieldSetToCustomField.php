<?php

namespace common\models;

/**
 * This is the model class for table "tbl_field_set_to_custom_field".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $field_set_id
 * @property integer $custom_field_id
 * @property integer $level_id
 * @property integer $deleted
 *
 * @property FieldSet $fieldSet
 * @property CustomField $customField
 * @property Level $level
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
            [['account_id', 'field_set_id', 'custom_field_id', 'level_id'], 'required'],
            [['account_id', 'field_set_id', 'custom_field_id', 'level_id'], 'integer'],
            [['field_set_id', 'custom_field_id', 'account_id', 'level_id'], 'unique', 'targetAttribute' => ['field_set_id', 'custom_field_id', 'account_id', 'level_id'], 'message' => 'The combination of Account, Field set, Custom field and Level has already been taken.'],
            [['custom_field_id', 'level_id'], 'unique', 'targetAttribute' => ['custom_field_id', 'level_id'], 'message' => 'The combination of  and Custom field has already been taken.']
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(Level::className(), ['id' => 'level_id']);
    }

}

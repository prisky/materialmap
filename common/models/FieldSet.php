<?php

namespace common\models;

/**
 * This is the model class for table "tbl_field_set".
 *
 * @property string $id
 * @property string $account_id
 * @property integer $deleted
 * @property string $level
 *
 * @property EventTypeToFieldSet[] $eventTypeToFieldSets
 * @property Account $account
 * @property FieldSetToCustomField[] $fieldSetToCustomFields
 * @property FieldSetToItemGroup[] $fieldSetToItemGroups
 * @property FieldSetTree[] $fieldSetTrees
 * @property SurveyToFieldSet[] $surveyToFieldSets
 */
class FieldSet extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_field_set';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'level'], 'required'],
            [['account_id'], 'integer'],
            [['level'], 'string']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTypeToFieldSets()
    {
        return $this->hasMany(EventTypeToFieldSet::className(), ['field_set_id' => 'id', 'account_id' => 'account_id']);
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
    public function getFieldSetToCustomFields()
    {
        return $this->hasMany(FieldSetToCustomField::className(), ['field_set_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldSetToItemGroups()
    {
        return $this->hasMany(FieldSetToItemGroup::className(), ['field_set_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldSetTrees()
    {
        return $this->hasMany(FieldSetTree::className(), ['child_id' => 'id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyToFieldSets()
    {
        return $this->hasMany(SurveyToFieldSet::className(), ['field_set_id' => 'id', 'account_id' => 'account_id']);
    }
}

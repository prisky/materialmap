<?php

namespace common\models;

/**
 * This is the model class for table "tbl_level".
 *
 * @property integer $id
 * @property string $name
 *
 * @property FieldSet[] $fieldSets
 * @property FieldSetToCustomField[] $fieldSetToCustomFields
 * @property FieldSetToItemGroup[] $fieldSetToItemGroups
 * @property SurveyToFieldSet[] $surveyToFieldSets
 */
class Level extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldSets()
    {
        return $this->hasMany(FieldSet::className(), ['level_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldSetToCustomFields()
    {
        return $this->hasMany(FieldSetToCustomField::className(), ['level_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldSetToItemGroups()
    {
        return $this->hasMany(FieldSetToItemGroup::className(), ['level_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyToFieldSets()
    {
        return $this->hasMany(SurveyToFieldSet::className(), ['level_id' => 'id']);
    }

}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_column".
 *
 * @property integer $id
 * @property integer $model_id
 * @property string $auth_item_name
 * @property string $name
 * @property string $label
 * @property string $help_html
 *
 * @property Model $model
 * @property FileRule[] $fileRules
 */
class Column extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_column';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_id', 'auth_item_name', 'name', 'label'], 'required'],
            [['model_id'], 'integer'],
            [['help_html'], 'string'],
            [['auth_item_name', 'name', 'label'], 'string', 'max' => 64],
            [['model_id', 'name'], 'unique', 'targetAttribute' => ['model_id', 'name'], 'message' => 'The combination of Model and Name has already been taken.']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(Model::className(), ['id' => 'model_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileRules()
    {
        return $this->hasMany(FileRule::className(), ['column_id' => 'id']);
    }

}

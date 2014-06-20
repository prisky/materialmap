<?php

namespace common\models;

/**
 * This is the model class for table "tbl_column".
 *
 * @property integer $id
 * @property string $model_id
 * @property string $name
 * @property string $label
 * @property string $help
 *
 * @property Model $model
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
            [['model_id', 'name'], 'unique', 'targetAttribute' => ['model_id', 'name'], 'message' => 'The combination of  and  has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(Model::className(), ['id' => 'model_id']);
    }
}

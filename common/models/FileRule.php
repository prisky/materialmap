<?php

namespace common\models;

/**
 * This is the model class for table "tbl_file_rule".
 *
 * @property integer $id
 * @property integer $column_id
 * @property string $auth_item_name
 * @property string $column_name
 * @property string $validator
 * @property string $key
 * @property string $value
 *
 * @property Column $column
 */
class FileRule extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_file_rule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['column_id', 'validator', 'value'], 'unique', 'targetAttribute' => ['column_id', 'validator', 'value'], 'message' => 'The combination of ,  and  has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColumn()
    {
        return $this->hasOne(Column::className(), ['id' => 'column_id']);
    }
}

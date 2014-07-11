<?php

namespace common\models;

/**
 * This is the model class for table "tbl_channel".
 *
 * @property string $id
 * @property string $name
 */
class Channel extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_channel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique']
        ];
    }

}

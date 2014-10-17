<?php

namespace common\models;

/**
 * This is the model class for table "tbl_discipline".
 *
 * @property integer $id
 * @property string $discipline
 */
class Discipline extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_discipline';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['discipline'], 'string', 'max' => 255],
            [['discipline'], 'unique']
        ];
    }

}

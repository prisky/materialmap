<?php

namespace common\models;

/**
 * This is the model class for table "tbl_auth_rule".
 *
 * @property integer $id
 * @property string $name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 */
class AuthRule extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_auth_rule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique']
        ];
    }

}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_auth_rule".
 *
 * @property string $id
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
            [['name'], 'unique']
        ];
    }

}

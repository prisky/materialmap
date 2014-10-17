<?php

namespace common\models;

/**
 * This is the model class for table "tbl_auth_item_child".
 *
 * @property integer $id
 * @property string $parent
 * @property string $child
 */
class AuthItemChild extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_auth_item_child';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent', 'child'], 'required'],
            [['parent', 'child'], 'string', 'max' => 64],
            [['parent', 'child'], 'unique', 'targetAttribute' => ['parent', 'child'], 'message' => 'The combination of Parent and Child has already been taken.']
        ];
    }

}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_auth_assignment".
 *
 * @property integer $id
 * @property string $item_name
 * @property integer $user_id
 * @property integer $created_at
 *
 * @property User $user
 */
class AuthAssignment extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_auth_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['item_name'], 'string', 'max' => 64],
            [['item_name', 'user_id'], 'unique', 'targetAttribute' => ['item_name', 'user_id'], 'message' => 'The combination of Item name and User has already been taken.']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_contact".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone_mobile
 * @property integer $town_city_id
 * @property string $post_code
 * @property string $address_line1
 * @property string $address_line2
 *
 * @property User[] $users
 */
class Contact extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email'], 'required'],
            [['town_city_id'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 64],
            [['email', 'address_line1', 'address_line2'], 'string', 'max' => 255],
            [['phone_mobile'], 'string', 'max' => 20],
            [['post_code'], 'string', 'max' => 16],
            [['email'], 'unique']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['contact_id' => 'id']);
    }

}

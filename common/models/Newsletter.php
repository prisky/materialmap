<?php

namespace common\models;

/**
 * This is the model class for table "tbl_newsletter".
 *
 * @property string $id
 * @property string $account_id
 * @property string $subject
 * @property string $content
 * @property string $sent
 *
 * @property Account $account
 */
class Newsletter extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_newsletter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'subject', 'content'], 'required'],
            [['account_id'], 'integer'],
            [['content'], 'string'],
            [['sent'], 'safe'],
            [['subject'], 'string', 'max' => 255]
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}

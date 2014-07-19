<?php

namespace common\models;

/**
 * This is the model class for table "tbl_mail_queue".
 *
 * @property string $id
 * @property string $to
 * @property string $from
 * @property string $email_message
 * @property string $subject
 * @property string $created
 *
 * @property Contact $to0
 * @property Account $from0
 */
class MailQueue extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_mail_queue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTo0()
    {
        return $this->hasOne(Contact::className(), ['id' => 'to']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrom0()
    {
        return $this->hasOne(Account::className(), ['id' => 'from']);
    }
}

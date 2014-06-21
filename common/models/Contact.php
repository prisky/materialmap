<?php

namespace common\models;

/**
 * This is the model class for table "tbl_contact".
 *
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone_mobile
 *
 * @property MailQueue[] $mailQueues
 * @property Sms[] $sms
 * @property TicketToSeatToContact[] $ticketToSeatToContacts
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
            [['first_name', 'last_name'], 'string', 'max' => 64],
            [['email'], 'string', 'max' => 255],
            [['phone_mobile'], 'string', 'max' => 20],
            [['email'], 'unique'],
            [['phone_mobile'], 'unique']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailQueues()
    {
        return $this->hasMany(MailQueue::className(), ['to' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSms()
    {
        return $this->hasMany(Sms::className(), ['contact_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToContacts()
    {
        return $this->hasMany(TicketToSeatToContact::className(), ['contact_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['contact_id' => 'id']);
    }
}

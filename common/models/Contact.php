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
 * @property string $account_id
 * @property string $town_city_id
 * @property string $post_code
 * @property string $address_line1
 * @property string $address_line2
 * @property string $verified
 *
 * @property Comment[] $comments
 * @property TownCity $townCity
 * @property Account $account
 * @property MessageQueue[] $messageQueues
 * @property Payment[] $payments
 * @property Sms[] $sms
 * @property Summary[] $summaries
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
            [['account_id', 'town_city_id'], 'integer'],
            [['verified'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 64],
            [['email', 'address_line1', 'address_line2'], 'string', 'max' => 255],
            [['phone_mobile'], 'string', 'max' => 20],
            [['post_code'], 'string', 'max' => 16],
            [['email', 'account_id'], 'unique', 'targetAttribute' => ['email', 'account_id'], 'message' => 'The combination of Email and Account has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['contact_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTownCity()
    {
        return $this->hasOne(TownCity::className(), ['id' => 'town_city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessageQueues()
    {
        return $this->hasMany(MessageQueue::className(), ['to' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['contact_id' => 'id']);
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
    public function getSummaries()
    {
        return $this->hasMany(Summary::className(), ['contact_id' => 'id']);
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

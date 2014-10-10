<?php

namespace common\models;

/**
 * This is the model class for table "tbl_sms".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $contact_id
 * @property integer $sms_thread_id
 * @property string $sms_message
 * @property integer $outgoing
 * @property string $created
 *
 * @property Contact $contact
 * @property Account $account
 * @property SmsThread $smsThread
 * @property SmsToCharge[] $smsToCharges
 * @property TicketToSeatToContactToSms[] $ticketToSeatToContactToSms
 */
class Sms extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_sms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'contact_id', 'sms_thread_id', 'sms_message', 'outgoing'], 'required'],
            [['account_id', 'contact_id', 'sms_thread_id', 'outgoing'], 'integer'],
            [['sms_message'], 'string', 'max' => 140]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Contact::className(), ['id' => 'contact_id']);
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
    public function getSmsThread()
    {
        return $this->hasOne(SmsThread::className(), ['id' => 'sms_thread_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmsToCharges()
    {
        return $this->hasMany(SmsToCharge::className(), ['sms_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToContactToSms()
    {
        return $this->hasMany(TicketToSeatToContactToSms::className(), ['sms_id' => 'id']);
    }
}

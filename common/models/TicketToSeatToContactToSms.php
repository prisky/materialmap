<?php

namespace common\models;

/**
 * This is the model class for table "tbl_ticket_to_seat_to_contact_to_sms".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $ticket_to_seat_to_contact_id
 * @property integer $sms_id
 *
 * @property TicketToSeatToContact $ticketToSeatToContact
 * @property Sms $sms
 * @property Account $account
 */
class TicketToSeatToContactToSms extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ticket_to_seat_to_contact_to_sms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'ticket_to_seat_to_contact_id', 'sms_id'], 'required'],
            [['account_id', 'ticket_to_seat_to_contact_id', 'sms_id'], 'integer'],
            [['sms_id'], 'unique']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToContact()
    {
        return $this->hasOne(TicketToSeatToContact::className(), ['id' => 'ticket_to_seat_to_contact_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSms()
    {
        return $this->hasOne(Sms::className(), ['id' => 'sms_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

}

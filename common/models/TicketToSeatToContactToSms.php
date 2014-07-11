<?php

namespace common\models;

/**
 * This is the model class for table "tbl_ticket_to_seat_to_contact_to_sms".
 *
 * @property string $id
 * @property string $account_id
 * @property string $ticket_to_seat_to_contact_id
 * @property string $sms_id
 *
 * @property Account $account
 * @property Sms $sms
 * @property TicketToSeatToContact $ticketToSeatToContact
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
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSms()
    {
        return $this->hasOne(Sms::className(), ['id' => 'sms_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToContact()
    {
        return $this->hasOne(TicketToSeatToContact::className(), ['id' => 'ticket_to_seat_to_contact_id', 'account_id' => 'account_id']);
    }
}

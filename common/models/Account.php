<?php

namespace common\models;

/**
 * This is the model class for table "tbl_account".
 *
 * @property string $id
 * @property string $user_id
 * @property string $address_id
 * @property string $phone_work
 * @property string $balance
 * @property string $summary_charge
 * @property string $booking_charge
 * @property string $ticket_charge
 * @property string $seat_charge
 * @property string $sms_charge
 * @property string $annual_charge
 * @property string $rate
 * @property string $created
 *
 * @property User $user
 * @property Address $address
 * @property AccountToAffiliateCategory[] $accountToAffiliateCategories
 * @property AccountToMessage[] $accountToMessages
 * @property AccountToMessageToUser[] $accountToMessageToUsers
 * @property AccountToPaymentGateway[] $accountToPaymentGateways
 * @property AccountToUser[] $accountToUsers
 * @property AffiliateCategory[] $affiliateCategories
 * @property Agency[] $agencies
 * @property AnnualCharge[] $annualCharges
 * @property AuthItem[] $authItems
 * @property AuthItemChild[] $authItemChildren
 * @property Bid[] $bs
 * @property Booking[] $bookings
 * @property BookingToCharge[] $bookingToCharges
 * @property BookingToEventToResourceToCustomField[] $bookingToEventToResourceToCustomFields
 * @property BookingToEventToResourceToExtra[] $bookingToEventToResourceToExtras
 * @property CancellationPolicy[] $cancellationPolicies
 * @property Charge[] $charges
 * @property Comment[] $comments
 * @property Coupon[] $coupons
 * @property CustomField[] $customFields
 * @property Event[] $events
 * @property EventDetail[] $eventDetails
 * @property EventDetailToTicketType[] $eventDetailToTicketTypes
 * @property EventToResourceToExtra[] $eventToResourceToExtras
 * @property EventToResourceToExtraToSummary[] $eventToResourceToExtraToSummaries
 * @property EventToResourceToExtraToTicket[] $eventToResourceToExtraToTickets
 * @property EventToResourceToExtraToTicketToSeat[] $eventToResourceToExtraToTicketToSeats
 * @property Extra[] $extras
 * @property Item[] $items
 * @property MailQueue[] $mailQueues
 * @property Newsletter[] $newsletters
 * @property Payment[] $payments
 * @property PercentPromotion[] $percentPromotions
 * @property PercentPromotionConstraint[] $percentPromotionConstraints
 * @property PercentVoucher[] $percentVouchers
 * @property PercentVoucherConstraint[] $percentVoucherConstraints
 * @property Promotion[] $promotions
 * @property PromotionConstraint[] $promotionConstraints
 * @property Question[] $questions
 * @property QuestionThread[] $questionThreads
 * @property Referral[] $referrals
 * @property Reminder[] $reminders
 * @property Reseller[] $resellers
 * @property Resource[] $resources
 * @property ResourceToAddress[] $resourceToAddresses
 * @property ResourceToCustomField[] $resourceToCustomFields
 * @property ResourceToExtra[] $resourceToExtras
 * @property ResourceToMessage[] $resourceToMessages
 * @property ResourceToMessageToUser[] $resourceToMessageToUsers
 * @property Seat[] $seats
 * @property SeatToTicketType[] $seatToTicketTypes
 * @property SeatType[] $seatTypes
 * @property Sms[] $sms
 * @property SmsThread[] $smsThreads
 * @property SmsToCharge[] $smsToCharges
 * @property StandardSetup[] $standardSetups
 * @property Summary[] $summaries
 * @property SummaryToAccountToUser[] $summaryToAccountToUsers
 * @property SummaryToCharge[] $summaryToCharges
 * @property SummaryToEventToResourceToCustomField[] $summaryToEventToResourceToCustomFields
 * @property SummaryToPercentPromotion[] $summaryToPercentPromotions
 * @property SummaryToPercentVoucher[] $summaryToPercentVouchers
 * @property SummaryToPromotion[] $summaryToPromotions
 * @property SummaryToVoucher[] $summaryToVouchers
 * @property Survey[] $surveys
 * @property SurveyResult[] $surveyResults
 * @property SurveyResultToBooking[] $surveyResultToBookings
 * @property SurveyResultToSummary[] $surveyResultToSummaries
 * @property SurveyResultToTicket[] $surveyResultToTickets
 * @property SurveyResultToTicketToSeat[] $surveyResultToTicketToSeats
 * @property SurveyToCustomField[] $surveyToCustomFields
 * @property SurveyToResource[] $surveyToResources
 * @property Ticket[] $tickets
 * @property TicketToCharge[] $ticketToCharges
 * @property TicketToEventToResourceToCustomField[] $ticketToEventToResourceToCustomFields
 * @property TicketToSeat[] $ticketToSeats
 * @property TicketToSeatToCharge[] $ticketToSeatToCharges
 * @property TicketToSeatToContact[] $ticketToSeatToContacts
 * @property TicketToSeatToContactToSms[] $ticketToSeatToContactToSms
 * @property TicketToSeatToEventToResourceToCustomField[] $ticketToSeatToEventToResourceToCustomFields
 * @property TicketType[] $ticketTypes
 * @property Voucher[] $vouchers
 */
class Account extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'address_id', 'phone_work'], 'required'],
            [['user_id', 'address_id'], 'integer'],
            [['balance', 'summary_charge', 'booking_charge', 'ticket_charge', 'seat_charge', 'sms_charge', 'annual_charge', 'rate'], 'number'],
            [['phone_work'], 'string', 'max' => 20]
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountToAffiliateCategories()
    {
        return $this->hasMany(AccountToAffiliateCategory::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountToMessages()
    {
        return $this->hasMany(AccountToMessage::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountToMessageToUsers()
    {
        return $this->hasMany(AccountToMessageToUser::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountToPaymentGateways()
    {
        return $this->hasMany(AccountToPaymentGateway::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountToUsers()
    {
        return $this->hasMany(AccountToUser::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAffiliateCategories()
    {
        return $this->hasMany(AffiliateCategory::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgencies()
    {
        return $this->hasMany(Agency::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnnualCharges()
    {
        return $this->hasMany(AnnualCharge::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItems()
    {
        return $this->hasMany(AuthItem::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemChildren()
    {
        return $this->hasMany(AuthItemChild::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBs()
    {
        return $this->hasMany(Bid::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingToCharges()
    {
        return $this->hasMany(BookingToCharge::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingToEventToResourceToCustomFields()
    {
        return $this->hasMany(BookingToEventToResourceToCustomField::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingToEventToResourceToExtras()
    {
        return $this->hasMany(BookingToEventToResourceToExtra::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCancellationPolicies()
    {
        return $this->hasMany(CancellationPolicy::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharges()
    {
        return $this->hasMany(Charge::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoupons()
    {
        return $this->hasMany(Coupon::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomFields()
    {
        return $this->hasMany(CustomField::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventDetails()
    {
        return $this->hasMany(EventDetail::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventDetailToTicketTypes()
    {
        return $this->hasMany(EventDetailToTicketType::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventToResourceToExtras()
    {
        return $this->hasMany(EventToResourceToExtra::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventToResourceToExtraToSummaries()
    {
        return $this->hasMany(EventToResourceToExtraToSummary::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventToResourceToExtraToTickets()
    {
        return $this->hasMany(EventToResourceToExtraToTicket::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventToResourceToExtraToTicketToSeats()
    {
        return $this->hasMany(EventToResourceToExtraToTicketToSeat::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExtras()
    {
        return $this->hasMany(Extra::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailQueues()
    {
        return $this->hasMany(MailQueue::className(), ['from' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsletters()
    {
        return $this->hasMany(Newsletter::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPercentPromotions()
    {
        return $this->hasMany(PercentPromotion::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPercentPromotionConstraints()
    {
        return $this->hasMany(PercentPromotionConstraint::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPercentVouchers()
    {
        return $this->hasMany(PercentVoucher::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPercentVoucherConstraints()
    {
        return $this->hasMany(PercentVoucherConstraint::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotions()
    {
        return $this->hasMany(Promotion::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotionConstraints()
    {
        return $this->hasMany(PromotionConstraint::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionThreads()
    {
        return $this->hasMany(QuestionThread::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferrals()
    {
        return $this->hasMany(Referral::className(), ['account_id' => 'id', 'first_referrer_user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReminders()
    {
        return $this->hasMany(Reminder::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResellers()
    {
        return $this->hasMany(Reseller::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResources()
    {
        return $this->hasMany(Resource::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceToAddresses()
    {
        return $this->hasMany(ResourceToAddress::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceToCustomFields()
    {
        return $this->hasMany(ResourceToCustomField::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceToExtras()
    {
        return $this->hasMany(ResourceToExtra::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceToMessages()
    {
        return $this->hasMany(ResourceToMessage::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceToMessageToUsers()
    {
        return $this->hasMany(ResourceToMessageToUser::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeats()
    {
        return $this->hasMany(Seat::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeatToTicketTypes()
    {
        return $this->hasMany(SeatToTicketType::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeatTypes()
    {
        return $this->hasMany(SeatType::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSms()
    {
        return $this->hasMany(Sms::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmsThreads()
    {
        return $this->hasMany(SmsThread::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmsToCharges()
    {
        return $this->hasMany(SmsToCharge::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStandardSetups()
    {
        return $this->hasMany(StandardSetup::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaries()
    {
        return $this->hasMany(Summary::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToAccountToUsers()
    {
        return $this->hasMany(SummaryToAccountToUser::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToCharges()
    {
        return $this->hasMany(SummaryToCharge::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToEventToResourceToCustomFields()
    {
        return $this->hasMany(SummaryToEventToResourceToCustomField::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToPercentPromotions()
    {
        return $this->hasMany(SummaryToPercentPromotion::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToPercentVouchers()
    {
        return $this->hasMany(SummaryToPercentVoucher::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToPromotions()
    {
        return $this->hasMany(SummaryToPromotion::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToVouchers()
    {
        return $this->hasMany(SummaryToVoucher::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveys()
    {
        return $this->hasMany(Survey::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResults()
    {
        return $this->hasMany(SurveyResult::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToBookings()
    {
        return $this->hasMany(SurveyResultToBooking::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToSummaries()
    {
        return $this->hasMany(SurveyResultToSummary::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToTickets()
    {
        return $this->hasMany(SurveyResultToTicket::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyResultToTicketToSeats()
    {
        return $this->hasMany(SurveyResultToTicketToSeat::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyToCustomFields()
    {
        return $this->hasMany(SurveyToCustomField::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyToResources()
    {
        return $this->hasMany(SurveyToResource::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToCharges()
    {
        return $this->hasMany(TicketToCharge::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToEventToResourceToCustomFields()
    {
        return $this->hasMany(TicketToEventToResourceToCustomField::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeats()
    {
        return $this->hasMany(TicketToSeat::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToCharges()
    {
        return $this->hasMany(TicketToSeatToCharge::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToContacts()
    {
        return $this->hasMany(TicketToSeatToContact::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToContactToSms()
    {
        return $this->hasMany(TicketToSeatToContactToSms::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToEventToResourceToCustomFields()
    {
        return $this->hasMany(TicketToSeatToEventToResourceToCustomField::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketTypes()
    {
        return $this->hasMany(TicketType::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVouchers()
    {
        return $this->hasMany(Voucher::className(), ['account_id' => 'id']);
    }
}

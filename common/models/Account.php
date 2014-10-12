<?php

namespace common\models;

/**
 * This is the model class for table "tbl_account".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $phone_work
 * @property string $balance
 * @property string $summary_charge
 * @property string $booking_charge
 * @property string $ticket_charge
 * @property string $seat_charge
 * @property string $sms_charge
 * @property string $annual_charge
 * @property string $rate
 * @property string $optimisation
 * @property string $created
 *
 * @property User $user
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
 * @property BookingToCustomField[] $bookingToCustomFields
 * @property BookingToItem[] $bookingToItems
 * @property CancellationPolicy[] $cancellationPolicies
 * @property Charge[] $charges
 * @property Comment[] $comments
 * @property Contact[] $contacts
 * @property Coupon[] $coupons
 * @property CustomField[] $customFields
 * @property Event[] $events
 * @property EventType[] $eventTypes
 * @property EventTypeToFieldSet[] $eventTypeToFieldSets
 * @property EventTypeToResourceType[] $eventTypeToResourceTypes
 * @property EventTypeToTicketType[] $eventTypeToTicketTypes
 * @property FieldSet[] $fieldSets
 * @property FieldSetToItemGroup[] $fieldSetToItemGroups
 * @property FieldSetTree[] $fieldSetTrees
 * @property ItemGroup[] $itemGroups
 * @property MessageQueue[] $messageQueues
 * @property Newsletter[] $newsletters
 * @property Payment[] $payments
 * @property PaymentGateway[] $paymentGateways
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
 * @property ResourceType[] $resourceTypes
 * @property ResourceTypeToMessage[] $resourceTypeToMessages
 * @property ResourceTypeToMessageToUser[] $resourceTypeToMessageToUsers
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
 * @property SummaryToCustomField[] $summaryToCustomFields
 * @property SummaryToItem[] $summaryToItems
 * @property SummaryToPercentPromotion[] $summaryToPercentPromotions
 * @property SummaryToPercentVoucher[] $summaryToPercentVouchers
 * @property SummaryToPromotion[] $summaryToPromotions
 * @property SummaryToVoucher[] $summaryToVouchers
 * @property Survey[] $surveys
 * @property SurveyResultToBooking[] $surveyResultToBookings
 * @property SurveyResultToSummary[] $surveyResultToSummaries
 * @property SurveyResultToTicket[] $surveyResultToTickets
 * @property SurveyResultToTicketToSeat[] $surveyResultToTicketToSeats
 * @property SurveyToFieldSet[] $surveyToFieldSets
 * @property SurveyToResourceType[] $surveyToResourceTypes
 * @property Ticket[] $tickets
 * @property TicketToCharge[] $ticketToCharges
 * @property TicketToCustomField[] $ticketToCustomFields
 * @property TicketToItem[] $ticketToItems
 * @property TicketToSeat[] $ticketToSeats
 * @property TicketToSeatToCharge[] $ticketToSeatToCharges
 * @property TicketToSeatToContact[] $ticketToSeatToContacts
 * @property TicketToSeatToContactToSms[] $ticketToSeatToContactToSms
 * @property TicketToSeatToCustomField[] $ticketToSeatToCustomFields
 * @property TicketToSeatToItem[] $ticketToSeatToItems
 * @property TicketType[] $ticketTypes
 * @property Voucher[] $vouchers
 */
class Account extends \common\components\ActiveRecord
{
    use \common\components\FileActiveRecordTrait;

    /**
     * @var string $logo_image is a file attribute
     */
    public $logo_image;

    /**
     * Get the attribute names for files
     *
     * @return array or strings - file attribute names
     */
    public function getFileAttributes()
    {
        return [
            'logo_image',
        ];
    }

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
            [['user_id', 'phone_work', 'balance', 'summary_charge', 'booking_charge', 'ticket_charge', 'seat_charge', 'sms_charge', 'annual_charge', 'rate', 'optimisation'], 'required'],
            [['user_id'], 'integer'],
            [['balance', 'summary_charge', 'booking_charge', 'ticket_charge', 'seat_charge', 'sms_charge', 'annual_charge', 'rate'], 'number'],
            [['optimisation'], 'string'],
            [['phone_work'], 'string', 'max' => 20],
            [['logo_image'], '\common\components\FileValidator', 'skipOnEmpty' => false, 'maxFiles' => 2]
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
    public function getBookingToCustomFields()
    {
        return $this->hasMany(BookingToCustomField::className(), ['account_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingToItems()
    {
        return $this->hasMany(BookingToItem::className(), ['account_id' => 'id']);
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
    public function getContacts()
    {
        return $this->hasMany(Contact::className(), ['account_id' => 'id']);
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
    public function getEventTypes()
    {
        return $this->hasMany(EventType::className(), ['account_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTypeToFieldSets()
    {
        return $this->hasMany(EventTypeToFieldSet::className(), ['account_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTypeToResourceTypes()
    {
        return $this->hasMany(EventTypeToResourceType::className(), ['account_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTypeToTicketTypes()
    {
        return $this->hasMany(EventTypeToTicketType::className(), ['account_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldSets()
    {
        return $this->hasMany(FieldSet::className(), ['account_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldSetToItemGroups()
    {
        return $this->hasMany(FieldSetToItemGroup::className(), ['account_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldSetTrees()
    {
        return $this->hasMany(FieldSetTree::className(), ['account_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemGroups()
    {
        return $this->hasMany(ItemGroup::className(), ['account_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessageQueues()
    {
        return $this->hasMany(MessageQueue::className(), ['from' => 'id']);
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
    public function getPaymentGateways()
    {
        return $this->hasMany(PaymentGateway::className(), ['account_id' => 'id']);
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
        return $this->hasMany(Referral::className(), ['account_id' => 'id']);
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
    public function getResourceTypes()
    {
        return $this->hasMany(ResourceType::className(), ['account_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceTypeToMessages()
    {
        return $this->hasMany(ResourceTypeToMessage::className(), ['account_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceTypeToMessageToUsers()
    {
        return $this->hasMany(ResourceTypeToMessageToUser::className(), ['account_id' => 'id']);
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
    public function getSummaryToCustomFields()
    {
        return $this->hasMany(SummaryToCustomField::className(), ['account_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryToItems()
    {
        return $this->hasMany(SummaryToItem::className(), ['account_id' => 'id']);
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
    public function getSurveyToFieldSets()
    {
        return $this->hasMany(SurveyToFieldSet::className(), ['account_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurveyToResourceTypes()
    {
        return $this->hasMany(SurveyToResourceType::className(), ['account_id' => 'id']);
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
    public function getTicketToCustomFields()
    {
        return $this->hasMany(TicketToCustomField::className(), ['account_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToItems()
    {
        return $this->hasMany(TicketToItem::className(), ['account_id' => 'id']);
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
    public function getTicketToSeatToCustomFields()
    {
        return $this->hasMany(TicketToSeatToCustomField::className(), ['account_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketToSeatToItems()
    {
        return $this->hasMany(TicketToSeatToItem::className(), ['account_id' => 'id']);
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

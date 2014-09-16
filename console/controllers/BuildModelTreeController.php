<?php
 
namespace console\controllers;
 
use yii\console\Controller;
use console\models\Model;
 
/**
 * Build ModelTree controller
 * 
 * Poulates the tbl_model_tree table as a closure table from an associative array. Uses ClosureTableBehavior attached to Model. Can
 * be run in Netbeans by right clicking on the project and selecting the console configuration. There is a bug in Netbeans or XDebug
 * that meand in order to break in this file need to break on call_user_func_array from InlineAction and then step into - Once in then
 * will break. To run from the command line, from the project root, ./yii buildnavigation.
 */
class BuildModelTreeController extends Controller
{
 
	/**
	 * Associative array of items describing navigation. Forms a tree, which is stored as a closure table after this command is run
	 * @var array 
	 */
	private $items = [
		'Account' => [
			'AccountToAffiliateCategory',
			'AccountToMessage',
			'AccountToMessageToUser',
			'AccountToPaymentGateway',
			'AccountToUser',
			'Agency',
			'AuthAssignment',
			'AuthItem' => [
				'AuthItemChild',
			],
			'CancellationPolicy',
			'Event' => [
				'Booking' => [
					'BookingToCharge',
					'BookingToCustomField',
					'BookingToItem',
					'Ticket' => [
						'TicketToCharge',
						'TicketToCustomField',
						'TicketToItem',
						'TicketToSeat',
						'TicketToSeatToCharge',
						'TicketToSeatToContact',
						'TicketToSeatToContactToSms',
						'TicketToSeatToCustomField',
						'TicketToSeatToItem',
					],
				],
				'Comment',
			],
			'EventType' => [
				'EventTypeToFieldSet',
				'EventTypeToResourceType',
				'EventTypeToTicketType',
			],
			'FieldSet' => [
				'FieldSetToCustomField',
				'FieldSetToItemGroup',
				'FieldSetTree',
			],
			'Invoice',
			'ItemGroup' => [
				'Item' => [
					'ItemInventory',
				],
			],
			'Charge' => [
				'AnnualCharge',
			],
			'Contact',
			'Newsletter',
			'Summary' => [
				'Payment',
				'SummaryToAccountToUser',
				'SummaryToCharge',
				'SummaryToCustomField',
				'SummaryToItem',
				'SummaryToPercentPromotion',
				'SummaryToPercentVoucher',
				'SummaryToPromotion',
				'SummaryToVoucher',
			],
			'PercentPromotion' => [
				'PercentPromotionConstraint',
			],
			'PercentVoucher' => [
				'PercentVoucherConstraint',
			],
			'Promotion' => [
				'PromotionConstraint',
			],
			'Question' => [
				'QuestionThread',
			],
			'Referral',
			'Reminder',
			'ResourceType' => [
				'Resource',
				'ResourceTypeToMessage' => [
					'ResourceTypeToMessageToUser',
				],
			],
			'SeatType' => [
				'Seat' => [
					'SeatToTicketType',
				],
			],
			'SmsThread' => [
				'Sms' => [
					'SmsToCharge',
				],
			],
			'StandardSetup',
			'Survey' => [
				'SurveyResultToBooking',
				'SurveyResultToSummary',
				'SurveyResultToTicket',
				'SurveyResultToTicketToSeat',
				'SurveyToFieldSet',
				'SurveyToResourceType',
			],
			'TicketType',
			'User',
			'Voucher' => [
				'VoucherConstraint',
			],
		],
		'AffiliateCategory',
		'Bid',
		'Channel',
		'Country',
		'Coupon',
		'CustomField',
		'Message' => [
			'MessageToMessageField',
		],
		'MessageField',
		'Model' => [
			'Column',
		],
		'PaymentGateway',
		'PaypalCategory',
		'PaypalSubCategory',
		'Reseller',
		'StateProvinceRegion',
		'TownCity',
	];

	/**
	 * @inheritdoc
	 */
	public function actionIndex() {
		
		// clear the existing navigation structure
		\Yii::$app->db->createCommand('TRUNCATE tbl_model_tree')->execute();

		// rebuild the navigation structure
		$this->addItems($this->items, 0);
    }
	
	/**
	 * Recursive, dig into associative array to build closure table for navigation
	 * @param array $items
	 * @param int $depth
	 * @param Model $parent
	 */
	private function addItems(&$items, $depth, &$parent=NULL) {

		foreach($items as $key => $value) {
			if(!$model = Model::findOne(['auth_item_name' => is_string($value) ? $value : $key])) {
				// no model found so probably a typo or forgotten to update something
				echo 'model not found ';
				print_r($key);
				print_r($value);
				exit;
			}

			$depth ? $model->appendTo($parent) : $model->saveNodeAsRoot();

			if(is_array($value)) {
				// recurse
				$this->addItems($value, $depth + 1, $model);
			}
		}
	}
 
}
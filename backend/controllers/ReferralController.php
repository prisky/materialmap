<?php

namespace backend\controllers;

/**
 * ReferralController implements the CRUD actions for Referral model.
 */
class ReferralController extends \backend\components\Controller
{
	
	/**
	 * Produce widget options for a Select2 widget for the first_referrer_user_id foreign key attribute
	 * referencing the tbl_summary_to_account_to_user table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionSummarytoaccounttouserlist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('SummaryToAccountToUser', $q, $page, $id);
	}

	/**
	 * Produce widget options for a Select2 widget for the first_referrer_user_id foreign key attribute
	 * referencing the tbl_account table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionAccountlist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('Account', $q, $page, $id);
	}

	/**
	 * Produce widget options for a Select2 widget for the account_to_user_id foreign key attribute
	 * referencing the tbl_invoice table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionInvoicelist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('Invoice', $q, $page, $id);
	}

	/**
	 * Produce widget options for a Select2 widget for the account_id foreign key attribute
	 * referencing the tbl_account_to_user table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionAccounttouserlist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('AccountToUser', $q, $page, $id);
	}

}
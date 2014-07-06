<?php

namespace backend\controllers;

/**
 * AuthItemController implements the CRUD actions for AuthItem model.
 */
class AuthItemController extends \backend\components\Controller
{
	
	/**
	 * Produce widget options for a Select2 widget for the rule_name foreign key attribute
	 * referencing the tbl_auth_rule table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionAuthrulelist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('AuthRule', $q, $page, $id);
	}

	/**
	 * Produce widget options for a Select2 widget for the account_id foreign key attribute
	 * referencing the tbl_account table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionAccountlist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('Account', $q, $page, $id);
	}

}
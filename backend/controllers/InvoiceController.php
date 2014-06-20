<?php

namespace backend\controllers;

/**
 * InvoiceController implements the CRUD actions for Invoice model.
 */
class InvoiceController extends \backend\components\Controller
{
	
	/**
	 * Produce widget options for a Select2 widget for the account_to_user_id foreign key attribute
	 * referencing the tbl_account_to_user table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionAccounttouserlist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('AccountToUser', $q, $page, $id);
	}

}
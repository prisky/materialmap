<?php

namespace backend\controllers;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends \backend\components\Controller
{
	
	/**
	 * Produce widget options for a Select2 widget for the user_id foreign key attribute
	 * referencing the tbl_user table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionUserlist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('User', $q, $page, $id);
	}

	/**
	 * Produce widget options for a Select2 widget for the address_id foreign key attribute
	 * referencing the tbl_address table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionAddresslist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('Address', $q, $page, $id);
	}

}
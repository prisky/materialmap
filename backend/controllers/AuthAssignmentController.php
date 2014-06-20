<?php

namespace backend\controllers;

/**
 * AuthAssignmentController implements the CRUD actions for AuthAssignment model.
 */
class AuthAssignmentController extends \backend\components\Controller
{
	
	/**
	 * Produce widget options for a Select2 widget for the item_name foreign key attribute
	 * referencing the tbl_auth_item table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionAuthitemlist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('AuthItem', $q, $page, $id);
	}

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

}
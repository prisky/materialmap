<?php

namespace backend\controllers;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends \backend\components\Controller
{
	
	/**
	 * Produce widget options for a Select2 widget for the account_id foreign key attribute
	 * referencing the tbl_bid table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionBidlist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('Bid', $q, $page, $id);
	}

	/**
	 * Produce widget options for a Select2 widget for the account_id foreign key attribute
	 * referencing the tbl_question_thread table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionQuestionthreadlist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('QuestionThread', $q, $page, $id);
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
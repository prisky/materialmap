<?php

namespace backend\controllers;

/**
 * SurveyResultToTicketController implements the CRUD actions for SurveyResultToTicket model.
 */
class SurveyResultToTicketController extends \backend\components\Controller
{
	
	/**
	 * Produce widget options for a Select2 widget for the account_id foreign key attribute
	 * referencing the tbl_survey_result table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionSurveyresultlist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('SurveyResult', $q, $page, $id);
	}

	/**
	 * Produce widget options for a Select2 widget for the account_id foreign key attribute
	 * referencing the tbl_ticket table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionTicketlist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('Ticket', $q, $page, $id);
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
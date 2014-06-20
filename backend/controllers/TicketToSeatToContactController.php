<?php

namespace backend\controllers;

/**
 * TicketToSeatToContactController implements the CRUD actions for TicketToSeatToContact model.
 */
class TicketToSeatToContactController extends \backend\components\Controller
{
	
	/**
	 * Produce widget options for a Select2 widget for the ticket_to_seat_id foreign key attribute
	 * referencing the tbl_ticket_to_seat table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionTickettoseatlist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('TicketToSeat', $q, $page, $id);
	}

	/**
	 * Produce widget options for a Select2 widget for the contact_id foreign key attribute
	 * referencing the tbl_contact table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionContactlist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('Contact', $q, $page, $id);
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
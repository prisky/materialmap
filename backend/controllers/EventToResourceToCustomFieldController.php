<?php

namespace backend\controllers;

/**
 * EventToResourceToCustomFieldController implements the CRUD actions for EventToResourceToCustomField model.
 */
class EventToResourceToCustomFieldController extends \backend\components\Controller
{
	
	/**
	 * Produce widget options for a Select2 widget for the account_id foreign key attribute
	 * referencing the tbl_event table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionEventlist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('Event', $q, $page, $id);
	}

	/**
	 * Produce widget options for a Select2 widget for the account_id foreign key attribute
	 * referencing the tbl_resource_to_custom_field table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionResourcetocustomfieldlist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('ResourceToCustomField', $q, $page, $id);
	}

}
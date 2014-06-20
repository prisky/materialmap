<?php

namespace backend\controllers;

/**
 * MessageToMessageFieldController implements the CRUD actions for MessageToMessageField model.
 */
class MessageToMessageFieldController extends \backend\components\Controller
{
	
	/**
	 * Produce widget options for a Select2 widget for the message_id foreign key attribute
	 * referencing the tbl_message table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionMessagelist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('Message', $q, $page, $id);
	}

	/**
	 * Produce widget options for a Select2 widget for the message_field_id foreign key attribute
	 * referencing the tbl_message_field table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionMessagefieldlist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('MessageField', $q, $page, $id);
	}

}
<?php

namespace backend\controllers;

/**
 * StateProvinceController implements the CRUD actions for StateProvince model.
 */
class StateProvinceController extends \backend\components\Controller
{
	
	/**
	 * Produce widget options for a Select2 widget for the country_id foreign key attribute
	 * referencing the tbl_country table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionCountrylist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('Country', $q, $page, $id);
	}

}
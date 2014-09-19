<?php

namespace common\models;

/**
 * Scopes chained to the find method of an ActiveRecord  for table "tbl_account" .
 */
class AccountQuery extends \common\components\ActiveQuery
{

/*	public static function displayAttributes () {
		return [
			phone_work,
			tbl_user => [
				tbl_contact => [
					email,
					first_name,
					last_name,
				],
			],
		];
	}*/
	
	/**
	 * Set ActiveQuery properties to filter by the search term similar to a Google search i.e. unordered multi word search
	 * and define the attributes to return for display purposes - lists are one use.
	 * @param type $q The search term entered by the user
	 * @param type $page The page number
	 * @return ActiveQuery $this The select should select id and text where text is the display text and id the primary key
	 */
	public function display($q = null, $page = null)
	{
		// make any search google style i.e. unordered mulitple words
		if(is_string($q)) {
			foreach(explode(' ', $q) as $like) {
				$this->andWhere("CONCAT_WS(' ', tbl_account.phone_work, tbl_contact.email, tbl_contact.first_name, tbl_contact.last_name) LIKE :like", [':like' => "%$like%"]);
//				$this->andWhere("CONCAT_WS(' ', phone_work) LIKE :like", [':like' => "%$like%"]);
			}
		}

		return parent::display($q, $page)
			->joinWith('user.contact')
			->select(["tbl_account.id id", "CONCAT_WS(' ', tbl_account.phone_work, tbl_contact.email, tbl_contact.first_name, tbl_contact.last_name) text"]);
//			->select(["tbl_account.id id", "CONCAT_WS(' ', phone_work) text"]);
	}
}
<?php

namespace common\models;

/**
 * Scopes chained to the find method of an ActiveRecord  for table "tbl_town_city" .
 */
class TownCityQuery extends \common\components\ActiveQuery
{

	/**
	 * Set ActiveQuery properties to filter by the search term similar to a Google search i.e. unordered multi word search
	 * and define the attributes to return for display purposes - lists are one use.
	 * @param type $search The search term entered by the user
	 * @param type $page The page number
	 * @return ActiveQuery $this The select should select id and text where text is the display text and id the primary key
	 */
	public function displayAttributes($search = null, $page = null)
	{
		// make any search google style i.e. unordered mulitple words
		if(is_string($search)) {
			foreach(explode(' ', $search) as $like) {
//				$this->andWhere("CONCAT_WS(' ', email, first_name, last_name) LIKE :like", [':like' => "%$like%"]);
				$this->andWhere("CONCAT_WS(' ', name) LIKE :like", [':like' => "%$like%"]);
			}
		}

		return parent::displayAttributes($search, $page)
//			->joinWith('contact')
//			->select(["tbl_user.id id", "CONCAT_WS(' ', email, first_name, last_name) text"]);
			->select(["tbl_town_city.id id", "CONCAT_WS(' ', name) text"]);
	}
}
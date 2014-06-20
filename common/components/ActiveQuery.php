<?php

namespace common\components;

/**
 * Scopes used within the find method of an ActiveRecord method. This abstract class
 * should be extended for each ActiveRecord model that uses find inheritied from
 * common\components\ActiveRecord
 */
abstract class ActiveQuery extends \yii\db\ActiveQuery
{
	
	/**
	 * Set ActiveQuery properties suitable for paging. This used in lists.
	 * @param type $search The search term entered by the user
	 * @param type $page The page number
	 * @return ActiveQuery $this
	 */
	public function displayAttributes($search = null, $page = null)
	{
		if(is_numeric($page)) {
			$this->offset($page - 1);
		}

		return $this->limit(10);
	}
}
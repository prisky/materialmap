<?php

namespace common\components;

use Yii;

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
	
	/**
	 * Set default query paramters when using find
	 * @return \common\components\ActiveQuery
	 */
	public function defaultScope() {
		// filter by account if user doesn't have AccountRead access - in which case can see all accounts
		if(isset(Yii::$app->user->id) && !Yii::$app->user->can('AccountRead')) {
			// if the model has an account_id attribute then filter by it
			$modelClass = $this->modelClass;
			$tableName = $modelClass::tableName();
			$tableSchema =  Yii::$app->db->getTableSchema($tableName);
			if(isset($tableSchema->columns['account_id'])) {
				$userId = Yii::$app->user->id;
				$this->join('JOIN', 'tbl_account_to_user', "$tableName.account_id = tbl_account_to_user.account_id AND tbl_account_to_user.user_id = $userId");
			}
		}
		
		return $this;
	}

}
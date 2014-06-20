<?php
/**
 * This is the template for generating the ActiveQuery class of a specified table.
 *
 * @var yii\web\View $this
 * @var yii\gii\generators\model\Generator $generator
 * @var string $tableName full table name
 * @var yii\db\TableSchema $tableSchema
 */

// do our best to determine what the display attributes are most likely be - hence concatenate any varchar fields
foreach($tableSchema->columns as $column) {
	if(strpos($column->dbType, 'varchar') !== FALSE) {
		$columns[] =  $column->name;
	}
}
if(!isset($columns)) {
	$columns[] = 'id';
}
$columns = implode(', ', $columns);

echo "<?php\n";
?>

namespace common\models;

/**
 * Scopes chained to the find method of an ActiveRecord  for table "<?= $tableName ?>" .
 */
class <?= $generator->modelClass ?>Query extends \common\components\ActiveQuery
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
				$this->andWhere("CONCAT_WS(' ', <?= $columns ?>) LIKE :like", [':like' => "%$like%"]);
			}
		}

		return parent::displayAttributes($search, $page)
//			->joinWith('contact')
//			->select(["tbl_user.id id", "CONCAT_WS(' ', email, first_name, last_name) text"]);
			->select(["<?= $tableName ?>.id id", "CONCAT_WS(' ', <?= $columns ?>) text"]);
	}
}
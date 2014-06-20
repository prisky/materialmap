<?php

use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;

/**
 * This is the template for generating a CRUD controller class file.
 *
 * @var yii\web\View $this
 * @var yii\gii\generators\crud\Generator $generator
 * @var string $tableName full table name
 */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$db =  $generator->getDbConnection();
$tableSchema = $db->getTableSchema($tableName);

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

/**
 * <?= $controllerClass ?> implements the CRUD actions for <?= $modelClass ?> model.
 */
class <?= $controllerClass ?> extends <?= '\\' . $generator->baseControllerClass . "\n" ?>
{
	<?php
	// if the field is a foreign key
	foreach($tableSchema->foreignKeys as $tableKeys) {
		$tableName = $tableKeys[0];
		$attribute = key(array_slice($tableKeys, -1, 1, TRUE));
		$modelName = $generator->generateClassName($tableKeys[0]);
	?>

	/**
	 * Produce widget options for a Select2 widget for the <?= $attribute ?> foreign key attribute
	 * referencing the <?= $tableName ?> table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function action<?= ucfirst(strtolower($modelName)) ?>list($q = null, $page = null, $id = null) {
		$this->foreignKeylist('<?= $modelName ?>', $q, $page, $id);
	}
<?php }?>

}
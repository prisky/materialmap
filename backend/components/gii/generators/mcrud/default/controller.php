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
$excelFormats = [];
$gridColumns = $generator->generateGridColumns($generator->modelClass, $modelClass, $excelFormats);

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * <?= $controllerClass ?> implements the CRUD actions for <?= $modelClass ?> model.
 */
class <?= $controllerClass ?> extends <?= '\\' . $generator->baseControllerClass . "\n" ?>
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = <?= $generator->var_export54($excelFormats, '    ') ?>;

	/**
	 * @inheritdoc
	 */
	public function gridColumns($searchModel) {
		return <?= $generator->var_export54($gridColumns, '        ') ?>;
	}

}
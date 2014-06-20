<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var yii\gii\generators\crud\Generator $generator
 */

/** @var \yii\db\ActiveRecord $model */
$model = new $generator->modelClass;

$safeAttributes = $model->safeAttributes();

$modelName = $generator->modelClass;
$modelNameShort = StringHelper::basename($modelName);

$parentModelName = common\components\ActiveRecord::parentName($modelNameShort);

$schemaName = Yii::$app->params['defaultSchema'];
$tableName = 'tbl_' . str_replace('-', '_', Inflector::camel2id($modelNameShort));
$referencedTableName = 'tbl_' . str_replace('-', '_', Inflector::camel2id($parentModelName));

$parentForeignKeyName = Yii::$app->db->createCommand('
	SELECT COLUMN_NAME
	FROM information_schema.KEY_COLUMN_USAGE
	WHERE TABLE_SCHEMA = :schemaName
	AND TABLE_NAME = :tableName
	AND REFERENCED_TABLE_NAME = :referencedTableName', [
		':schemaName' => $schemaName,
		':tableName' => $tableName,
		':referencedTableName' => $referencedTableName,
	])->queryScalar();

if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use backend\components\DetailView;

/**
 * @var yii\web\View $this
 * @var <?= ltrim($generator->modelClass, '\\') ?> $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

    <?= "<?= " ?>DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
<?php foreach ($safeAttributes as $attribute) {
	if($attribute != $parentForeignKeyName) {
		echo $generator->generateActiveField($attribute) . "\n";
	}
} ?>
		]
	]);	?>

</div>

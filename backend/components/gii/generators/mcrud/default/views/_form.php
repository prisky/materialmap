<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var yii\gii\generators\crud\Generator $generator
 */

/** @var \yii\db\ActiveRecord $model */
$modelName = $generator->modelClass;
$model = new $modelName;
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
// get all columns that have labels
$attributesSet = \common\models\Column::find()
	->joinWith('model')
	->where(['auth_item_name' => $modelNameShort])
	->asArray()
	->all();
$attributes = [];
foreach($attributesSet as $attribute) {
	$attributes[$attribute['name']] = $attribute['name'];
}
// clean up the attribute list to the same as in the gridview i.e. just the ones we want to display
$attributes = $modelName::removeNonDisplayAttributes($attributes);
if (empty($attributes)) {
    $attributes = $model->attributes();
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

<div id="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

    <?= "<?= " ?>DetailView::widget([
		'model'=>$model,
		'condensed'=>true,
		'hover'=>true,
		'mode'=>$mode,
		'attributes'=>[
<?php foreach ($attributes as $attribute) {
	if($attribute != $parentForeignKeyName) {
		echo $generator->generateActiveField($attribute) . "\n";
	}
} ?>
		]
	]);	?>

</div>

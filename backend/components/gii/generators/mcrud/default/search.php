<?php

use yii\helpers\StringHelper;

/**
 * This is the template for generating CRUD search class of the specified model.
 *
 * @var yii\web\View $this
 * @var yii\gii\generators\crud\Generator $generator
 */

$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $modelAlias = $modelClass . 'Model';
}
$labels = $generator->generateSearchLabels();
$searchAttributes = [];
$searchConditions = [];
$searchRules = [];
$excelFormats = [];
$gridColumns = $generator->generateGridColumns($generator->modelClass, $modelClass, $excelFormats, $searchConditions, $searchAttributes, $searchRules);

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->searchModelClass, '\\')) ?>;

use yii\data\ActiveDataProvider;
use <?= ltrim($generator->modelClass, '\\') . (isset($modelAlias) ? " as $modelAlias" : "") ?>;

/**
 * <?= $searchModelClass ?> represents the model behind the search form about `<?= $generator->modelClass ?>`.
 */
class <?= $searchModelClass ?> extends <?= isset($modelAlias) ? $modelAlias : $modelClass ?>

{
    <?php foreach($searchAttributes as $searchAttribute) {
		echo "public $$searchAttribute;\n\t";
	} ?>

    public function rules()
    {
        return [
            <?= implode(",\n\t\t\t", $searchRules) ?>,
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = <?= isset($modelAlias) ? $modelAlias : $modelClass ?>::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		<?php foreach($searchConditions as $searchCondition) {
			echo "$searchCondition;\n\t\t";
		} ?>

        return $dataProvider;
    }
}

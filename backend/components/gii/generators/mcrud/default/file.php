<?php
/**
 * This is the template for generating the File class of a specified attribute for a model.
 *
 * @var yii\web\View $this
 * @var yii\gii\generators\model\Generator $generator
 * @var string $attribute the relevant attribute name
 */

use yii\helpers\Inflector;

echo "<?php\n";
?>

namespace common\models;

/**
 * @inheritdoc
 * This contains the rules for the "<?= $attribute ?>" file attribute for the "<?= $className ?>ActiveRecord" model.
 */
class <?= $className . Inflector::id2camel($attribute, '_') . 'File'?> extends \common\components\File
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [<?= "\n            " . implode(",\n                ", $rules) . "\n            " ?>];
	}

}
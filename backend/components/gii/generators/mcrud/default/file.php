<?php
/**
 * This is the template for generating the File class of a specified attribute for a model.
 *
 * @var yii\web\View $this
 * @var yii\gii\generators\model\Generator $generator
 * @var string $attribute the relevant attribute name
 */

echo "<?php\n";
?>

namespace common\models;

/**
 * @inheritdoc. This contains the rules for the "<?= $attribute ?>" file attribute for the "<?= $className ?>" .
 */
class <?= $className . Inflector::id2camel($attribute, '_') . 'File'?> extends \common\components\File
{

    public function rules()
    {
		<?='        return ['?>
		<?php
		foreach($rules as $validator => $rule) {
			echo "            [['file'], {$validator}" . implode(',', $rule) . '],';
		}
		?>
        <?='        ];'?>
   }

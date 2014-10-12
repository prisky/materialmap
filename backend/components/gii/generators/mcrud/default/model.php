<?php
/**
 * This is the template for generating the model class of a specified table.
 *
 * @var yii\web\View $this
 * @var yii\gii\generators\model\Generator $generator
 * @var string $tableName full table name
 * @var string $className class name
 * @var yii\db\TableSchema $tableSchema
 * @var string[] $labels list of attribute labels (name => label)
 * @var string[] $rules list of validation rules
 * @var array $relations list of relations (name => relation declaration)
 */
echo "<?php\n";
?>

namespace <?= $generator->ns ?>;

/**
 * This is the model class for table "<?= $tableName ?>".
 *
<?php foreach ($tableSchema->columns as $column): ?>
 * @property <?= "{$column->phpType} \${$column->name}\n" ?>
<?php endforeach; ?>
<?php if (!empty($relations)): ?>
 *
<?php foreach ($relations as $name => $relation): ?>
 * @property <?= $relation[1] . ($relation[2] ? '[]' : '') . ' $' . lcfirst($name) . "\n" ?>
<?php endforeach; ?>
<?php endif; ?>
 */
class <?= $className ?> extends <?= '\\' . ltrim($generator->baseClass, '\\') . "\n" ?>
{
<?php if ($fileAttributes): ?>
    use \common\components\FileActiveRecordTrait;

<?php foreach ($fileAttributes as $fileAttribute): ?>
    /**
     * @var string $<?= $fileAttribute['column_name'] ?> is a file attribute
     */
    public $<?= $fileAttribute['column_name'] ?>;
<?php endforeach; ?>

    /**
     * Get the attribute names for files
     *
     * @return array or strings - file attribute names
     */
    public function getFileAttributes()
    {
        return [
<?php foreach ($fileAttributes as $fileAttribute): ?>
            '<?= $fileAttribute['column_name'] ?>',
<?php endforeach; ?>
        ];
    }
<?php endif; ?>

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '<?= $generator->generateTableName($tableName) ?>';
    }
<?php if ($generator->db !== 'db'): ?>

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('<?= $generator->db ?>');
    }
<?php endif; ?>

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [<?= "\n            " . implode(",\n            ", $rules) . "\n        " ?>];
    }
<?php foreach ($relations as $name => $relation): ?>

    /**
     * @return \yii\db\ActiveQuery
     */
    public function get<?= $name ?>()
    {
        <?= $relation[0];?>

    }

<?php endforeach; ?>
}

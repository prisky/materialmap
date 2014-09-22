<?php

namespace common\components;

/**
 * Controller is the common controller for both frontend and app.
 *
 * @author Andrew Blake <admin@newzealandfishing.com>
 */
abstract class Controller extends \yii\web\Controller
{

	/**
	 * @var string the model name of the class without namespace
	 */
	public $modelNameShort;
	
 	/**
	 * @var string the model name of the class with namespace
	 */
	public $modelName;
	
 	/**
	 * @inheritdoc
	 */
    public function __construct($id, $module, $config = [])
    {
 		$this->modelNameShort = static::modelNameShort();
		$this->modelName = static::modelName();

		parent::__construct($id, $module, $config = []);
    }
	
	final protected static function modelNameShort()
	{
		$reflect = new \ReflectionClass(get_called_class());
		return str_replace('Controller', '', $reflect->getShortName());
	}

	final protected static function modelName()
	{
		return "\\common\\models\\" . static::modelNameShort();
	}

	/**
	 * Get the plural form of the class name associated with this controller to display
	 * @return type
	 */
	public static function labelPlural()
	{
		$modelName = static::modelName();
		return $modelName::labelPlural();
	}
	
	/**
	 * Get the short version of the associated model for display
	 * @param int $primaryKey The primary key value. If null then the 
	 * @return string The display name
	 */
	public static function labelShort($primaryKey=null)
	{
		$modelName = static::modelName();
		return $modelName::labelShort();
	}
		
	/**
	 * Get the best name to display for a associated model
	 * @param int $primaryKey The primary key value. If null then the 
	 * @return type
	 */
	public static function label($primaryKey = null)
	{
		$modelName = static::modelName();
		return $modelName::label();
	}
	
}
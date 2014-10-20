<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use common\models\Model;

/**
 * Site controller
 */
class SiteController extends \backend\components\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'search'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
	
	public function tabs($content)
	{
		$tabs = [];

		// Get roots
		$models = Model::find()
			->select([Model::tableName() . '.id', 'auth_item_name'])
			->roots()
			->asArray()
			->all();

		// create the tabs
		foreach($models as $model)
		{
			$modelNameShort = $model['auth_item_name'];
			// if no read access for this user for this model
			if(!Yii::$app->user->can($modelNameShort . 'Read'))	{
				// skip this model i.e. no tab
				continue;
			}	
			$modelName = "\\common\models\\$modelNameShort";
			$controller = strtolower($modelNameShort);
			
			$url = ["/$controller"];
			
			// create the tab
			$tab = [
				'label' => $modelName::labelPlural(),
				'content' => '',
				'linkOptions' => ['href' => $url],
			];
			
			// append tab
			$tabs[] = $tab;
		}
		
		return $tabs;
	}

	/**
	 * Builds top level navigatgion structure
	 * @return array the breadcrumbs
	 */
	public function getBreadCrumbs($home = false)
	{
		return ['label' => Yii::t('app', 'Home')];
	}

}

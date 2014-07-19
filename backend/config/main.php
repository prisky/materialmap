<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
	'modules' => [
	   'gridview' =>  [
			'class' => '\kartik\grid\Module',
		],
		'markdown' => [
			// the module class
			'class' => 'kartik\markdown\Module',

			// the controller action route used for downloading the markdown exported file
			 'downloadAction' => '/markdown/parse/download',
        
			// the controller action route used for markdown editor preview
			'previewAction' => '/markdown/parse/preview',

			// whether to use PHP SmartyPantsTypographer to process Markdown output
			'smartyPants' => true
		],
	],
];

<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
 	'components' => [
		'request' => [
			'enableCookieValidation' => true,
			'enableCsrfValidation' => true,
			'cookieValidationKey' => 'as43bvfd234',
		],
        'user' => [
			'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
		'db' => [
			'class' => 'yii\db\Connection',
			'tablePrefix' => 'tbl_',
			'charset' => 'utf8',
		],
		'assetManager' => [
			'linkAssets' => true,
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'authManager' => [
			'class' => 'common\components\DbManager',
			'defaultRoles' => ['end-user'],
		],
	],
];

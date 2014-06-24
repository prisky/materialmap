<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
 	'components' => [
        'user' => [
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

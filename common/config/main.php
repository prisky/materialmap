<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
 	'components' => [
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
			'class' => yii\rbac\DbManager::className(),
			'defaultRoles' => ['end-user'],
		],
	],
];

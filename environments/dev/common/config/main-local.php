<?php
return [
	'modules' => [
		'gii' => [
			'class' => 'yii\gii\Module',      
			'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'],  
			 'generators' => [
				'mcrud' => [
					'class' => 'backend\components\gii\generators\mcrud\Generator',
					'templates' => [
						'my' => '@app/components/gii/generators/mcrud/default',
					]
				]
			],
		],
	],
    'components' => [
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];

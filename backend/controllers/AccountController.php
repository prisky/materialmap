<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;
use yii\filters\VerbFilter;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends \backend\components\Controller
{
	use \common\components\FileControllerTrait;

	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "annual_charge" => "\$#,##0.00;[Red]-\$#,##0.00",
        "balance" => "\$#,##0.00;[Red]-\$#,##0.00",
        "booking_charge" => "\$#,##0.00;[Red]-\$#,##0.00",
        "rate" => "0.00%",
        "seat_charge" => "\$#,##0.00;[Red]-\$#,##0.00",
        "sms_charge" => "\$#,##0.00;[Red]-\$#,##0.00",
        "summary_charge" => "\$#,##0.00;[Red]-\$#,##0.00",
        "ticket_charge" => "\$#,##0.00;[Red]-\$#,##0.00"
    ];

	/**
	 * @inheritdoc
	 */
	public function gridColumns($searchModel) {
		return [
            [
                "attribute" => "annual_charge",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_annual_charge",
                    "attribute2" => "to_annual_charge",
                    "type" => "widget",
                    "widgetClass" => "\\kartik\\money\\MaskMoney",
                    "widgetOptions1" => [
                        "pluginOptions" => [
                            "allowEmpty" => TRUE
                        ]
                    ],
                    "widgetOptions2" => [
                        "pluginOptions" => [
                            "allowEmpty" => TRUE
                        ]
                    ]
                ]
            ],
            [
                "attribute" => "balance",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_balance",
                    "attribute2" => "to_balance",
                    "type" => "widget",
                    "widgetClass" => "\\kartik\\money\\MaskMoney",
                    "widgetOptions1" => [
                        "pluginOptions" => [
                            "allowEmpty" => TRUE
                        ]
                    ],
                    "widgetOptions2" => [
                        "pluginOptions" => [
                            "allowEmpty" => TRUE
                        ]
                    ]
                ]
            ],
            [
                "attribute" => "booking_charge",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_booking_charge",
                    "attribute2" => "to_booking_charge",
                    "type" => "widget",
                    "widgetClass" => "\\kartik\\money\\MaskMoney",
                    "widgetOptions1" => [
                        "pluginOptions" => [
                            "allowEmpty" => TRUE
                        ]
                    ],
                    "widgetOptions2" => [
                        "pluginOptions" => [
                            "allowEmpty" => TRUE
                        ]
                    ]
                ]
            ],
            [
                "attribute" => "optimisation",
                "filter" => [
                    "None" => "None",
                    "Compress" => "Compress",
                    "Spread" => "Spread"
                ]
            ],
            [
                "attribute" => "phone_work"
            ],
            [
                "attribute" => "rate",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_rate",
                    "attribute2" => "to_rate",
                    "type" => "\\kartik\\widgets\\TouchSpin",
                    "widgetOptions1" => [
                        "pluginOptions" => [
                            "verticalbuttons" => TRUE,
                            "verticalupclass" => "glyphicon glyphicon-plus",
                            "verticaldownclass" => "glyphicon glyphicon-minus"
                        ]
                    ],
                    "widgetOptions2" => [
                        "pluginOptions" => [
                            "verticalbuttons" => TRUE,
                            "verticalupclass" => "glyphicon glyphicon-plus",
                            "verticaldownclass" => "glyphicon glyphicon-minus"
                        ]
                    ]
                ]
            ],
            [
                "attribute" => "seat_charge",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_seat_charge",
                    "attribute2" => "to_seat_charge",
                    "type" => "widget",
                    "widgetClass" => "\\kartik\\money\\MaskMoney",
                    "widgetOptions1" => [
                        "pluginOptions" => [
                            "allowEmpty" => TRUE
                        ]
                    ],
                    "widgetOptions2" => [
                        "pluginOptions" => [
                            "allowEmpty" => TRUE
                        ]
                    ]
                ]
            ],
            [
                "attribute" => "sms_charge",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_sms_charge",
                    "attribute2" => "to_sms_charge",
                    "type" => "widget",
                    "widgetClass" => "\\kartik\\money\\MaskMoney",
                    "widgetOptions1" => [
                        "pluginOptions" => [
                            "allowEmpty" => TRUE
                        ]
                    ],
                    "widgetOptions2" => [
                        "pluginOptions" => [
                            "allowEmpty" => TRUE
                        ]
                    ]
                ]
            ],
            [
                "attribute" => "summary_charge",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_summary_charge",
                    "attribute2" => "to_summary_charge",
                    "type" => "widget",
                    "widgetClass" => "\\kartik\\money\\MaskMoney",
                    "widgetOptions1" => [
                        "pluginOptions" => [
                            "allowEmpty" => TRUE
                        ]
                    ],
                    "widgetOptions2" => [
                        "pluginOptions" => [
                            "allowEmpty" => TRUE
                        ]
                    ]
                ]
            ],
            [
                "attribute" => "ticket_charge",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_ticket_charge",
                    "attribute2" => "to_ticket_charge",
                    "type" => "widget",
                    "widgetClass" => "\\kartik\\money\\MaskMoney",
                    "widgetOptions1" => [
                        "pluginOptions" => [
                            "allowEmpty" => TRUE
                        ]
                    ],
                    "widgetOptions2" => [
                        "pluginOptions" => [
                            "allowEmpty" => TRUE
                        ]
                    ]
                ]
            ],
            [
                "attribute" => "user_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('User', []),
                "value" => function($model, $key, $index, $widget) {
								return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "user");
							},
                "format" => "raw"
            ]
        ];
	}

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['search'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],	// guests
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'search'],
                        'roles' => ['@'],	// authorized
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'delete', 'upload'],
                        'roles' => [$this->modelNameShort],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view', 'index', 'export', 'list', 'getExisting'],
                        'roles' => [$this->modelNameShort . 'Read'],
                    ],
                ],
            ],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}	
	
}
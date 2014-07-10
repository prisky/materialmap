<?php

namespace backend\controllers;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends \backend\components\Controller
{
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
	public function getGridColumns() {
		return [
            [
                "class" => "yii\\grid\\ActionColumn",
                "template" => "{update} {delete}"
            ],
            [
                "attribute" => "address_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => [
                    "pluginOptions" => [
                        "allowClear" => TRUE,
                        "ajax" => [
                            "url" => "/bookaspot/backend/web/index.php?r=gii%2Fdefault%2Faddresslist",
                            "dataType" => "json",
                            "data" => "function (term, page) {\n\treturn {\n\t\tq: term,\n\t\tpage_limit: 10,\n\t\tpage: page,\n\t};\n}",
                            "results" => "function (data, page) {\n\tvar more = (page * 10) < data.total;\n\n\treturn {\n\t\tresults: data.results,\n\t\tmore: more\n\t};\n}"
                        ],
                        "initSelection" => "function (element, callback) {\n    var id=\$(element).val();\n    if (id !== \"\") {\n        \$.ajax(\"/bookaspot/backend/web/index.php?r=gii%2Fdefault%2Faddresslist?id=\" + id, {dataType: \"json\"}).done(function(data) { callback(data.results);});\n    }\n}"
                    ]
                ],
                "value" => function ($model, $key, $index, $widget) {
								if(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->label($key), Url::toRoute([strtolower($model->modelNameShort) . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->label($key), Url::toRoute([strtolower($model->modelNameShort) . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ],
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
                "filterWidgetOptions" => [
                    "pluginOptions" => [
                        "allowClear" => TRUE,
                        "ajax" => [
                            "url" => "/bookaspot/backend/web/index.php?r=gii%2Fdefault%2Fuserlist",
                            "dataType" => "json",
                            "data" => "function (term, page) {\n\treturn {\n\t\tq: term,\n\t\tpage_limit: 10,\n\t\tpage: page,\n\t};\n}",
                            "results" => "function (data, page) {\n\tvar more = (page * 10) < data.total;\n\n\treturn {\n\t\tresults: data.results,\n\t\tmore: more\n\t};\n}"
                        ],
                        "initSelection" => "function (element, callback) {\n    var id=\$(element).val();\n    if (id !== \"\") {\n        \$.ajax(\"/bookaspot/backend/web/index.php?r=gii%2Fdefault%2Fuserlist?id=\" + id, {dataType: \"json\"}).done(function(data) { callback(data.results);});\n    }\n}"
                    ]
                ],
                "value" => function ($model, $key, $index, $widget) {
								if(Yii::$app->user->can($model->modelNameShort)) {
									return Html::a($model->label($key), Url::toRoute([strtolower($model->modelNameShort) . "/update", "id" => $key]));
								}
								elseif(Yii::$app->user->can($model->modelNameShort . "Read")) {
									return Html::a($model->label($key), Url::toRoute([strtolower($model->modelNameShort) . "/read", "id" => $key]));
								}
								else {
									return $model->label($key);
								}
							},
                "format" => "raw"
            ]
        ];
	}
	
	
	/**
	 * Produce widget options for a Select2 widget for the address_id foreign key attribute
	 * referencing the tbl_address table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionAddresslist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('Address', $q, $page, $id);
	}

	/**
	 * Produce widget options for a Select2 widget for the user_id foreign key attribute
	 * referencing the tbl_user table
	 * @param mixed $q The search term the user enters - sent by ajax with each keypress
	 * @param mixed $page The page of results - sets limit and offset in our select i.e. offset is (page - 1) x 10
	 * @param mixed $id The id of the model to load initially
	 */
	 public function actionUserlist($q = null, $page = null, $id = null) {
		$this->foreignKeylist('User', $q, $page, $id);
	}

}
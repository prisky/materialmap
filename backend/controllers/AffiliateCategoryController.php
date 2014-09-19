<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * AffiliateCategoryController implements the CRUD actions for AffiliateCategory model.
 */
class AffiliateCategoryController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [
        "level" => "#",
        "lft" => "#",
        "rgt" => "#",
        "root" => "#"
    ];

	/**
	 * @inheritdoc
	 */
	public function gridColumns($searchModel) {
		return [
            [
                "attribute" => "account_id",
                "filterType" => "\\kartik\\widgets\\Select2",
                "filterWidgetOptions" => Controller::fKWidgetOptions('Account', []),
                "value" => function($model, $key, $index, $widget) {
								return \backend\components\GridView::foreignKeyValue($model, $key, $index, $widget, "account");
							},
                "format" => "raw"
            ],
            [
                "attribute" => "level",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_level",
                    "attribute2" => "to_level"
                ]
            ],
            [
                "attribute" => "lft",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_lft",
                    "attribute2" => "to_lft"
                ]
            ],
            [
                "attribute" => "name"
            ],
            [
                "attribute" => "rgt",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_rgt",
                    "attribute2" => "to_rgt"
                ]
            ],
            [
                "attribute" => "root",
                "filterType" => "backend\\components\\FieldRange",
                "filterWidgetOptions" => [
                    "separator" => NULL,
                    "attribute1" => "from_root",
                    "attribute2" => "to_root"
                ]
            ]
        ];
	}

}
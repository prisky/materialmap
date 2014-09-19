<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
 * StateProvinceRegionController implements the CRUD actions for StateProvinceRegion model.
 */
class StateProvinceRegionController extends \backend\components\Controller
{
	/**
	 * @inheritdoc
	 */
	public $excelFormats = [

    ];

	/**
	 * @inheritdoc
	 */
	public function gridColumns($searchModel) {
		return [
            [
                "attribute" => "country_id"
            ],
            [
                "attribute" => "name"
            ]
        ];
	}

}
<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
* SeatTypeController implements the CRUD actions for SeatType model.
*/
class SeatTypeController extends \backend\components\Controller
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
                "attribute" => "name"
            ]
        ];
    }

}

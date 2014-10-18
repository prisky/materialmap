<?php

namespace backend\controllers;

use Yii;
use kartik\helpers\Html;
use yii\helpers\Url;
use backend\components\Controller;
use yii\helpers\Inflector;

/**
* RfidTagController implements the CRUD actions for RfidTag model.
*/
class RfidTagController extends \backend\components\Controller
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
                "attribute" => "activation",
                "filter" => [
                    "Active" => "Active",
                    "Inactive" => "Inactive"
                ]
            ],
            [
                "attribute" => "name_plate"
            ],
            [
                "attribute" => "commodity_code"
            ],
            [
                "attribute" => "latitude"
            ],
            [
                "attribute" => "longitude"
            ]
        ];
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // redirect back to parent admin view
            $params[] = 'index';
            $fullModelName = $this->modelName;
            if ($parentAttribute = $fullModelName::parentAttribute()) {
                $params[$parentAttribute] = $model->$parentAttribute;
            }
            $this->redirect($params);
        }

        return $this->render('//' . $this->id . '/_form', [
            'model' => $model,
            'mode' => \backend\components\DetailView::MODE_EDIT,
            'name' => ($model->commodity_code || $model->name_plate),
            'lat' => $model->latitude,
            'long' => $model->longitude,
        ]);
    }

}

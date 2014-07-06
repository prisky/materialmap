<?php

/* 
 * Copyright Andrew Blake 2014.
 */

namespace backend\controllers;

use Yii;
use yii\helpers\Json;
use kartik\grid\GridView;

/**
 * Adds access control
 * @inheritdoc
 */
class ExportController extends backend\components\Controller
{
    /**
     * Download the exported file
     */
    public function actionDownload()
    {
		$objPHPExcel = new \PHPExcel();

        $type = empty($_POST['export_filetype']) ? 'html' : $_POST['export_filetype'];
        $name = empty($_POST['export_filename']) ? Yii::t('kvgrid', 'export') : $_POST['export_filename'];
        $content = empty($_POST['export_content']) ? Yii::t('kvgrid', 'No data found') : $_POST['export_content'];
        $this->setHttpHeaders($type, $name);
        return $content;
    }

    /**
     * Sets the HTTP headers needed by file download action.
     */
    protected function setHttpHeaders($type, $name)
    {
        if ($type == GridView::CSV) {
            $mime = 'text/csv';
        } elseif ($type == GridView::TEXT) {
            $mime = 'text/plain';
        } elseif ($type == GridView::HTML) {
            $mime = 'text/html';
        } else {
            $mime = 'application/vnd.ms-excel';
        }
        Yii::$app->getResponse()->getHeaders()
                 ->set('Pragma', 'public')
                 ->set('Expires', '0')
                 ->set('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
                 ->set('Content-Disposition', 'attachment; filename="' . $name . '.' . $type . '"')
                 ->set('Content-type', $mime . '; charset=utf-8');
    }
}
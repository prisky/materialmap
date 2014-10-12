<?php

namespace common\components;

use yii\imagine\Image;
use Imagine\Image\ManipulatorInterface;
use Yii;
use Imagine\Image\Box;

class ImageHelper
{

    public static function saveTemporaryImage($filename, $name, $size, $basePath)
    {
        list($width, $height) = explode('x', str_replace('/', '', $size));

        $runtimeDir = Yii::$app->getRuntimePath() . '/' . $basePath . '/' . $size;
        exec("mkdir -p $runtimeDir");
        $name = $runtimeDir . '/' . $name;

        $file = Image::getImagine()->open($filename);

        if ($file->getSize()->getWidth() < $width) {
            $file->resize($file->getSize()->widen($width));
        }

        if ($file->getSize()->getHeight() < $height) {
            $file->resize($file->getSize()->heighten($height));
        }

        $file->thumbnail(new Box($width, $height), ManipulatorInterface::THUMBNAIL_OUTBOUND)
            ->save($name);

        return $name;
    }

}

<?php

namespace common\models;

/**
 * This is the model class for table "tbl_site".
 *
 * @property integer $id
 * @property string $name
 * @property string $latitude
 * @property string $longitude
 * @property integer $deleted
 */
class Site extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_site';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
        ];
    }

}

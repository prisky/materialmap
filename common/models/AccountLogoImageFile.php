<?php

namespace common\models;

/**
 * @inheritdoc. This contains the rules for the "logo_image" file attribute for the "AccountActiveRecord" model.
 */
class AccountLogoImageFile extends \common\components\File
{

    public function rules()
    {
		        return [		            [['file'], \common\components\FileValidatorfalse],                ];   }

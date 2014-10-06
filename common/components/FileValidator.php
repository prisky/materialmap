<?php

namespace common\components;
use yii\web\UploadedFile;

class FileValidator extends \yii\validators\FileValidator {
	/**
	 * @inheritdoc. Skips over existing files - i.e. they don't actually have 
	 */
    public function validateAttribute($object, $attribute)
    {
        if ($this->maxFiles > 1) {
            $files = $object->$attribute;
            if (!is_array($files)) {
                $this->addError($object, $attribute, $this->uploadRequired);

                return;
            }
            foreach ($files as $i => $file) {
				// AB altered here
                if ($file instanceof UploadedFile && $file->error == UPLOAD_ERR_NO_FILE) {
                    unset($files[$i]);
                }
            }
				// AB altered here
//            $object->$attribute = array_values($files);
            if (empty($files)) {
                $this->addError($object, $attribute, $this->uploadRequired);
            }
            if (count($files) > $this->maxFiles) {
                $this->addError($object, $attribute, $this->tooMany, ['limit' => $this->maxFiles]);
            } else {
                foreach ($files as $file) {
					// AB altered here
					if($file instanceof UploadedFile) {
						$result = $this->validateValue($file);
						if (!empty($result)) {
							$this->addError($object, $attribute, $result[0], $result[1]);
						}
					}
				}
            }
		// AB altered here
		} elseif ($file instanceof UploadedFile) {
            $result = $this->validateValue($object->$attribute);
            if (!empty($result)) {
                $this->addError($object, $attribute, $result[0], $result[1]);
            }
        }
    }

}
<?php
/* 
 * Copyright Andrew Blake 2014.
 */
namespace common\components;
use Aws\S3\Enum\CannedAcl;
use yii\web\UploadedFile;
use common\components\ImageHelper;
use Yii;

/**
 * File is the model for an uploaded file
 */
class File extends \yii\base\Model
{
	const LARGE_IMAGE = '400x400';
	const SMALL_IMAGE = '80x80';
	
    /**
     * @var UploadedFile|Null file attribute
     */
    public $file;
	
	public $name;
	
	public $basePath;
	
	public $urlExpiry = '+10 minutes';

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
			[['file'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png',],
        ];
    }
	
	public function save()
	{
		if ($this->file && $this->file instanceof UploadedFile && !empty($this->file->tempName)) {
			$large = ImageHelper::saveTemporaryImage($this->file->tempName, $this->file->name, self::LARGE_IMAGE, $this->basePath);
			$small = ImageHelper::saveTemporaryImage($this->file->tempName, $this->file->name, self::SMALL_IMAGE, $this->basePath);

			// amazon s3
			$manager = Yii::$app->resourceManager;
			
			$options = [
				'Bucket' => $manager->bucket,
				'Key' => $this->basePath . '/' . self::LARGE_IMAGE . '/' . $this->file->name,
				'SourceFile' => $large,
				'ACL' => CannedAcl::PUBLIC_READ
			];

			$manager->getClient()->putObject($options);

			$options['Key'] = $this->basePath . '/' . self::SMALL_IMAGE . '/' . $this->file->name;
			$options['SourceFile'] = $small;

			$manager->getClient()->putObject($options);

			@unlink($large);
			@unlink($small);
			
			$this->name = $this->file->name;
		}
	}
	
	public function getImageUrl($type = self::LARGE_IMAGE) {
		return Yii::$app->resourceManager->getUrl(
			$this->basePath . '/' . $type . '/' . $this->name,
			$this->urlExpiry
		);
	}

}

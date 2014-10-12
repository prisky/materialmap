<?php

namespace common\components;

use Zelenin\yii\widgets\Summernote\Summernote;

class HtmlEditor extends Summernote
{
	public $clientOptions = [
		'focus' => true,
		'codemirror' => [
			'theme' => 'monokai',
			'lineNumbers' => true,
		],
	];
}

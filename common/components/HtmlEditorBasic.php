<?php

namespace common\components;

use Zelenin\yii\widgets\Summernote\Summernote;

class HtmlEditorBasic extends Summernote
{
	public $clientOptions = [
		'toolbar' => [
			['insert', ['picture']],
			['misc', ['undo', 'redo']],
		],
	];
}

<?php

/* 
 * Copyright Andrew Blake 2014.
 */

namespace backend\components;

class GridView extends \kartik\grid\GridView {
	/**
	 * @inheritdoc
	 */
	protected $template2 = <<< HTML
    <div class="panel {type}">
        <div class="panel-heading clearfix">
			<div class="pull-right kv-panel-pager">{pager}</div>
            <div class="pull-right">{summary}</div>
           {heading}
        </div>
         {before}
        {items}
        {after}
    </div>
HTML;

}


<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
yii\apidoc\templates\bootstrap\assets\AssetBundle::register($this);
AppAsset::register($this);
$menuItems = [];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->params['businessName'],
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
		?>

		<div class="navbar-form navbar-left" role="search">
		  <div class="form-group">
			  <input id="searchbox" type="text" class="form-control" placeholder="Search">
		  </div>
		</div>
		
		<?php
			$this->registerJs("
				$('#searchbox')
					.on('click', function(e) {
						// load help from server - if empty then show help for the current context otherwise scanning for results
						$('#search-resultbox').load('" . Url::toRoute('search') . "&q=' + encodeURIComponent($(this).val()));
					})
					// when text is changed in search box
					.on('paste keyup', function(e) {
						// load help from server - if empty then show help for the current context otherwise scanning for results - allow abort
						// hence not using jquery load
						if (typeof this.xhr !== 'undefined')
							this.xhr.abort();
						this.xhr = $.ajax({
							url: '" . Url::toRoute('search') . "&q=' + encodeURIComponent($(this).val()),
							type: 'GET',
							success: function (data) {
								//process response
								$('#search-resultbox').html(data);
							}
						});
					})
					// block bubbling of keypress event for search box
					.click(function(e) { e.stopPropagation() })
					// on focus show the modal and allow a click in modal with no bubbling
					.focus(function() { $('#search-resultbox')
						.show()
						.click(function(e) { e.stopPropagation() })
					});
				// any click outside of search box or modal should bubble to doc and hide the search results
				$(document).click(function (e) { $('#search-resultbox').hide() });
				// hide the search results on ESC
				$(document).on('keyup', function(e) { if (e.which == 27) { $('#search-resultbox').hide(); } });
			");		
			
			// TODO: probably should have different layout for login rather than these conidtions hard coded in
			if($this->context->action->id != 'login') {
				if(Yii::$app->user->isGuest) {
					$menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
				} else {
					$menuItems[] = [
						'label' => 'Logout (' . Yii::$app->user->identity->contact->email . ')',
						'url' => ['/site/logout'],
						'linkOptions' => ['data-method' => 'post']
					];
				}
			}
			
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

		<div id="search-resultbox" style="display: none;" class="modal-content"></div>
		<div class="container">
		<?php
			if($this->context->action->id != 'login' && isset($this->context->action->controller->breadCrumbs)) {
				echo  Breadcrumbs::widget([
					'links' => $this->context->action->controller->breadCrumbs,
					'homeLink' => false,
					]);
				echo \backend\components\Tabs::widget(['items' => $this->context->action->controller->tabs($content)]);
			}
			else {
				echo $content;
			}
		?>
		</div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

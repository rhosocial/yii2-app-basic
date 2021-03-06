<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
            ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']],
            ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => Yii::t('user', 'Login'), 'url' => ['/user/auth/login']]
            ) : [
                'label' => (Yii::$app->user->identity->profile ? Yii::$app->user->identity->profile->nickname : 'No profile') .' (' . Yii::$app->user->identity->getID() . ')',
                'encode' => true,
                'items' => [
                    ['label' => Yii::t('user', 'Me'), 'url' => ['/user/my']],
                    ['label' => Yii::t('organization', 'My Organizations'), 'url' => ['/organization/my']],
                    (!Yii::$app->user->isGuest && Yii::$app->user->isAdmin) ? [
                        'label' => Yii::t('user', 'Admin'), 'url' => ['/admin'],
                    ] : (''),
                    '<li role="presentation" class="divider"></li>',
                    ['label' => Yii::t('user', 'Logout'), 'url' => ['/user/auth/logout'], 'linkOptions' => ['data-method' => 'post', 'data-pjax' => '0']],
                ],
            ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::t('yii', 'Powered by {yii}', [
                'yii' => '<a href="https://vistart.me/" rel="external">' . 'vistart' . '</a>'
            ]) ?></p>
    </div>
        <?php if (isset(Yii::$app->params['cnzz'])): ?>
    <div class="hidden">
        <?= Yii::$app->params['cnzz'] ?>
    </div>
        <?php endif; ?>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

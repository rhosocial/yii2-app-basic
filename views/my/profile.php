<?php

/**
 *  _   __ __ _____ _____ ___  ____  _____
 * | | / // // ___//_  _//   ||  __||_   _|
 * | |/ // /(__  )  / / / /| || |     | |
 * |___//_//____/  /_/ /_/ |_||_|     |_|
 * @link https://vistart.me/
 * @copyright Copyright (c) 2016 - 2017 vistart
 * @license https://vistart.me/license/
 */

use app\models\User;
use app\models\Profile;
use rhosocial\user\widgets\ProfileFormWidget;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $user User */
/* @var $model Profile */

$this->title = Yii::t('user', 'Update User') . ' (' . $user->getID() . ')';
$this->params['breadcrumbs'][] = Yii::t('user', 'Update User');
echo ProfileFormWidget::widget(['model' => $model]);
?>
<h3><?= Yii::t('user', 'Other operations') ?></h3>
<hr>
<div class="row">
    <div class="col-md-12">
        <?= Html::a(Yii::t('user', 'Back'), [
            '/user/my/index',
        ], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('user', 'Change Password'), ['/user/my/change-password'], ['class' => 'btn btn-primary']) ?>
    </div>
</div>

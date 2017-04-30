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

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Class MyController
 * @package app\controllers
 * @version 1.0
 * @author vistart <i@vistart.me>
 */
class MyController extends Controller
{
    public $layout = '@rhosocial/user/web/user/views/layouts/my';
    public $baseViewPath = '//my/';

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'profile' => [
                'class' => \app\controllers\my\ProfileAction::class
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actionIndex()
    {
        return $this->render($this->baseViewPath . 'index');
    }
}

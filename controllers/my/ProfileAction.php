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

namespace app\controllers\my;

use app\models\organization\Profile;
use app\models\User;
use rhosocial\user\web\user\Module;
use Yii;
use yii\base\Action;

/**
 * Class ProfileAction
 * @package app\controllers\my
 * @version 1.0
 * @author vistart <i@vistart.me>
 */
class ProfileAction extends Action
{
    /**
     * Run action.
     * @return string|\yii\web\Response
     */
    public function run()
    {
        $user = Yii::$app->user->identity;
        /* @var $user User */
        $model = $user->profile;
        if (empty($model)) {
            $model = $user->createProfile();
        }
        $model->scenario = Profile::SCENARIO_UPDATE;
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash(Module::SESSION_KEY_RESULT, Module::RESULT_SUCCESS);
                Yii::$app->session->setFlash(Module::SESSION_KEY_MESSAGE, Yii::t('user', 'Updated.'));
                return $this->controller->redirect(['/user/my/profile']);
            }
            Yii::$app->session->setFlash(Module::SESSION_KEY_RESULT, Module::RESULT_FAILED);
            Yii::$app->session->setFlash(Module::SESSION_KEY_MESSAGE, Yii::t('user','Failed to Update.'));
        }
        return $this->controller->render($this->controller->baseViewPath . 'profile', ['user' => $user, 'model' => $model]);
    }
}

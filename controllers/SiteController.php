<?php

namespace app\controllers;

use app\models\ContactForm;
use rhosocial\user\forms\LoginForm;
use rhosocial\user\forms\RegisterForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;

class SiteController extends Controller
{
    const SESSION_KEY_REGISTER_USER_ID = 'session_key_register_user_id';
    const SESSION_KEY_REGISTER_FAILED_MESSAGE = 'session_key_register_failed_message';
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post())) {
            try {
                if ($model->register()) {
                    Yii::$app->session->setFlash(self::SESSION_KEY_REGISTER_USER_ID, $model->model->getID());
                    return $this->redirect(Url::to(['site/register-success']));
                }
            } catch (\Exception $ex) {
                Yii::error($ex->getMessage(), __METHOD__);
                Yii::$app->session->setFlash(self::SESSION_KEY_REGISTER_FAILED_MESSAGE, $ex->getMessage());
            }
            return $this->redirect(Url::to(['site/register-failed']));
        }
        return $this->render('register', [
            'model' => $model,
        ]);
    }
    
    public function actionRegisterSuccess()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $id = Yii::$app->session->getFlash(self::SESSION_KEY_REGISTER_USER_ID);
        if ($id === null) {
            return $this->redirect(['site/register']);
        }
        return $this->render('register-success', ['id' => $id]);
    }
    
    public function actionRegisterFailed()
    {
        return $this->render('register-failed', ['message' => Yii::$app->session->getFlash(self::SESSION_KEY_REGISTER_FAILED_MESSAGE)]);
    }
}

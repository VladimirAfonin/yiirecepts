<?php /** @noinspection PhpUndefinedClassConstantInspection */

namespace frontend\controllers;

use frontend\forms\DeliveryForm;
use frontend\forms\RangeForm;
use frontend\forms\UploadedForm;
use shop\entities\Article;
use Yii;
use yii\base\InvalidParamException;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
//                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['captcha', 'file', 'range', 'delivery', 'contact', 'article'],
                        'allow' => true,
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
//                'class' => 'yii\captcha\CaptchaAction',
                'class' => 'frontend\components\MathCaptchaAction',
                'minLength' => 1,
                'maxLength' => 10,
//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();

        if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionArticle()
    {
        $article = new Article();
        $article->name = 'Valentine day is coming... bla bla bla ...';
        $article->description = 'Homer the clown is angry. Something description here.';

        // send email through event
        $article->on(ActiveRecord::EVENT_AFTER_INSERT, function ($event) {
            $followers = ['tanandre442@gmail.com', 'afoninvladimir@yahoo.com'];
            foreach ($followers as $follower) {
                Yii::$app->mailer->compose()
                    ->setFrom('afonin006@gmail.com')
                    ->setTo($follower)
                    ->setSubject($event->sender->name)
                    ->setTextBody($event->sender->description)
                    ->send();
            }
            echo 'Emails was sent';
        });

        if (!$article->save()) {
            echo VarDumper::dumpAsString($article->getErrors());
        }
    }

    public function actionArticleCustom()
    {
        $article = new Article();
        $article->name = 'Valentine day is coming... bla bla bla ...';
        $article->description = 'Homer the clown is angry. Something description here.';

        // send email through event
        $article->on(Article::EVENT_OUR_CUSTOM_EVENT, function ($event) {
            $followers = ['tanandre442@gmail.com', 'afoninvladimir@yahoo.com'];

            foreach ($followers as $follower) {
                Yii::$app->mailer->compose()
                    ->setFrom('afonin006@gmail.com')
                    ->setTo($follower)
                    ->setSubject($event->sender->name)
                    ->setTextBody($event->sender->description)
                    ->send();
            }

            echo 'Emails was sent';
        });

        if (!$article->save()) {
            echo VarDumper::dumpAsString($article->getErrors());
        } else {
            $article->trigger(Article::EVENT_OUR_CUSTOM_EVENT);
        }
    }

    public function actionUrls()
    {
        return $this->render('urls');
    }

    /**
     * @return string
     */
    public function actionFile()
    {
        $uploadForm = new UploadedForm();
        if (Yii::$app->request->isPost) {
            $uploadForm->imageFiles = UploadedFile::getInstances($uploadForm, 'imageFiles');
            if ($uploadForm->upload()) {
                return $this->renderContent("File  is uploaded successfully");
            }
        }
        return $this->render('file', ['model' => $uploadForm]);
    }

    /**
     * @return string
     */
    public function actionRange()
    {
        $form = new RangeForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            Yii::$app->session->setFlash('rangeFormSubmitted', 'The form was successfully processed!');
        }
        return $this->render('range', ['model' => $form]);
    }

    /**
     * @return string
     */
    public function actionDelivery()
    {
        $form = new DeliveryForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            Yii::$app->session->setFlash('success', 'the form was successfully processed!');
        }
        return $this->render('delivery', ['model' => $form]);
    }
}

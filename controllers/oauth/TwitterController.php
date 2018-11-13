<?php

namespace app\controllers\oauth;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class TwitterController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCallback()
    {
        return $this->render('callback');
    }

}
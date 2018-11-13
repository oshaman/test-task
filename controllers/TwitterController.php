<?php

namespace app\controllers;


use app\models\Twitter;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Name;

class TwitterController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAdd()
    {
        $result = Twitter::addUser(Yii::$app->request);


        if (array_key_exists('error', $result)) {
            return json_encode($result);
        }

        return \Yii::createObject([
            'class' => 'yii\web\Response',
            'format' => \yii\web\Response::FORMAT_JSON,
            'data' => [
                'message' => '',
                'code' => 200,
            ],
        ]);
    }

    public function actionRemove()
    {
        $result = Twitter::removeUser(Yii::$app->request);


        if (array_key_exists('error', $result)) {
            return json_encode($result);
        }

        return \Yii::createObject([
            'class' => 'yii\web\Response',
            'format' => \yii\web\Response::FORMAT_JSON,
            'data' => [
                'message' => '',
                'code' => 200,
            ],
        ]);
    }

    public function actionFeed()
    {
        $result = Twitter::getTweets(Yii::$app->request);


        if (array_key_exists('error', $result)) {
            return json_encode($result);
        }

        return \Yii::createObject([
            'class' => 'yii\web\Response',
            'format' => \yii\web\Response::FORMAT_JSON,
            'data' => [
                'feed' => json_encode($result, JSON_UNESCAPED_UNICODE),
                'code' => 200,
            ],
        ]);
    }

}
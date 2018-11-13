<?php

namespace app\models;

use yii\base\DynamicModel;

require_once('/home/jenshen/j2landing.com/oshaman/vendor/j7mbo/twitter-api-php/TwitterAPIExchange.php');

use TwitterAPIExchange;

class Twitter
{
    public static function addUser($request): array
    {

        $id = $request->get('id');
        $user = $request->get('user');
        $secret = $request->get('secret');


        $model = DynamicModel::validateData(compact('id', 'user', 'secret'), [
            [['id', 'user', 'secret'], 'required'],
            [['id', 'user', 'secret'], 'string'],
        ]);

        if ($model->hasErrors()) {
            return ["error" => "missing parameter"];
        } elseif ($secret !== sha1($id . $user)) {
            return ["error" => "access denied"];
        } elseif (static::getUser($user)) {
            return ["error" => "user already exists"];
        }

        $name = new Name();

        $name->addUser($user);

        return ['success' => 'success'];

    }

    public static function removeUser($request): array
    {

        $id = $request->get('id');
        $user = $request->get('user');
        $secret = $request->get('secret');


        $model = DynamicModel::validateData(compact('id', 'user', 'secret'), [
            [['id', 'user', 'secret'], 'required'],
            [['id', 'user', 'secret'], 'string'],
        ]);

        if ($model->hasErrors()) {
            return ["error" => "missing parameter"];
        } elseif ($secret !== sha1($id . $user)) {
            return ["error" => "access denied"];
        } elseif (!($name = static::getUser($user))) {
            return ["error" => "no user"];
        }

        $name->removeUser();

        return ['success' => 'success'];

    }

    public static function getTweets($request): array
    {
        $id = $request->get('id');
        $secret = $request->get('secret');
        $model = DynamicModel::validateData(compact('id', 'secret'), [
            [['id', 'secret'], 'required'],
            [['id', 'secret'], 'string'],
        ]);

        if ($model->hasErrors()) {
            return ["error" => "missing parameter"];
        } elseif ($secret !== sha1($id)) {
            return ["error" => "access denied"];
        }

        $names = Name::find()->all();

        if (count($names) < 1) {
            $result = [];
        } else {
            $result = [];
            foreach ($names as $name) {
                $response = static::requestTwitts($name->user);

                if (count($response) || !array_key_exists('errors', $response) || !array_key_exists('error', $response)) {
                    $data = static::responseHandle($response);

                    if (count($data)) {
                        $result = array_merge($result, $data);
                    }
                }
            }
        }

        return $result;


    }

    public static function getUser($user)
    {
        return Name::find()->where(['user' => $user])->one();
    }

    public static function requestTwitts($user): array
    {
        $settings = \Yii::$app->params['twitterSettings'];

        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

        $getfield = '?screen_name=' . $user . '&count=2';
        $requestMethod = 'GET';

        $twitter = new TwitterAPIExchange($settings);

        return json_decode($twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest(), true);

    }

    public static function responseHandle($response):array
    {
        $data = [];

        $i =0;
        foreach($response as $twitt){
            $data[$i]['user']=$twitt['user']['screen_name'];
            $data[$i]['twitt']=$twitt['text'];
            $data[$i]['hashtag']=$twitt['entities']['hashtags'];

            $i++;
        }

        return $data;
    }

}

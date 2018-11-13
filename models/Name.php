<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 12.11.2018
 * Time: 20:08
 */

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Name extends ActiveRecord
{
    public function attributeLabels()
    {
        return [
            'user' => 'UserName'
        ];
    }

    public function addUser($user)
    {

        $this->user = $user;

        $this->save();
    }

    public function removeUser()
    {
        $this->delete();
    }



    public function rules()
    {
        return [
            ['user', 'required'],
            ['user', 'unique', 'on' => 'create'],
            ['user', 'trim'],
            ['user', 'alphaNumeric'],
            ['user', 'string', 'length' => [2, 15]],
        ];
    }

    public function alphaNumeric($attribute)
    {
        $re = '#[^\w0-9_]+#mi';
        if (preg_match($re, $this->$attribute)) {
            $this->addError($attribute, 'Wrong symbols.');
        }

    }
}
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Twitter';
?>
<?php if(Yii::$app->session->hasFlash('success')): ?>
<?= Yii::$app->session->hasFlash('success'); ?>
<?php endif; ?>



<div class="site-index">

    <a href="<?= Url::toRoute(['twitter/feed', 'id' => '60b51459eaf9ff08e2e0c7a8ce2913aa', 'secret'=>'5da3df9d8232d6725d03e8257c7d243f028821b5']); ?>" class="btn btn-primary btn-block">
        Test - get feeds
    </a>

    <?= var_dump($this->params['result']); ?>

    <div class="body-content">
        <a href="<?= Url::toRoute(['twitter/add', 'id' => '6888f8a99fe373a9a0d8baca45dd6609', 'user'=> 'EvgenComedian', 'secret'=>'573fc8e295c229d11e144735a197d342f218778a']); ?>" class="btn btn-success">
            Test - add user
        </a>

        <a href="<?= Url::toRoute(['twitter/remove', 'id' => '6888f8a99fe373a9a0d8baca45dd6609', 'user'=> 'EvgenComedian', 'secret'=>'573fc8e295c229d11e144735a197d342f218778a']); ?>" class="btn btn-danger">
            Test - remove user
        </a>

    </div>
</div>

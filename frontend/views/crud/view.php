<?php

use yii\helpers\{
    Html, Url
};

?>
<p><?= Html::a('< back to posts', Url::toRoute('post/index')); ?></p>
<h2><?= Html::encode($model->title); ?></h2>
<p><?= Html::encode($model->content); ?></p>

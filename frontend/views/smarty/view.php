<?php

use yii\helpers\Html;

/* @var $article \shop\entities\Article */
$this->title = $article->name;
?>
<h2><?= Html::encode($article->name) ?></h2>
<p><?= \Yii::$app->formatter->asNtext($article->description); ?></p>

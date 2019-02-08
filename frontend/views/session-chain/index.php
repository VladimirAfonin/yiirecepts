<?php

use yii\helpers\Html;

/* @var int $total */
/* @var \yii\web\View $this */
/* @var $articles frontend\models\AccountArticle[] */
?>
    <h2>Total: <?= $total ?></h2>
    <h2>5 latest articles: </h2>
<?php foreach ($articles as $article): ?>
    <h3><?= Html::encode($article->title) ?></h3>
    <div><?= Html::encode($article->text) ?></div>
<?php endforeach; ?>
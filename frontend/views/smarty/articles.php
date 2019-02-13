<?php

use yii\helpers\Html;

/* @var $articles \shop\entities\Article[] */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php foreach ($articles as $article): ?>
    <h3><?= Html::a(Html::encode($article->name), ['view', 'id' => $article->id]) ?></h3>
    <!--<div>Created --><?php //echo \Yii::$app->formatter->asDatetime($article->created_at); ?><!--</div>-->
    <!--<div>Updated --><?php //echo \Yii::$app->formatter->asDatetime($article->updated_at); ?><!--</div>-->
<?php endforeach; ?>

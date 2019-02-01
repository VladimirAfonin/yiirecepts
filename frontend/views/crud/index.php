<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>

<h1>Posts</h1>
<?= Html::a('+ Create post', Url::toRoute('post/create')) ?>

<?php foreach ($models as $model): ?>
    <h3><?= Html::encode($model->title); ?></h3>
    <p><?= Html::encode($model->content); ?></p>
    <p>
        <?= Html::a('view', Url::toRoute(['post/view', 'id' => $model->id])); ?> |
        <?= Html::a('delete', Url::toRoute(['post/delete', 'id' => $model->id])); ?> |
        <?= Html::a('delete with confirm', Url::toRoute(['post/delete', 'id' => $model->id]), [
                'class' => 'btn btn-outline-danger btn-sm',
                'data' => [
                    'confirm' => 'Are your sure?',
                    'method' => 'post'
                ],
        ]); ?>
    </p>
<?php endforeach; ?>

<?= LinkPager::widget([
    'pagination' => $pages
]) ?>

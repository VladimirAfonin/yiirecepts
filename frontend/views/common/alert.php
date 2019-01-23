<?php

use yii\bootstrap\Alert;

?>

<?php if (Yii::$app->session->hasFlash('success')) : ?>
    <?= Alert::widget([
        'options' => ['class' => 'alert-success'],
        'body' => Yii::$app->session->getFlash('success'),
    ]); ?>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('error')) : ?>
    <?= Alert::widget([
        'options' => ['class' => 'alert-danger'],
        'body' => Yii::$app->session->getFlash('error'),
    ]); ?>
<?php endif; ?>

<?php $flashes = Yii::$app->session->getAllFlashes(); ?>
<?php foreach ($flashes as $key => $flash): ?>
    <?= Alert::widget([
        'options' => ['class' => 'alert-info'],
        'body' => $flash
    ]) ?>
<?php endforeach; ?>

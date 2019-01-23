<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<h1><?= Yii::t('app', 'Create post') ?></h1>
<?php $form = ActiveForm::begin(); ?>

<?php $form->errorSummary($model); ?>
<?= $form->field($model, 'title')->textInput() ?>
<?= $form->field($model, 'content')->textArea() ?>
<?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-primary']); ?>

<?php ActiveForm::end(); ?>

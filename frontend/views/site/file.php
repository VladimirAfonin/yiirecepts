<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\captcha\Captcha;

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<? //= $form->field($model, 'file')->fileInput() ?>
<?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
<?php if (Captcha::checkRequirements() && !Yii::$app->user->isGuest): ?>
<div class="control-group">
    <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
        'captchaAction' => 'site/captcha',
    ]) ?>
    <?php endif; ?>
    <?= Html::submitButton('upload', ['class' => 'btn-success']) ?>
    <?php ActiveForm::end(); ?>

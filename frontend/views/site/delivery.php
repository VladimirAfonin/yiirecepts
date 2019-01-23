<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/** @var \frontend\forms\DeliveryForm $model */
?>

<h2>Delivery form</h2>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'type')->dropDownList($model->typeList(), ['prompt' => '-- select delivery type']) ?>
<?= $form->field($model, 'address') ?>
<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>

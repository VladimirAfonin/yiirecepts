<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\models\Tag;

/* @var $this yii\web\View */
/* @var $model frontend\models\PProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pproduct-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->dropDownList(\frontend\models\PCategory::find()->select(['name', 'id'])->indexBy('id')->column(), ['prompt' => '--']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <?= $form->field($model, 'tagsArray')->checkboxList(Tag::find()->select(['name', 'id'])->indexBy('id')->column()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

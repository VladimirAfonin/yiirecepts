<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AttributeValue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attribute-value-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->dropDownList(\frontend\models\PProduct::find()->select(['name', 'id'])->indexBy('id')->column(), ['prompt' => '--']); ?>

    <?= $form->field($model, 'attribute_id')->dropDownList(\frontend\models\Attribute::find()->select(['name', 'id'])->indexBy('id')->column(), ['prompt' => '--']); ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

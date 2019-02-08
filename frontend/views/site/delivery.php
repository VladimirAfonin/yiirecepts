<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

/** @var \frontend\forms\DeliveryForm $model */
?>

<h2>Delivery form</h2>

<button class="btn btn-sm btn-success" id="start-pjax-from">reload container manually with with Pjax</button>
<br>
<?php Pjax::begin(['id' => 'my-delivery-form']); ?>

    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
    <?= $form->field($model, 'type')->dropDownList($model->typeList(), ['prompt' => '-- select delivery type']) ?>
    <?= $form->field($model, 'address') ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>

<?php $this->registerJs("
    $('#my-delivery-form').on('pjax:complete', function() {
        alert('pjax is completed');
    });
    
    $('#start-pjax-from').on('click', function() {
        $.pjax.reload({ container: '#my-delivery-form' });
    });
"); ?>

<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var \common\models\AgreementForm $model */

$this->title = 'User agreement';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h2><?= Html::encode($this->title) ?></h2>
    <p>Please agree with our rules:</p>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'accept')->checkbox() ?>
    <div class="form-group">
        <?= Html::submitButton('Accept', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['/site/index'], ['class' => 'btn btn-danger']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>

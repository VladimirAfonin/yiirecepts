<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\PProduct */

$this->title = 'Create Pproduct';
$this->params['breadcrumbs'][] = ['label' => 'Pproducts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pproduct-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

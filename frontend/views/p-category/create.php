<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\PCategory */

$this->title = 'Create Pcategory';
$this->params['breadcrumbs'][] = ['label' => 'Pcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcategory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

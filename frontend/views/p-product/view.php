<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\PProduct */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pproducts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pproduct-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category_id',
            'name',
            'content:ntext',
            'price',
//            'active:boolean',
            [
                'attribute' => 'active',
                'filter' => [0 => 'Нет', 1 => 'Даee'],
                'format' => 'boolean',
            ],
        ],
    ]) ?>

    <?=
    \yii\grid\GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $model->getAttributeValues()->with('attribute0')]),
        'columns' => [
            'product_id',
            [
                'attribute' => 'attribute_id',
                'value' => 'attribute0.name',
            ],
            'value',
            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'attribute-value',
            ]
        ],
    ]);

    ?>

</div>

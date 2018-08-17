<?php
/** @var \yii\web\View $this */

/** @var \yii\data\ArrayDataProvider $dataProvider */

use yii\helpers\Html;
//use yii\grid\{SerialColumn, ActionColumn};
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\grid\ActionColumn;

$this->title = 'Cart';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::a('add item', ['add'], ['class' => 'btn btn-success']) ?></p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => SerialColumn::class],
            'id:text:Product ID',
            'amount:text:Amount',
            [
                'class' => ActionColumn::class,
                'template' => '{delete}'
            ]
        ]
    ]) ?>
</div>
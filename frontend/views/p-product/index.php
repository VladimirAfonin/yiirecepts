<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\PProduct;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\PProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pproducts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pproduct-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pproduct', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'category_id',
            [
                'attribute' => 'category_id',
                'filter' => \frontend\models\PCategory::find()->with('category')->select(['name', 'id'])->indexBy('id')->column(),
                'value' => function (PProduct $product) {
                    return $product->category->name;
                },
            ],
            'name',
            'content:ntext',
            'price',
            //'active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

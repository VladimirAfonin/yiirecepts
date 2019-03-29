<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\PCategory;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\PCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pcategories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcategory-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pcategory', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            [
                'attribute' => 'parent_id',
                'filter' => \frontend\models\PCategory::find()->select(['name', 'id'])->indexBy('id')->column(),
                'value' => 'parent.name', // function(PCategory $category) {
//                    return $category->parent ? $category->parent->name : '-';
//                    return \yii\helpers\ArrayHelper::getValue($category, 'parent.name');
//                },
            ],
//            'parent_id',
            [
                'label' => 'Products count',
                'attribute' => 'products_count',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

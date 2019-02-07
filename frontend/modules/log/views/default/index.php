<?php
use frontend\modules\log\helpers\LogHelper;
use frontend\modules\log\models\LogRow;
use yii\helpers\Html;

/* @var $dataProvider \yii\data\ArrayDataProvider */

$this->title = 'Application log';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'time',
                'format' => 'datetime',
                'contentOptions' => [
                    'style' => 'white-space: nowrap',
                ],
            ],
            'ip:text:IP',
            'userId:text:User',
            [
                'attribute' => 'level',
                'value' => function(LogRow $row){
                    return LogHelper::levelLabel($row->level);
                },
                'format' => 'raw',
            ],
            'category',
            'text',
        ],
    ]) ?>
</div>

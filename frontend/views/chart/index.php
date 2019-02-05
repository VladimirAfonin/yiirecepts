<?php

use yii\helpers\Html;
use common\widgets\ChartWidget;

$this->title = 'Chart';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">
    <h2><?= Html::encode($this->title) ?></h2>
</div>

<?= ChartWidget::widget([
    'title' => 'My Chart Diagram',
    'data' => [
        100 - 32,
        32
    ],
    'labels' => [
        'Big',
        'Small'
    ],
]) ?>

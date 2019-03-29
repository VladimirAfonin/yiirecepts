<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Products', 'url' => Url::to('/products/index')],
        ['label' => 'PCategories', 'url' => Url::to('/p-category/index')],
        ['label' => 'Attributes', 'url' => Url::to('/attribute/index')],
        ['label' => 'AttributeValues', 'url' => Url::to('/attributes/index')],
        ['label' => 'Session chain', 'url' => ['/session-chain/index']],
        ['label' => 'Smarty', 'url' => ['/smarty/index']],
        ['label' => Yii::t('app/nav', 'Logs'), 'url' => ['/log/default/index']],
        ['label' => Yii::t('app/nav', 'Agreement filter'), 'url' => ['/content/index']],
        ['label' => Yii::t('app/nav', 'Chart'), 'url' => ['/chart/index']],
        ['label' => Yii::t('app/nav', 'Cleaner'), 'url' => ['/clean/index']],
        ['label' => Yii::t('app/nav', 'Redis'), 'url' => ['/redis/index']],
        ['label' => 'Mongodb', 'url' => ['/customer/index']],
        ['label' => 'Cart', 'url' => Url::to('/cart')],
        ['label' => 'Drop down(ajax)', 'url' => Url::to('/dropdown/index')],
        ['label' => 'Crypto', 'url' => Url::to('/crypto/test')],
        ['label' => 'File', 'url' => ['/file']],
        ['label' => 'Range widget', 'url' => ['range']],
        ['label' => 'Delivery', 'url' => ['delivery']],
        ['label' => 'Users', 'url' => ['/users']],
//        ['label' => 'Home', 'url' => ['/site/index']],
//        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->email . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <br><br><br><br>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

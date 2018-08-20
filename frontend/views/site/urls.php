<?php

use yii\helpers\{
    Html, Url
};

?>

<h1>Generating url's</h1>
<?= Html::a('link name', ['blog/article', 'id' => 'user Id']) ?>

<h2>Current url</h2>
<?= Url::to('') ?>

<h2>Current controller but with specify action</h2>
<?= Html::a('cur controller', Url::toRoute(['view', 'id' => 'contact'])) ?>

<h2>Current controller and action</h2>
<?= Url::toRoute('blog/article') ?>

<h2>Current controller absolute</h2>
<?= Url::toRoute('/blog/list') ?>

<h2>Canonical URL for current page</h2>
<?= Url::canonical() ?>

<h2>Getting a home URL</h2>
<?= Url::home() ?>

<h2>Saving a URL of the current page and getting it for re-use</h2>
<?php Url::remember() ?>
<?= Url::previous() ?>

<h2>
    Creating URL to <i>blog</i> controller and <i>rss-feed</i> action while URL
    helper isn't available
</h2>
<?= Yii::$app->urlManager->createUrl(['blog/rss-feed', 'param' => 'someParam']) ?>

<h2>Creating an absolute URL to <i>blog</i> controller and <i>rss-feed</i></h2>
<p>It's very useful for emails and console applications</p>
<?= Yii::$app->urlManager->createAbsoluteUrl(['blog/rss-feed', 'param' => 'someParam']) ?>

<?php

namespace common\bootstrap;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use shop\ShoppingCart;
use shop\storage\StorageInterface;
use yii\base\Application;
use yii\base\BootstrapInterface;
use shop\storage\SessionStorage;
use Yii;

class SetUp implements BootstrapInterface
{
    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app): void
    {
        $container = Yii::$container;

        // ShoppingCart
        $container->setSingleton('\shop\ShoppingCart');

        // SessionStorage
        $container->set('\shop\storage\StorageInterface', function () {
            return new SessionStorage(Yii::$app->session, 'primary-cart');
        });

        // ElasticSearch
        $container->setSingleton(Client::class, function () use ($app) {
            return ClientBuilder::create()->build();
        });

        // Language
        if(!$app->user->isGuest) {
            $app->language = $app->user->identity->lang;
        }

    }
}
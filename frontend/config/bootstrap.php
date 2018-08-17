<?php

use shop\storage\SessionStorage;

Yii::$container->setSingleton('shop\ShoppingCart');

Yii::$container->set('shop\storage\StorageInterface', function () {
    return new SessionStorage(Yii::$app->session, 'primary-cart');
});

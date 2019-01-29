<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

return [
    'name' => $faker->firstName,
    'phone' => $faker->phoneNumber,
    'city' => $faker->city,
    'about' => $faker->sentence(7, true),
    'password' => Yii::$app->getSecurity()->generatePasswordHash('password_'.$index),
    'status' => $faker->userStatus,
];
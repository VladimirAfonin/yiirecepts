<?php
/**
 * Configuration file for the "yii asset" console command.
 */

// In the console environment, some path aliases may not exist. Please define these:
// Yii::setAlias('@webroot', __DIR__ . '/../web');
Yii::setAlias('@webroot', __DIR__);
Yii::setAlias('@web', '/');

return [
    // Adjust command/callback for JavaScript files compressing:
    'jsCompressor' => 'java -jar tool/compiler.jar --js {from} --js_output_file {to}',
    // Adjust command/callback for CSS files compressing:
    'cssCompressor' => 'java -jar tool/yuicompressor.jar --type css {from} -o {to}',
    // Whether to delete asset source after compression:
    'deleteSource' => false,
    // The list of asset bundles to compress:
    'bundles' => [
        'frontend\assets\AppAsset',
        // 'app\assets\AppAsset',
//         'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
//         'yii\web\JqueryAsset',
    ],
    // Asset bundle for compression output:
    'targets' => [
        /*'frontend\assets\AppAsset' => [
            'basePath' => '@webroot',
            'baseUrl' => '/',
            'js' => 'compiled-assets/all-{hash}.js',
            'css' => 'compiled-assets/all-{hash}.css',
        ],*/
        'all' => [
            'class' => 'yii\web\AssetBundle',
            'basePath' => '@webroot/assets',
            'baseUrl' => '@web/assets',
            'js' => 'js/all-{hash}.js',
            'css' => 'css/all-{hash}.css',
        ],
        /* 'appAsset' => [
             'class' => 'yii\web\AssetBundle',
             'basePath' => '@webroot',
             'baseUrl' => '/',
             'js' => 'compress/my-compressed.js',
             'css' => 'compress/my-compressed.css',
             'depends' => [
                 'frontend\assets\AppAsset',
                 'yii\web\YiiAsset',
                 'yii\bootstrap\BootstrapAsset',
             ],
         ],*/
    ],
    // Asset manager configuration:
    'assetManager' => [
        'basePath' => '@webroot/assets',
        'baseUrl' => '@web/assets',
        /*'bundles' => [
            'yii\web\JqueryAsset' => [],
            'sourcePath' => null,
            'basePath' => null,
            'js' => [''],
        ],*/
        //'basePath' => '@webroot/assets',
        //'baseUrl' => '@web/assets',
    ],
];
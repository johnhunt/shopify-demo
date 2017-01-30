<?php
require_once('vendor/autoload.php');

// Add dependencies to app
$app = new Slim\App([
    'guzzle' => new GuzzleHttp\Client(),
    'config' => new Configula\Config('config/config.php')
]);

// Add route callbacks
$app->get('/shop-demo', 'Controllers\PagesController:index');

// Run application
$app->run();
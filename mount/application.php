<?php
require_once('vendor/autoload.php');

$app = new Slim\App();

// Gather dependencies.. on a bigger app I'd probably use a dependency container
/*
$guzzleClient = new GuzzleHttp\Client();
$config = new \Configula\Config();
$smarty = new Smarty();

 */
// Add route callbacks
$app->get('/shop-demo', 'Controllers\PagesController:index');

// Run application
$app->run();
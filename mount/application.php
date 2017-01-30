<?php
require_once('vendor/autoload.php');

// Set up smarty. Note: Modern smarty is actually very good..
$smarty = new Smarty();
$smarty->addTemplateDir(__DIR__ . '/templates');
$smarty->setCompileDir(__DIR__ . '/templates-compiled');

// Add dependencies to app
$app = new Slim\App([
    'guzzle' => new GuzzleHttp\Client(),
    'config' => new Configula\Config(__DIR__ . '/config/'),
    'smarty' => $smarty
]);

// Add route callbacks
$app->get('/shop-demo', 'Controllers\PagesController:index');

// Run application
$app->run();
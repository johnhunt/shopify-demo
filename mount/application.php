<?php
require_once('vendor/autoload.php');

// Set up smarty. Note: Modern smarty is actually very good..
$smarty = new Smarty();
$smarty->addTemplateDir(__DIR__ . '/templates');
$smarty->setCompileDir(__DIR__ . '/templates-compiled');

// Get the app configuartion
$configObj = new Configula\Config(__DIR__ . '/config/');

// Create a guzzle HTTP object
$guzzleClient = new GuzzleHttp\Client([
    'base_uri' => $configObj->getItem('shopifyUrl'),
    'auth' => [
        $configObj->getItem('apiKey'),
        $configObj->getItem('apiPassword')
    ]
]);

$productsEndpoint = '/admin/products.json';
$imageEndpoint = '/admin/products/';

// Add route callbacks
$app->get('/shop-demo', 'Controllers\PagesController:index');

// Run application
$app->run();
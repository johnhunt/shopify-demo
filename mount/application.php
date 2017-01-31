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

// Session used for flash messages
session_start();

// Add dependencies to app to make them available from our controllers
$container = new \Slim\Container(['settings' =>
    [
        'displayErrorDetails' => true
    ],
    'guzzle' => $guzzleClient,
    'config' => $configObj,
    'smarty' => $smarty,
    'validator' => new Valitron\Validator([]),
    'flash' => new \Slim\Flash\Messages(),
    'productsRepo' => new \Repository\ShopifyProductsRepository($guzzleClient, $productsEndpoint, $imageEndpoint)
    ]
);

$app = new Slim\App($container);

// Add route callbacks
$app->get('/shop-demo', 'Controllers\PagesController:index');

$app->post('/products', 'Controllers\ProductController:addProduct');

$app->post('/imageUpload', 'Controllers\ProductController:storeProductImage');

// Run application
$app->run();
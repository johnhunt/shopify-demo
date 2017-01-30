<?php
namespace Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Container;

class PagesController
{
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function index(Request $request, Response $response, $params)
    {
        die($this->container['test']);
    }
}
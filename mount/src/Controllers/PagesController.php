<?php
namespace Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Container;

class PagesController
{
    /** @var \Smarty $smarty */
    private $smarty;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->smarty = $container['smarty'];
    }

    public function index(Request $request, Response $response, $params)
    {
        return $response->withStatus(200)->write($this->smarty->fetch('index.tpl'));
    }
}
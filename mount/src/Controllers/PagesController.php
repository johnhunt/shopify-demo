<?php
namespace Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Container;

class PagesController
{
    /** @var \Smarty $smarty */
    private $smarty;

    /** @var \Slim\Flash\Messages $flash */
    private $flash;

    public function __construct(Container $container)
    {
        $this->smarty = $container['smarty'];
        $this->flash = $container['flash'];
    }

    public function index(Request $request, Response $response, $params)
    {
        $this->smarty->clearAllAssign();

        $messages = $this->flash->getMessages();

        if (!empty($messages)) {
            $this->smarty->assign([
                'messages' => $messages
            ]);
        }

        return $response->withStatus(200)->write($this->smarty->fetch('index.tpl'));
    }
}
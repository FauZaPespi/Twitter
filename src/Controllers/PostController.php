<?php

namespace Fauza\Template\Controllers;

use Fauza\Template\Database;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class PostController
{
    public function view(Request $req, Response $resp, array $args): Response
    {
        $resp->getBody()->write(json_encode($args));
        return $resp->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
        //return $resp->withHeader('Location', '/profile')->withStatus(302);
    }
}

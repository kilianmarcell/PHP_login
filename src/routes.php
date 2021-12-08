<?php

use Kilianmarcell\Login\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function(App $app) {
    $app->get('/', function (Request $request, Response $response, $args) {
        $response->getBody()->write("Hello world!");
        return $response;
    });
    $app->post('/register', function(Request $request, Response $response, $args) {
        $userData = json_decode($request->getBody(), true);
        $user = new User();
        $user->email = $userData['email'];
        $user->password = password_hash($userData['password'], PASSWORD_DEFAULT);
        $user->save();
        $response->getBody()->write($user->toJson());
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    });
};
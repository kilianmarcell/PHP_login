<?php

namespace Kilianmarcell\Login\Middlewares;

use Exception;
use Kilianmarcell\Login\Token;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;

class AuthMiddleware {
    public function __invoke(Request $request, RequestHandler $handler) : Response
    {
        $auth = $request->getHeader('Authorization');
        if (count($auth) !== 1) {
            throw new Exception('Hibás Authorization header');
        }
        $authArr = mb_split(' ', $auth[0]);
        if ($authArr[0] !== 'Bearer') {
            throw new Exception('Nem támogatott autentikációs módszer!');
        }
        $tokenStr = $authArr[1];
        $token = Token::where('token', $tokenStr)->firstOrFail();

        // User kikeresés & eltárolása

        return $handler->handle($request);
    }
}
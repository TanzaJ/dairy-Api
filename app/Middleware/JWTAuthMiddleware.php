<?php

namespace Vanier\Api\Middleware;

use LogicException;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface;
use Slim\Exception\HttpForbiddenException;
use Slim\Exception\HttpUnauthorizedException;
use UnexpectedValueException;

use Vanier\Api\Exceptions\HttpNotAcceptableException;
use Vanier\Api\Helpers\JWTManager;
use Vanier\Api\Models\AccountsModel;


class JWTAuthMiddleware implements MiddlewareInterface
{
    private $accounts_model = null;
    public function __construct(array $options = [])
    {
        $this->accounts_model = new AccountsModel();
    }
    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        $uri = $request->getUri();
        if (str_contains($uri, "/account") || str_contains($uri, "/token")){
            return $handler->handle($request);
        }
        else{
            $authHeader = $request->getHeader('Authorization');
            if ($authHeader){
                $token = str_replace('Bearer ', '', $request->getHeader('Authorization')[0]);
                $decoded = JWTManager::decodeJWT($token, 'HS256');
                $email = $decoded['email'];
                $password = $decoded['password'];
                $account = $this->accounts_model->isPasswordValid($email, $password);
                if ($account !== null){
                    if($request->getMethod() === "POST" || $request->getMethod() === "PUT" || $request->getMethod() === "DELETE"){
                        if($account['role'] !== "admin"){
                            throw new HttpForbiddenException($request, "Insufficient permission!");
                        }
                    }
                    $request = $request->withAttribute('Token Payload', $decoded);
                }
                else{
                    throw new HttpForbiddenException($request, "Account does not exist or is not valid");
                }
            }
            else{
                throw new HttpNotAcceptableException($request, "Unauthorized access");
            }
        }
        return $handler->handle($request);
    }
}

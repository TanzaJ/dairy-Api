<?php

namespace Vanier\Api\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Vanier\Api\Exceptions\HttpNotAcceptableException;


class ContentNegotiationMiddleware implements MiddlewareInterface
{
    /**
     * This function ensures that the request headers being sent to the WS are of application/json media type 
     *
     * @param Request $request
     * @param RequestHandler $handler
     * @return ResponseInterface
     */
    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        $headerValueString = $request->getHeaderLine('Accept');
        if ($headerValueString != "application/json"){
            throw new HttpNotAcceptableException($request, "request header is not valid");
            
        }
        $response = $handler->handle($request);
        return $response;
    }
    
}

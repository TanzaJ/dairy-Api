<?php

namespace Vanier\Api\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Vanier\Api\Exceptions\HttpNotAcceptableException;
use DateTimeZone;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class AppLoggingMiddleware implements MiddlewareInterface
{
    private $logger;
    private $log_handler;

    public function __construct(array $options = [])
    {
        
        // $this->logger->pushHandler(new StreamHandler('dairy.log', Logger::DEBUG));
    }
    
    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        $this->logger = new Logger('access_logs');
        $this->logger->setTimezone(new DateTimeZone('America/Toronto'));
        $this->log_handler = new StreamHandler('access.log', Logger::DEBUG);
        $this->logger->pushHandler($this->log_handler);
        $this->logger->info('UwU');
        return $handler->handle($request);
    }
}

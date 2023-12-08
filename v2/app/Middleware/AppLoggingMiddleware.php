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
use Vanier\Api\Models\AccountsModel;
use Vanier\Api\Models\AccessLogModel;


class AppLoggingMiddleware implements MiddlewareInterface
{
    private $logger;
    private $log_handler;

    private $account_model = null;

    private $access_log_model =null;
    private $log;


    public function __construct(array $options = [])
    {
        $this->account_model = new AccountsModel();

        $this->access_log_model = new AccessLogModel();
    }
    
    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $uri = $request->getUri();
        
        // Extract the controller name from the URI path
        $path = $uri->getPath();
        // echo $path; exit;
        $controllerName = $this->extractResourceName($path);
        $controllerName = ucfirst($controllerName);

        $method = $request->getMethod();
        $actionName = $this->mapMethodToAction($method);

        $user = "Unknown User";
        $uid = "youre a lil sussy wussy baka if youre reading this uwu";
        

        if(isset($_COOKIE['user'])){
            $user = "\"" . $_COOKIE['user'] . "\"";
            $uid = $this->account_model->fetchUID($_COOKIE['user']);
        }

        $filters = $request->getQueryParams();
        $this->logger = new Logger('access_logs');
        $this->logger->setTimezone(new DateTimeZone('America/Toronto'));
        $this->log_handler = new StreamHandler('access.log', Logger::DEBUG);
        $this->logger->pushHandler($this->log_handler);
        $this->logger->alert($user . ' Logged in w/ IP of ' . $ip);
        
        $this->logger->info($user . " Invoked $actionName on $controllerName returned with Status Code: " . http_response_code(), $filters);

        $user_data = array(
            'id' => $uid["user_id"],
            'email' => $user
        );
        
        $this->access_log_model->createLogEntry(
            $user_data,
            "$actionName on $controllerName"
        );
        return $handler->handle($request);
    }

    private function mapMethodToAction(string $method): string
    {
        $methodActions = [
            'GET' => 'Retrieve',
            'POST' => 'Create',
            'PUT' => 'Update',
            'DELETE' => 'Delete',
        ];
        return $methodActions[strtoupper($method)] ?? $method;
    }
    
    private function extractResourceName(string $path): string
    {
        $basePath = '/dairy-api/v2/';
        $pathWithoutBase = str_replace($basePath, '', $path);
        $segments = explode('/', trim($pathWithoutBase, '/'));
        return $segments[0] ?? 'UnknownResource';
    }
}

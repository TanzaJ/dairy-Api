<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\AboutController;
use Vanier\Api\Controllers\FilmsController;
use Vanier\Api\Controllers\MilkController;
use Vanier\Api\Models\MilkModel;

// Import the app instance into this file's scope.
global $app;

// NOTE: Add your app routes here.
// The callbacks must be implemented in a controller class.
// The Vanier\Api must be used as namespace prefix. 

// ROUTE: GET /
$app->get('/', [AboutController::class, 'handleAboutApi']); 

// ROUTE: GET /milk
$app->get('/milk', function [MilkController::class, 'handleGetMilk'] {

    $response->getBody()->write("Reporting! Hello there!");            
    return $response;
});

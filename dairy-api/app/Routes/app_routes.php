<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\AboutController;
use Vanier\Api\Controllers\FilmsController;
use Vanier\Api\Controllers\MilkController;
use Vanier\Api\Models\MilkModel;
use Vanier\Api\Controllers\IceCreamController;
use Vanier\Api\Models\IceCreamModel;
use Vanier\Api\Controllers\ButterController;
use Vanier\Api\Models\ButterModel;
use Vanier\Api\Controllers\ProjMilkController;
use Vanier\Api\Models\ProjMilkModel;
use Vanier\Api\Controllers\UnitTypeController;
use Vanier\Api\Models\UnitTypeModel;

// Import the app instance into this file's scope.
global $app;

// NOTE: Add your app routes here.
// The callbacks must be implemented in a controller class.
// The Vanier\Api must be used as namespace prefix. 

// ROUTE: GET /
$app->get('/', [AboutController::class, 'handleAboutApi']); 

// ROUTE: GET /milk
$app->get('/milk', [MilkController::class, 'handleGetMilk']);

//GET /cheese
$app->get('/milk/{milk_id}/cheese', [CheeseController::class, 'handleGetCheese']);

//GET /ice_cream
$app->get('/milk/{milk_id}/ice_cream', [IceCreamController::class, 'handleGetIceCream']);

//GET /butter
$app->get('/milk/{milk_id}/butter', [ButterController::class, 'handleGetButter']);

//GET /projectedMilkProduction
$app->get('/milk/{milk_id}/projectedMilkProduction', [ProjMilkController::class, 'handleGetProjMilk']);

//GET /unit_type
$app->get('/milk/{milk_id}/{pmp_id}/unit_type', [UnitTypeController::class, 'handleGetUnitType']);

//TODO: GET /country, brand and nutritional value
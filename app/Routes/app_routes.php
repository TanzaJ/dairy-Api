<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\AboutController;
use Vanier\Api\Controllers\MilkController;
use Vanier\Api\Models\MilkModel;
use Vanier\Api\Controllers\IceCreamController;
use Vanier\Api\Models\IceCreamModel;
use Vanier\Api\Controllers\ButterController;
use Vanier\Api\Models\ButterModel;
use Vanier\Api\Controllers\ProjMilkController;
use Vanier\Api\Models\ProjMilkModel;
use Vanier\Api\Controllers\BrandController;
use Vanier\Api\Models\BrandModel;
use Vanier\Api\Controllers\CountryController;
use Vanier\Api\Models\CountryModel;
use Vanier\Api\Controllers\NutritionalValueController;
use Vanier\Api\Models\NutritionalValueModel;


// Import the app instance into this file's scope.
global $app;

// NOTE: Add your app routes here.
// The callbacks must be implemented in a controller class.
// The Vanier\Api must be used as namespace prefix. 

// ROUTE: GET /
$app->get('/', [AboutController::class, 'handleAboutApi']); 

// ROUTE: GET /milk
$app->get('/milk', [MilkController::class, 'handleGetMilk']);

//POST /milk
$app->post('/milk', [MilkController::class, 'handleCreateMilk']);

//PUT /milk
$app->put('/milk', [MilkController::class, 'handleUpdateMilk']);

//DELETE /milk
$app->delete('/milk', [MilkController::class, 'deleteMilk']);

//GET /cheese
$app->get('/milk/{milk_id}/cheese', [CheeseController::class, 'handleGetCheese']);

//GET /ice_cream
$app->get('/milk/{milk_id}/ice_cream', [IceCreamController::class, 'handleGetIceCream']);

//POST /ice_cream
$app->post('/milk/{milk_id}/ice_cream', [IceCreamController::class, 'handleCreateIceCream']);

//PUT /ice_cream
$app->put('/milk/{milk_id}/ice_cream', [IceCreamController::class, 'handleUpdateIceCream']);

//DELETE /ice_cream
$app->delete('/milk/{milk_id}/ice_cream', [IceCreamController::class, 'deleteIceCream']);

//GET /butter
$app->get('/milk/{milk_id}/butter', [ButterController::class, 'handleGetButter']);

//POST /butter
$app->post('/milk/{milk_id}/butter', [ButterController::class, 'handleGetButter']);

//PUT /butter
$app->put('/milk/{milk_id}/butter', [ButterController::class, 'handleUpdateButter']);

//DELETE /butter
$app->delete('/milk/{milk_id}/butter', [ButterController::class, 'deleteButter']);

//GET /projectedMilkProduction
$app->get('/milk/{milk_id}/projectedMilkProduction', [ProjMilkController::class, 'handleGetProjMilk']);

//GET /brand
$app->get('/brand', [BrandController::class, 'handleGetBrand']);

//GET /country
$app->get('/country', [CountryController::class, 'handleGetCountry']);

//GET /nutritional_value
$app->get('/nutritional_value', [NutritionalValueController::class, 'handleGetNV']);
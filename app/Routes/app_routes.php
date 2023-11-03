<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\AboutController;
use Vanier\Api\Controllers\CheeseController;
use Vanier\Api\Controllers\MilkController;
use Vanier\Api\Controllers\UnitTypeController;
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

// GET /
$app->get('/', [AboutController::class, 'handleAboutApi']); 


// GET /milk
$app->get('/milk', [MilkController::class, 'handleGetMilk']);
//POST /milk
$app->post('/milk', [MilkController::class, 'handleCreateMilk']);
//PUT /milk
$app->put('/milk/{milk_id}', [MilkController::class, 'handleUpdateMilk']);
//DELETE /milk
$app->delete('/milk/{milk_id}', [MilkController::class, 'handleDeleteMilk']);


//GET /cheese
$app->get('/cheese', [CheeseController::class, 'handleGetCheese']);
//POST /cheese
$app->post('/cheese', [CheeseController::class, 'handleCreateCheese']);
//PUT /cheese
$app->put('/cheese/{cheese_id}', [CheeseController::class, 'handleUpdateCheese']);
//DELETE /cheese
$app->delete('/cheese/{cheese_id}', [CheeseController::class, 'handleDeleteCheese']);


//GET /ice_cream
$app->get('/ice_cream', [IceCreamController::class, 'handleGetIceCream']);
//POST /ice_cream
$app->post('/ice_cream', [IceCreamController::class, 'handleCreateIceCream']);
//PUT /ice_cream
$app->put('/ice_cream', [IceCreamController::class, 'handleUpdateIceCream']);
//DELETE /ice_cream
$app->delete('/ice_cream/{ice_cream_id}', [IceCreamController::class, 'handleDeleteIceCream']);


//GET /butter
$app->get('/butter', [ButterController::class, 'handleGetButter']);
//POST /butter
$app->post('/butter', [ButterController::class, 'handleCreateButter']);
//PUT /butter
$app->put('/butter/{butter_id}', [ButterController::class, 'handleUpdateButter']);
//DELETE /butter
$app->delete('/butter/{butter_id}', [ButterController::class, 'handleDeleteButter']);


// GET /brand
$app->get('/brand', [BrandController::class, 'handleGetBrand']);
// POST /brand
$app->post('/brand', [BrandController::class, 'handleCreateBrand']);
// PUT /brand
$app->put('/milk/{brand_id}/brand', [BrandController::class, 'handleUpdateBrand']);
// DELETE /brand
$app->delete('/milk/{brand_id}/brand', [BrandController::class, 'handleDeleteBrand']);


// //GET /country
// $app->get('/country', [CountryController::class, 'handleGetCountry']);
// //POST /country
// $app->post('/country', [CountryController::class, 'handleCreateCountry']);
// //PUT /country
// $app->put('/milk/{country_id}/country', [CountryController::class, 'handleUpdateCountry']);
// //DELETE /country
// $app->delete('/milk/{country_id}/country', [CountryController::class, 'handleDeleteCountry']);


// //GET /projectedMilkProduction
// $app->get('/projected_milk_production', [ProjMilkController::class, 'handleGetProjMilk']);
// //POST /country
// $app->post('/projected_milk_production', [ProjMilkController::class, 'handleCreateProjMilk']);
// //PUT /country
// $app->put('/milk/{projMilk_id}/projected_milk_production', [ProjMilkController::class, 'handleUpdateProjMilk']);
// //DELETE /country
// $app->delete('/milk/{projMilk_id}/projected_milk_production', [ProjMilkController::class, 'handleDeleteProjMilk']);


// //GET /nutritional_value
// $app->get('/nutritional_value', [NutritionalValueController::class, 'handleGetNV']);
// //POST /country
// $app->post('/nutritional_value', [NutritionalValueController::class, 'handleCreateNV']);
// //PUT /country
// $app->put('/milk/{nv_id}/nutritional_value', [NutritionalValueController::class, 'handleUpdateNV']);
// //DELETE /country
// $app->delete('/milk/{nv_id}/nutritional_value', [NutritionalValueController::class, 'handleDeleteNV']);


// //GET /unit_type
// $app->get('/unit_type', [UnitTypeController::class, 'handleGetUnitType']);
// //POST /country
// $app->post('/unit_type', [UnitTypeController::class, 'handleCreateUnitType']);
// //PUT /country
// $app->put('/milk/{unitType_id}/unit_type', [UnitTypeController::class, 'handleUpdateUnitType']);
// //DELETE /country
// $app->delete('/milk/{unitType_id}/unit_type', [UnitTypeController::class, 'handleDeleteUnitType']);
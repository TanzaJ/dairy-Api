<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Controllers\AboutController;
use Vanier\Api\Controllers\AccountsController;
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
use Vanier\Api\Controllers\CompositeController;
use Vanier\Api\Controllers\HealthController;


// Import the app instance into this file's scope.
global $app;

// NOTE: Add your app routes here.
// The callbacks must be implemented in a controller class.
// The Vanier\Api must be used as namespace prefix. 

// GET /
$app->get('/', [AboutController::class, 'handleAboutApi']); 

// Get /health
$app->get('/health', [HealthController::class, 'handleGetHealth']); 


// POST /account
$app->post('/account', [AccountsController::class, 'handleCreateAccount']); 
// POST /token
$app->post('/token', [AccountsController::class, 'handleGenerateToken']); 

// GET /milk
$app->get('/milk', [MilkController::class, 'handleGetMilk']);
// GET /milk by id
$app->get('/milk/{milk_id}', [MilkController::class, 'handleGetMilkById']);
//POST /milk
$app->post('/milk', [MilkController::class, 'handleCreateMilk']);
//PUT /milk
$app->put('/milk', [MilkController::class, 'handleUpdateMilk']);
//DELETE /milk
$app->delete('/milk/{milk_id}', [MilkController::class, 'handleDeleteMilk']);


//GET /cheese
$app->get('/cheese', [CheeseController::class, 'handleGetCheese']);
//POST /cheese
$app->post('/cheese', [CheeseController::class, 'handleCreateCheese']);
//PUT /cheese
$app->put('/cheese', [CheeseController::class, 'handleUpdateCheese']);
//DELETE /cheese
$app->delete('/cheese', [CheeseController::class, 'handleDeleteCheese']);
// GET /cheese by id
$app->get('/cheese/{cheese_id}', [CheeseController::class, 'handleGetCheeseById']);

// GET /learn/cheese/random
$app->get('/learn/cheese/random', [CompositeController::class, 'handleGetRandomCheese']);

// GET /learn/cheese
$app->get('/learn/cheese', [CompositeController::class, 'handleGetAllCheese']);



//GET /ice_cream
$app->get('/ice_cream', [IceCreamController::class, 'handleGetIceCream']);
//POST /ice_cream
$app->post('/ice_cream', [IceCreamController::class, 'handleCreateIceCream']);
//PUT /ice_cream
$app->put('/ice_cream', [IceCreamController::class, 'handleUpdateIceCream']);
//DELETE /ice_cream
$app->delete('/ice_cream/{ice_cream_id}', [IceCreamController::class, 'handleDeleteIceCream']);
// GET /ice_cream by id
$app->get('/ice_cream/{ice_cream_id}', [IceCreamController::class, 'handleGetIceCreamById']);

//GET /butter
$app->get('/butter', [ButterController::class, 'handleGetButter']);
//POST /butter
$app->post('/butter', [ButterController::class, 'handleCreateButter']);
//PUT /butter
$app->put('/butter', [ButterController::class, 'handleUpdateButter']);
//DELETE /butter
$app->delete('/butter', [ButterController::class, 'handleDeleteButter']);
// GET /butter by id
$app->get('/butter/{butter_id}', [ButterController::class, 'handleGetButterById']);

// GET /brand
$app->get('/brand', [BrandController::class, 'handleGetBrand']);
// POST /brand
$app->post('/brand', [BrandController::class, 'handleCreateBrand']);
// PUT /brand
$app->put('/brand/{brand_id}', [BrandController::class, 'handleUpdateBrand']);
// DELETE /brand
$app->delete('/brand/{brand_id}', [BrandController::class, 'handleDeleteBrand']);
// GET /brand by id
$app->get('/brand/{brand_id}', [BrandController::class, 'handleGetBrandById']);

//GET /country
$app->get('/country', [CountryController::class, 'handleGetCountry']);
// GET /country by id
$app->get('/country/{country_id}', [CountryController::class, 'handleGetCountryById']);
// //POST /country
// $app->post('/country', [CountryController::class, 'handleCreateCountry']);
// //PUT /country
// $app->put('/milk/{country_id}/country', [CountryController::class, 'handleUpdateCountry']);
// //DELETE /country
// $app->delete('/milk/{country_id}/country', [CountryController::class, 'handleDeleteCountry']);


//GET /projectedMilkProduction
$app->get('/projected_milk_production', [ProjMilkController::class, 'handleGetProjMilk']);
// GET /projectedMilkProduction by id
$app->get('/projected_milk_production/{pmp_id}', [ProjMilkController::class, 'handleGetProjMilkById']);
// //POST /projectedMilkProduction
// $app->post('/projected_milk_production', [ProjMilkController::class, 'handleCreateProjMilk']);
// //PUT /projectedMilkProduction
// $app->put('/milk/{projMilk_id}/projected_milk_production', [ProjMilkController::class, 'handleUpdateProjMilk']);
// //DELETE /projectedMilkProduction
// $app->delete('/milk/{projMilk_id}/projected_milk_production', [ProjMilkController::class, 'handleDeleteProjMilk']);


//GET /nutritional_value
$app->get('/nutritional_value', [NutritionalValueController::class, 'handleGetNV']);
// GET /nutritional_value by id
$app->get('/nutritional_value/{nutritional_value_id}', [NutritionalValueController::class, 'handleGetNVById']);
//POST /nutritional_value
$app->post('/nutritional_value', [NutritionalValueController::class, 'handleCreateNV']);
// //PUT /nutritional_value
// $app->put('/milk/{nv_id}/nutritional_value', [NutritionalValueController::class, 'handleUpdateNV']);
// //DELETE /nutritional_value
// $app->delete('/milk/{nv_id}/nutritional_value', [NutritionalValueController::class, 'handleDeleteNV']);


//GET /unit_type
$app->get('/unit_type', [UnitTypeController::class, 'handleGetUnitType']);
// GET /unit_type by id
$app->get('/unit_type/{unit_id}', [UnitTypeController::class, 'handleGetUnitTypeById']);
// //POST /unit_type
// $app->post('/unit_type', [UnitTypeController::class, 'handleCreateUnitType']);
// //PUT /unit_type
// $app->put('/milk/{unitType_id}/unit_type', [UnitTypeController::class, 'handleUpdateUnitType']);
// //DELETE /unit_type
// $app->delete('/milk/{unitType_id}/unit_type', [UnitTypeController::class, 'handleDeleteUnitType']);

//Our composite resource
$app->get('/recipes', [CompositeController::class, 'handleGetRecipes']);
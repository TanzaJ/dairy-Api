<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Exceptions\HttpMissingDataException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Helpers\Validator;
use Vanier\Api\Helpers\WebServiceInvoker;
use Slim\Exception\HttpBadRequestException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class CompositeController extends BaseController
{
    //private array $errors = array();
    //private $composite_model =null;
    //private $log;


    // public function __construct() {
    //     $this->composite_model = new CompositeModel();

    // }

    public function handleGetRecipes(Request $request, Response $response, array $uri_args)
    {
        //$filters = $request->getQueryParams();
        $recipes = $this->fetchRecipes();

        return $this->prepareOkResponse($response, (array) $recipes);
    }

    public function fetchRecipes(): mixed
    {
        $ws_invoker = new WebServiceInvoker([]);
        $uri = "https://api.spoonacular.com/recipes/complexSearch?apiKey=52f98e558d7a4e0182e8352289235bdf";
        $recipes = $ws_invoker->invokeUri($uri);
        //var_dump($recipes);exit;
        if ($recipes != null) {        

            $processed_recipes = array();
            foreach ($recipes->results as $key => $recipe) {
                $processed_recipes[$key]["id"] = $recipe->id;
                $processed_recipes[$key]["title"] = $recipe->title;
                $processed_recipes[$key]["image"] = $recipe->image;
            }            
        }
        return $processed_recipes;
    }
}

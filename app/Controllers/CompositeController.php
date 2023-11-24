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

/**
 * A controller class that handles requests concerning composite resources
 */
class CompositeController extends BaseController
{

    /**
     * Fetches a list of recipes from the spoonacular api
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleGetRecipes(Request $request, Response $response, array $uri_args)
    {
        $recipes = $this->fetchRecipes();

        return $this->prepareOkResponse($response, (array) $recipes);
    }

    /**
     * The logic for fetching from spoonacular
     */
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

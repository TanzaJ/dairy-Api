<?php

namespace Vanier\Api\Controllers;

use Exception;
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
use Vanier\Api\Models\RecipesModel;

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
        $filters = $request->getQueryParams();
        $recipeModel = new RecipesModel();
        $recipes = $recipeModel->fetchRecipes($filters);
        try {
            return $this->prepareOkResponse(
                $response,
                $recipes,
                HttpCodes::STATUS_ACCEPTED
            );
        } catch (Exception $e) {
            $response_data = array(
                "code" => HttpCodes::STATUS_BAD_GATEWAY,
                "message" => "The Composite Api could not be included",
            );
            return $this->prepareOkResponse(
                $response,
                $response_data,
                HttpCodes::STATUS_BAD_GATEWAY
            );
        }
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

    /**
     * Fetches a random cheese from the cheese api
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleGetRandomCheese(Request $request, Response $response, array $uri_args)
    {
        $cheese = $this->fetchRandomCheese();

        return $this->prepareOkResponse($response, $cheese);
    }

    /**
     * The logic for fetching from cheese
     */
    public function fetchRandomCheese(): mixed
    {
        $ws_invoker = new WebServiceInvoker([]);
        $uri = "https://cheese-api.onrender.com/random";
        $cheese = $ws_invoker->invokeUri($uri);
        if ($cheese != null) {        

            $processed_cheese["name"] = $cheese->name;
            $processed_cheese["desc"] = $cheese->raw_description;
            $processed_cheese["image"] = $cheese->image;
            $processed_cheese["milk"] = $cheese->milk;


                    
        }
        return $processed_cheese;
    }

    /**
     * Fetches a list of cheeses from the cheese api
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleGetAllCheese(Request $request, Response $response, array $uri_args)
    {
        $cheese = $this->fetchAllCheese();

        return $this->prepareOkResponse($response, (array) $cheese);
    }

    /**
     * The logic for fetching from cheese
     */
    public function fetchAllCheese(): mixed
    {
        $ws_invoker = new WebServiceInvoker([]);
        $uri = "https://cheese-api.onrender.com/cheeses";
        $cheeses = $ws_invoker->invokeUri($uri);
        if ($cheeses != null) {        
            $processed_cheeses = array();

            foreach ($cheeses as $key => $cheese) {

            $processed_cheeses[$key]["name"] = $cheese->name;
            $processed_cheeses[$key]["desc"] = $cheese->raw_description;
            $processed_cheeses[$key]["image"] = $cheese->image;
            $processed_cheeses[$key]["milk"] = $cheese->milk;
            }
        }
        return $processed_cheeses;
    }
    


}

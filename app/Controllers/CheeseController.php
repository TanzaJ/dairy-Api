<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Exception\HttpBadRequestException;
use Vanier\Api\Exceptions\HttpMissingDataException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Helpers\Validator;
use Vanier\Api\Models\CheeseModel;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class CheeseController extends BaseController
{
    private $cheese_model =null;

    public function __construct() {
        $this->cheese_model = new CheeseModel();
    }

    public function handleGetCheese(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $validation_response = $this->isValidPagingParams($filters);
        if ($validation_response === true){
            $this->cheese_model->setPaginationOptions(
                $filters['page'],
                $filters['page_size']
            );
        }
        else{
            throw new HttpBadRequestException($request, $validation_response);
        }

        $filters = $request->getQueryParams();
        $cheese_info = $this->cheese_model->getAll($filters);
        return $this->prepareOkResponse($response,(array) $cheese_info);
    }

    public function handleCreateCheese(Request $request, Response $response)
    {
        $cheeses = $request->getParsedBody();
        if(!isset($cheeses)) 
        {
            throw new HttpMissingDataException($request,
            "Couldn't create cheese/process the request due to missing data.");
        }
        foreach($cheeses as $key => $cheese) {
            $this->validateCheese($cheese);

            $this->cheese_model->addCheese($cheese);
        }
        $response_data = array(
            "code" => HttpCodes::STATUS_CREATED,
            "message"=>"The provided list of cheese entries have been successfully created!"
    );
        return $this->prepareOkResponse(
            $response,
            $response_data,
            HttpCodes::STATUS_CREATED
        );
    }

    public function handleUpdateCheese(Request $request, Response $response, array $uri_args)
    {
        $cheeses = $request->getParsedBody();
        if(!isset($cheeses)) 
        {
            throw new HttpMissingDataException($request,
            "Couldn't update cheese/process the request due to missing data.");
        }

        foreach($cheeses as $key => $cheese) {
            $id = $cheese['cheese_id'];
            unset($cheese['cheese_id']);

            $this->validateCheese($cheese);
            $this->cheese_model->updateModel($cheese, $id);
        }
        $response_data = array(
            "code" => HttpCodes::STATUS_ACCEPTED,
            "message"=>"The provided list of cheese entries has been successfully updated!"
    );
        return $this->prepareOkResponse(
            $response,
            $response_data,
            HttpCodes::STATUS_ACCEPTED
        );

    }

    public function handleDeleteCheese(Request $request, Response $response, array $uri_args)
    {
        $cheeses = $request->getParsedBody(); 
        foreach($cheeses as $key => $cheese) {
        $id = $cheese['cheese_id'];
        unset($cheese['cheese_id']);
       
        if($id < 0) {
            //TODO: throw exception
           // throw new HttpNoNegativeId($request, "Invalid id");
        }

        $this->cheese_model->deleteCheese($id);
    }

    $response_data = array(
        "code" => HttpCodes::STATUS_ACCEPTED,
        "message"=>"The provided list of cheese entries have been successfully deleted!"
    );
    return $this->prepareOkResponse(
        $response,
        $response_data,
        HttpCodes::STATUS_ACCEPTED
    );
    }
    public function validateCheese(array $cheese)
    {
        $rules = array(
            'milk_id' => array(
                'required', 'integer'
            ),
            'product_name' => array(
                'required'
            ),
            'country_id' => array(
                'required', 'integer'
            ),
            'brand_id' => array(
                'required', 'integer'
            ),
            'nutritional_value_id' => array(
                'required', 'integer'
            )
        );
        $v = new Validator($cheese);
        $v->mapFieldsRules($rules);
        if ($v->validate()) {
            echo "Data validated";
        } else {
            // Errors
            echo $v->errorsToString();
            echo $v->errorsToJson();
        }
    }

}

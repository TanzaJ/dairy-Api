<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Exceptions\HttpMissingDataException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Helpers\Validator;
use Vanier\Api\Models\MilkModel;
use Slim\Exception\HttpBadRequestException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;


/**
 * A controller class that handles requests concerning milk
 */
class MilkController extends BaseController
{

    private array $errors = array();
    private $milk_model =null;
    private $log;


    public function __construct() {
        // $this->log = new Logger();
        $this->milk_model = new MilkModel();
 
    }

    /**
     * Fetches a list of milk entries
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleGetMilk(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $validation_response = $this->isValidPagingParams($filters);
        if ($validation_response === true){
            $this->milk_model->setPaginationOptions(
                $filters['page'],
                $filters['page_size']
            );
        }
        else{
            throw new HttpBadRequestException($request, $validation_response);
        }

        $filters = $request->getQueryParams();
        $milk = $this->milk_model->getAll($filters);
        // $this->log->info('Get Request for MILK received with following filters:', $filters);
        return $this->prepareOkResponse($response,(array) $milk);
    }

    /**
     * Fetches a list of milk entries based on id
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleGetMilkById(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $milk_id = $uri_args['milk_id'];
        if (!Input::isInt($milk_id)) {
            //throw exception
        }
        if($milk_id < 0) {
            //throw exception
        }



        $milk = $this->milk_model->getMilkById($uri_args['milk_id']);
        return $this->prepareOkResponse($response,(array) $milk);
    }

    /**
     * Creates milk entries
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     */
    public function handleCreateMilk(Request $request, Response $response)
    {
        //Rules
        $rules = array(
            'name' => array(
                'required'
            ),
            'average_cost' => array(
                'required', 'numeric'
            ),
            'place_of_origin' => array(
                'required'
            ),
            'year_created' => array(
                'required',  'integer'
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

        $isError = false;

        //Parse request body
        $milks = $request->getParsedBody();

        //Checks if empty
        if(empty($milks) || isset($milk))
        {
            throw new HttpMissingDataException($request,
            "Couldn't create milks/process the request due to missing data.");
        }


        foreach ($milks as $key => $milk){
            $validation_response = $this->isValidData($milk, $rules);
            if($validation_response === true){
                $this->milk_model->addMilk($milk);

            }
            else {
                $isError = true;
                array_push($this->errors, $validation_response);

            }
        }

        if ($isError){
            $message = "";
            foreach ($this->errors as $key => $error){
                $message .= $error . "---";
            }

            $response_data = array(
                "code" => HttpCodes::STATUS_BAD_REQUEST,
                "message" => $message,
            );
            return $this->prepareOkResponse(
                $response,
                $response_data,
                HttpCodes::STATUS_BAD_REQUEST
            );
        }
        else{
            $response_data = array(
                "code" => HttpCodes::STATUS_CREATED,
                "message" => "The list of Milks has been successfully created",
            );
            return $this->prepareOkResponse(
                $response,
                $response_data,
                HttpCodes::STATUS_CREATED
            );
        }
    }

    /**
     * Updates milk entries based on the request body
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleUpdateMilk(Request $request, Response $response, array $uri_args)
    {
        //Rules
        $rules = array(
            'milk_id' => array(
                'required', 'integer'
            ),
            'name' => array(
                'required'
            ),
            'average_cost' => array(
                'required', 'numeric'
            ),
            'place_of_origin' => array(
                'required'
            ),
            'year_created' => array(
                'required',  'integer'
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

        $isError = false;

        $milks = $request->getParsedBody();
    
        if (empty($milks)) {
            throw new HttpMissingDataException(
                $request,
                "Couldn't update milks/process the request due to missing data."
            );
        }
    
        foreach ($milks as $milk) {
            $validation_response = $this->isValidData($milk, $rules);
    
            if ($validation_response === true) {
                $id = $milk['milk_id'];
                unset($milk['milk_id']);
    
                try {
                    $this->milk_model->updateModel($milk, $id);
                } catch (\Exception $e) {
                    $isError = true;
                    array_push($this->errors, $e->getMessage());
                }
            } else {
                $isError = true;
                array_push($this->errors, $validation_response);
            }
        }
    
        if ($isError) {
            $message = implode('---', $this->errors);
    
            $response_data = [
                "code" => HttpCodes::STATUS_BAD_REQUEST,
                "message" => $message,
            ];
    
            return $this->prepareOkResponse(
                $response,
                $response_data,
                HttpCodes::STATUS_BAD_REQUEST
            );
        } else {
            $response_data = [
                "code" => HttpCodes::STATUS_CREATED,
                "message" => "The list of Milks has been successfully updated",
            ];
    
            return $this->prepareOkResponse(
                $response,
                $response_data,
                HttpCodes::STATUS_CREATED
            );
        }

    }

    /**
     * Deletes milk entries
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleDeleteMilk(Request $request, Response $response, array $uri_args)
    {
        $isError = false;
        $milk_id = $uri_args['milk_id'];
        $validation_id = $this->isValidId($milk_id);
        if ($validation_id === true){
            $this->milk_model->deleteMilk($milk_id);
        }
        else{
            $isError = true;
        }

        if ($isError){
            $message = "Id is not valid: " . $milk_id;
            $response_data = array(
                "code" => HttpCodes::STATUS_BAD_REQUEST,
                "message" => $message,
            );
            return $this->prepareOkResponse(
                $response,
                $response_data,
                HttpCodes::STATUS_BAD_REQUEST
            );
        }
        else{
            $response_data = array(
                "code" => HttpCodes::STATUS_CREATED,
                "message" => "The provided list of milk entries have been successfully deleted!",
            );
            return $this->prepareOkResponse(
                $response,
                $response_data,
                HttpCodes::STATUS_CREATED
            );
        }
    }

    /**
     * Validates milk entries
     * 
     * @param  array $milk the entry to be validated
     */
    public function validateMilk(array $milk) 
    {
        $rules = array(
            'milk_id' => array(
                'required', 'int'
            ),
            'name' => array(
                'required'
            ),
            'average_cost' => array(
                'required', 'float'
            ),
            'place_of_origin' => array(
                'required'
            ),
            'year_created' => array(
                'required'
            ),
            'country_id' => array(
                'required', 'int'
            ),
            'brand_id' => array(
                'required', 'int'
            ),
            'nutritional_value_id' => array(
                'required', 'int'
            )
        );

        $v = new Validator($milk);
        $v->mapFieldsRules($rules);
        if($v->validate()) {
            echo "Data validated";
        }else {
            // Errors
            echo $v->errorsToString();
            echo $v->errorsToJson();
        }
    }
}

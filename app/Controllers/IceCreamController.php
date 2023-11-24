<?php

namespace Vanier\Api\Controllers;
use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Exceptions\HttpMissingDataException;
use Slim\Exception\HttpBadRequestException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Helpers\Validator;
use Vanier\Api\Models\IceCreamModel;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * A controller class that handles requests concerning ice cream
 */
class IceCreamController extends BaseController
{

    private array $errors = array();
    private $ice_cream_model =null;

    public function __construct() {
        $this->ice_cream_model = new IceCreamModel();
    }

    /**
     * Fetches a list of ice creams
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleGetIceCream(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $validation_response = $this->isValidPagingParams($filters);
        if ($validation_response === true){
            $this->ice_cream_model->setPaginationOptions(
                $filters['page'],
                $filters['page_size']
            );
        }
        else{
            throw new HttpBadRequestException($request, $validation_response);
        }
        $filters = $request->getQueryParams();
        $ice_cream_info = $this->ice_cream_model->getAll($filters);
        return $this->prepareOkResponse($response,(array) $ice_cream_info);
    }

    /**
     * Fetches a list of ice creams based on id
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleGetIceCreamById(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $ice_cream_id = $uri_args['ice_cream_id'];
        if (!Input::isInt($ice_cream_id)) {
            //throw exception
        }
        if($ice_cream_id < 0) {
            //throw exception
        }



        $ice_cream = $this->ice_cream_model->getIceCreamById($uri_args['ice_cream_id']);
        return $this->prepareOkResponse($response,(array) $ice_cream);
    }

    /**
     * Creates ice cream entries
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     */
    public function handleCreateIceCream(Request $request, Response $response)
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
        $isError = false;
        $ice_creams = $request->getParsedBody();
        $isEmpty = false;
        
        if ($ice_creams != null && $ice_creams != '') {
            foreach ($ice_creams as $key => $ice_cream){
                $validation_response = $this->isValidData($ice_cream, $rules);
                if($validation_response === true){
                    $this->ice_cream_model->addIceCream($ice_cream);
    
                }
                else {
                    $isError = true;
                    array_push($this->errors, $validation_response);
    
                }
            }
        }
        else{
            $isEmpty = true;
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
        else if ($isEmpty){

            $response_data = array(
                "code" => HttpCodes::STATUS_BAD_REQUEST,
                "message" => 'The body of the request is invalid',
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
                "message" => "The list of Ice Creams has been successfully created",
            );
            return $this->prepareOkResponse(
                $response,
                $response_data,
                HttpCodes::STATUS_CREATED
            );
        }
    }

    /**
     * Updates ice cream entries based on the request body
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleUpdateIceCream(Request $request, Response $response, array $uri_args)
    {
        $ice_creams = $request->getParsedBody();
        $rules = array(
            'ice_cream_id' => array(
                'required', 'integer'
            ),
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
        $isError = false;
        if ($ice_creams != null && $ice_creams != '') {
            foreach ($ice_creams as $key => $ice_cream){
                $validation_response = $this->isValidData($ice_cream, $rules);
                if($validation_response === true){
                    $this->ice_cream_model->updateIceCream($ice_cream);
                }
                else {
                    $isError = true;
                    array_push($this->errors, $validation_response);
                }
            }
        }
        else{
            $isEmpty = true;
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
        else if ($isEmpty){

            $response_data = array(
                "code" => HttpCodes::STATUS_BAD_REQUEST,
                "message" => 'The body of the request is invalid',
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
                "message" => "The list of Ice Creams has been successfully updated",
            );
            return $this->prepareOkResponse(
                $response,
                $response_data,
                HttpCodes::STATUS_CREATED
            );
        }
    }

    /**
     * Deletes ice cream entries based on the provided id
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleDeleteIceCream(Request $request, Response $response, array $uri_args)
    {
        $isError = false;
        $ice_cream_id = $uri_args['ice_cream_id'];
        $validation_id = $this->isValidId($ice_cream_id);
        if ($validation_id === true){
            $this->ice_cream_model->deleteIceCream($ice_cream_id);
        }
        else{
            $isError = true;
        }

        if ($isError){
            $message = "Id is not valid: " . $ice_cream_id;
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
                "message" => "The provided list of ice cream entries have been successfully deleted!",
            );
            return $this->prepareOkResponse(
                $response,
                $response_data,
                HttpCodes::STATUS_CREATED
            );
        }
    }
}

<?php

namespace Vanier\Api\Controllers;

use Vanier\Api\Exceptions\HttpMissingDataException;
use Vanier\Api\Helpers\Validator;
use Vanier\Api\Models\NutritionalValueModel;
use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Helpers\Input;
use Slim\Exception\HttpBadRequestException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * A controller class that handles requests concerning nutritional value
 */
class NutritionalValueController extends BaseController
{
    private $nv_model =null;

    public function __construct() {
        $this->nv_model = new NutritionalValueModel();
    }

    /**
     * Fetches a list of nutritional value entries
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleGetNV(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $validation_response = $this->isValidPagingParams($filters);
        if ($validation_response === true){
            $this->nv_model->setPaginationOptions(
                $filters['page'],
                $filters['page_size']
            );
        }
        else{
            throw new HttpBadRequestException($request, $validation_response);
        }
        $filters = $request->getQueryParams();
        $nv_info = $this->nv_model->getAll($filters);
        return $this->prepareOkResponse($response,(array) $nv_info);
    }

    /**
     * Fetches a list of nutritional value entries based on id
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleGetNVById(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $nutritional_value_id = $uri_args['nutritional_value_id'];
        if (!Input::isInt($nutritional_value_id)) {
            //throw exception
        }
        if($nutritional_value_id < 0) {
            //throw exception
        }



        $nv = $this->nv_model->getNVById($uri_args['nutritional_value_id']);
        return $this->prepareOkResponse($response,(array) $nv);
    }

    /**
     * Creates nutritional value entries
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     */
    public function handleCreateNV(Request $request, Response $response)
    {
        $rules = array(
            'kcal ' => array(
                'required', 'integer'
            ),
            'fiber' => array(
                'required', 'integer'
            ),
            'cholesterol' => array(
                'required', 'integer'
            ),
            'carbohydrate ' => array(
                'required', 'integer'
            ),
            'protein' => array(
                'required', 'integer'
            ),
            'monosat_fat' => array(
                'required', 'integer'
            ),
            'polysat_fat ' => array(
                'required', 'integer'
            ),
            'sat_fat' => array(
                'required', 'integer'
            )
        );
        $isError = false;
        $nvs = $request->getParsedBody();
        $isEmpty = false;
        
        if ($nvs != null && $nvs != '') {
            foreach ($nvs as $key => $nv){
                $validation_response = $this->isValidData($nv, $rules);
                if($validation_response === true){
                    $this->nv_model->addIceCream($nv);
    
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
     * Updates nutritional value entries based on the request body
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleUpdateNV(Request $request, Response $response, array $uri_args)
    {
        $nvs = $request->getParsedBody();
        if(!isset($nvs)) 
        {
            throw new HttpMissingDataException($request,
            "Couldn't update nutritional values/process the request due to missing data.");
        }

        foreach($nvs as $key => $nv) {
            $id = ['nv_id' => $nv['nv_id']];
            unset($nv['nv_id']);

            $this->validateNV($nv);
            
            $this->nv_model->updateNV($nv, $id);
        }
        $response_data = array(
            "code" => HttpCodes::STATUS_ACCEPTED,
            "message"=>"The provided list of nutritional values entries has been successfully updated!"
    );
        return $this->prepareOkResponse(
            $response,
            $response_data,
            HttpCodes::STATUS_ACCEPTED
        );

    }

    /**
     * Deletes nutritional value entries
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleDeleteNV(Request $request, Response $response, array $uri_args)
    {
        $nvs = $request->getParsedBody(); 
        foreach($nvs as $key => $nv) {
            $id = ['nv_id' => $nv['nv_id']];
            unset($nv['nv_id']);
        
            if($id < 0) {
                //TODO: throw exception
            // throw new HttpNoNegativeId($request, "Invalid id");
            }

            $this->nv_model->deleteNV($id);
        }

    $response_data = array(
        "code" => HttpCodes::STATUS_ACCEPTED,
        "message"=>"The provided list of brand entries have been successfully deleted!"
    );
    return $this->prepareOkResponse(
        $response,
        $response_data,
        HttpCodes::STATUS_ACCEPTED
    );
    }

    /**
     * Validates nutritional value entries
     * 
     * @param  array $nv the entry to be validated
     */
    public function validateNV(array $nv) {
        $rules = array(
            'brand_id ' => array(
                'required', 'integer'
            ),
            'brand_name' => array(
                'required',
            ),
            'country_id' => array(
                'int'
            )
        );

        $v = new Validator($nv);
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

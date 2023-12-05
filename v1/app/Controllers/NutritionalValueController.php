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

class NutritionalValueController extends BaseController
{
    private $nv_model =null;

    public function __construct() {
        $this->nv_model = new NutritionalValueModel();
    }

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

    public function handleCreateNV(Request $request, Response $response)
    {
        $nvs = $request->getParsedBody();
        if(!isset($nvs)) 
        {
            throw new HttpMissingDataException($request,
            "Couldn't create nutritional values/process the request due to missing data.");
        }
        foreach($nvs as $key => $nv) {
            $this->validateNV($nv);

            $this->nv_model->addNV($nv);
        }
        $response_data = array(
            "code" => HttpCodes::STATUS_CREATED,
            "message"=>"The provided list of nutritional values entries have been successfully created!"
    );
        return $this->prepareOkResponse(
            $response,
            $response_data,
            HttpCodes::STATUS_CREATED
        );
    }

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
    public function validateNV(array $nv) {
        $rules = array(
            'brand_id ' => array(
                'required', 'int'
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

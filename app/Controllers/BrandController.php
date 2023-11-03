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
use Vanier\Api\Models\BrandModel;

class BrandController extends BaseController
{
    private $brand_model =null;

    public function __construct() {
        $this->brand_model = new BrandModel();
    }

    public function handleGetBrand(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $validation_response = $this->isValidPagingParams($filters);
        if ($validation_response === true){
            $this->brand_model->setPaginationOptions(
                $filters['page'],
                $filters['page_size']
            );
        }
        else{
            throw new HttpBadRequestException($request, $validation_response);
        }
        
        $filters = $request->getQueryParams();
        $brand_info = $this->brand_model->getAll($filters);
        return $this->prepareOkResponse($response,(array) $brand_info);
    }
    public function handleCreateBrand(Request $request, Response $response)
    {
        $brands = $request->getParsedBody();
        if(!isset($brands)) 
        {
            throw new HttpMissingDataException($request, "Couldn't create brands/process the request due to missing data.");
        }
        foreach($brands as $key => $brand) {
            $this->validateBrand($brand);

            $this->brand_model->addBrand($brand);
        }
        $response_data = array(
            "code" => HttpCodes::STATUS_CREATED,
            "message"=>"The provided list of brand entries have been successfully created!"
    );
        return $this->prepareOkResponse(
            $response,
            $response_data,
            HttpCodes::STATUS_CREATED
        );
    }

    public function handleUpdateBrand(Request $request, Response $response, array $uri_args)
    {
        $brands = $request->getParsedBody();
        if(!isset($brands)) 
        {
            throw new HttpMissingDataException($request,
            "Couldn't update brand/process the request due to missing data.");
        }

        foreach($brands as $key => $brand) {
            $id = $brand['brand_id'];
            unset($brand['brand_id']);

            $this->validateBrand($brand);
            
            $this->brand_model->updateBrand($brand, $id);
        }
        $response_data = array(
            "code" => HttpCodes::STATUS_ACCEPTED,
            "message"=>"The provided list of brand entries has been successfully updated!"
    );
        return $this->prepareOkResponse(
            $response,
            $response_data,
            HttpCodes::STATUS_ACCEPTED
        );

    }

    public function handleDeleteBrand(Request $request, Response $response, array $uri_args)
    {
        $butters = $request->getParsedBody(); 
        foreach($butters as $key => $butter) {
        $id = $butter['brand_id'];
        unset($butter['brand_id']);
       
        if($id < 0) {
            //TODO: throw exception
           // throw new HttpNoNegativeId($request, "Invalid id");
        }

        $this->brand_model->deleteBrand($id);
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
    public function validateBrand(array $brand) {
        $rules = array(
            'brand_id ' => array(
                'required', 'int'
            ),
            'brand_name' => array(
                'required'
            ),
            'country_id' => array(
                'int'
            )
        );

        $v = new Validator($brand);
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

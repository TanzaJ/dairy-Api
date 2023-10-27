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


class IceCreamController extends BaseController
{
    private $ice_cream_model =null;

    public function __construct() {
        $this->ice_cream_model = new IceCreamModel();
    }

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

    public function handleCreateIceCream(Request $request, Response $response)
    {
        $ice_creams = $request->getParsedBody();
        if(!isset($ice_creams)) 
        {
            throw new HttpMissingDataException($request,
            "Couldn't create ice cream/process the request due to missing data.");
        }
        foreach($ice_creams as $key => $ice_cream) {
            $this->validateIceCream($ice_cream);

            $this->ice_cream_model->addIceCream($ice_cream);
        }
        $response_data = array(
            "code" => HttpCodes::STATUS_CREATED,
            "message"=>"The provided list of ice cream entries have been successfully created!"
    );
        return $this->prepareOkResponse(
            $response,
            $response_data,
            HttpCodes::STATUS_CREATED
        );
    }

    public function handleUpdateIceCream(Request $request, Response $response, array $uri_args)
    {
        $ice_creams = $request->getParsedBody();
        if(!isset($ice_creams)) 
        {
            throw new HttpMissingDataException($request,
            "Couldn't update ice cream/process the request due to missing data.");
        }

        foreach($ice_creams as $key => $ice_cream) {
            $id = $ice_cream['ice_cream_id'];
            unset($ice_cream['ice_cream_id']);

            $this->validateIceCream($ice_cream);
            
            $this->ice_cream_model->updateModel($ice_cream, $id);
        }
        $response_data = array(
            "code" => HttpCodes::STATUS_ACCEPTED,
            "message"=>"The provided list of ice cream entries has been successfully updated!"
    );
        return $this->prepareOkResponse(
            $response,
            $response_data,
            HttpCodes::STATUS_ACCEPTED
        );

    }

    public function handleDeleteIceCream(Request $request, Response $response, array $uri_args)
    {
        $ice_creams = $request->getParsedBody(); 
        foreach($ice_creams as $key => $ice_cream) {
        $id = $ice_cream['ice_cream_id'];
        unset($ice_cream['ice_cream_id']);
       
        if($id < 0) {
            //TODO: throw exception
           // throw new HttpNoNegativeId($request, "Invalid id");
        }

        $this->ice_cream_model->deleteIceCream($id);
    }

    $response_data = array(
        "code" => HttpCodes::STATUS_ACCEPTED,
        "message"=>"The provided list of ice cream entries have been successfully deleted!"
    );
    return $this->prepareOkResponse(
        $response,
        $response_data,
        HttpCodes::STATUS_ACCEPTED
    );
    }

    public function validateIceCream(array $ice_cream) 
    {
        $rules = array(
            'ice_cream_id' => array(
                'required', 'int'
            ),
            'milk_id' => array(
                'required', 'int'
            ),
            'product_name' => array(
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

        $v = new Validator($ice_cream);
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

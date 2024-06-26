<?php

namespace Vanier\Api\Controllers;
use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Exceptions\HttpMissingDataException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Helpers\Validator;
use Vanier\Api\Models\UnitTypeModel;
use Slim\Exception\HttpBadRequestException;

class UnitTypeController extends BaseController
{
    private $unit_type_model =null;

    public function __construct() {
        $this->unit_type_model = new UnitTypeModel();
    }

    public function handleGetUnitType(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $validation_response = $this->isValidPagingParams($filters);
        if ($validation_response === true){
            $this->unit_type_model->setPaginationOptions(
                $filters['page'],
                $filters['page_size']
            );
        }
        else{
            throw new HttpBadRequestException($request, $validation_response);
        }

        $filters = $request->getQueryParams();
        $unit_type_info = $this->unit_type_model->getAll($filters);
        return $this->prepareOkResponse($response,(array) $unit_type_info);
    }
    
    public function handleCreateUnitType(Request $request, Response $response)
    {
        $unitTypes = $request->getParsedBody();
        if(!isset($unitTypes)) 
        {
            throw new HttpMissingDataException($request,
            "Couldn't create unit type/process the request due to missing data.");
        }
        foreach($unitTypes as $key => $unitType) {
            $this->validateUnitType($unitType);

            $this->unit_type_model->addUnitType($unitType);
        }
        $response_data = array(
            "code" => HttpCodes::STATUS_CREATED,
            "message"=>"The provided list of unit type entries have been successfully created!"
    );
        return $this->prepareOkResponse(
            $response,
            $response_data,
            HttpCodes::STATUS_CREATED
        );
    }

    public function handleUpdateUnitType(Request $request, Response $response, array $uri_args)
    {
        $unitTypes = $request->getParsedBody();
        if(!isset($unitTypes)) 
        {
            throw new HttpMissingDataException($request,
            "Couldn't update unit type/process the request due to missing data.");
        }

        foreach($unitTypes as $key => $unitType) {
            $id = ['unitType_id' => $unitType['unitType_id']];
            unset($unitType['unitType_id']);

            $this->validateUnitType($unitType);
            
            $this->unit_type_model->updateUnitType($unitType, $id);
        }
        $response_data = array(
            "code" => HttpCodes::STATUS_ACCEPTED,
            "message"=>"The provided list of unit type entries has been successfully updated!"
    );
        return $this->prepareOkResponse(
            $response,
            $response_data,
            HttpCodes::STATUS_ACCEPTED
        );

    }

    public function handleDeleteUnitType(Request $request, Response $response, array $uri_args)
    {
        $unitTypes = $request->getParsedBody(); 
        foreach($unitTypes as $key => $unitType) {
        $id = ['unitType_id' => $unitType['unitType_id']];
        unset($unitType['unitType_id']);
       
        if($id < 0) {
            //TODO: throw exception
           // throw new HttpNoNegativeId($request, "Invalid id");
        }

        $this->unit_type_model->deleteUnitType($id);
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
    public function validateUnitType(array $unitType) {
        $rules = array(
            'unit_id ' => array(
                'required', 'int'
            ),
            'unit_name' => array(
                'required',
            ),
            'unit_scale' => array(
                'int', 'int'
            )
        );

        $v = new Validator($unitType);
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

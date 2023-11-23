<?php

namespace Vanier\Api\Controllers;
use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Exceptions\HttpMissingDataException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Helpers\Validator;
use Vanier\Api\Models\ProjMilkModel;
use Slim\Exception\HttpBadRequestException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ProjMilkController extends BaseController
{
    private $proj_milk_model =null;

    public function __construct() {
        $this->proj_milk_model = new ProjMilkModel();
    }

    public function handleGetProjMilk(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $validation_response = $this->isValidPagingParams($filters);
        if ($validation_response === true){
            $this->proj_milk_model->setPaginationOptions(
                $filters['page'],
                $filters['page_size']
            );
        }
        else{
            throw new HttpBadRequestException($request, $validation_response);
        }
        
        $filters = $request->getQueryParams();
        $proj_milk_info = $this->proj_milk_model->getAll($filters);
        return $this->prepareOkResponse($response,(array) $proj_milk_info);
    }

    public function handleGetProjMilkById(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $pmp_id = $uri_args['pmp_id'];
        if (!Input::isInt($pmp_id)) {
            //throw exception
        }
        if($pmp_id < 0) {
            //throw exception
        }



        $proj_milk = $this->proj_milk_model->getProjMilkById($uri_args['pmp_id']);
        return $this->prepareOkResponse($response,(array) $proj_milk);
    }

    public function handleCreateProjMilk(Request $request, Response $response)
    {
        $projMilks = $request->getParsedBody();
        if(!isset($projMilks)) 
        {
            throw new HttpMissingDataException($request,
            "Couldn't create projected milk/process the request due to missing data.");
        }
        foreach($projMilks as $key => $projMilk) {
            $this->validateProjMilk($projMilk);

            $this->proj_milk_model->addProjMilk($projMilk);
        }
        $response_data = array(
            "code" => HttpCodes::STATUS_CREATED,
            "message"=>"The provided list of projected milk entries have been successfully created!"
    );
        return $this->prepareOkResponse(
            $response,
            $response_data,
            HttpCodes::STATUS_CREATED
        );
    }

    public function handleUpdateProjMilk(Request $request, Response $response, array $uri_args)
    {
        $projMilks = $request->getParsedBody();
        if(!isset($projMilks)) 
        {
            throw new HttpMissingDataException($request,
            "Couldn't update projected milk/process the request due to missing data.");
        }

        foreach($projMilks as $key => $projMilk) {
            $id = ['projMilk_id' => $projMilk['projMilk_id']];
            unset($projMilk['projMilk_id']);

            $this->validateProjMilk($projMilk);
            
            $this->proj_milk_model->updateProjMilk($projMilk, $id);
        }
        $response_data = array(
            "code" => HttpCodes::STATUS_ACCEPTED,
            "message"=>"The provided list of projected milk entries has been successfully updated!"
    );
        return $this->prepareOkResponse(
            $response,
            $response_data,
            HttpCodes::STATUS_ACCEPTED
        );

    }

    public function handleDeleteProjMilk(Request $request, Response $response, array $uri_args)
    {
        $projMilks = $request->getParsedBody(); 
        foreach($projMilks as $key => $projMilk) {
        $id = ['projMilk_id' => $projMilk['projMilk_id']];
        unset($projMilk['projMilk_id']);
       
        if($id < 0) {
            //TODO: throw exception
           // throw new HttpNoNegativeId($request, "Invalid id");
        }

        $this->proj_milk_model->deleteProjMilk($id);
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
    public function validateProjMilk(array $projMilk) {
        $rules = array(
            'pmp_id' => array(
                'required', 'int'
            ),
            'year' => array(
                'required'
            ),
            'type' => array(
                'required'
            ),
            'production' => array(
                'required', 'numeric'
            ),
            'consumption' => array(
                'required', 'numeric'
            ),
            'price' => array(
                'required', 'numeric'
            ),
            'milk_id' => array(
                'required', 'int'
            ),
            'unit_id' => array(
                'required', 'int'
            )
        );

        $v = new Validator($projMilk);
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

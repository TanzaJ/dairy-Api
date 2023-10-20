<?php

namespace Vanier\Api\Controllers;

use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Exceptions\HttpMissingDataException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Helpers\Validator;
use Vanier\Api\Models\MilkModel;

class MilkController extends BaseController
{
    private $milk_model =null;

    public function __construct() {
        $this->milk_model = new MilkModel();
    }

    public function handleGetMilk(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $milk = $this->milk_model->getAll($filters);
        return $this->prepareOkResponse($response,(array) $milk);
    }

    public function handleCreateMilk(Request $request, Response $response)
    {
        $milks = $request->getParsedBody();
        if(!isset($milks)) 
        {
            throw new HttpMissingDataException($request,
            "Couldn't create milks/process the request due to missing data.");
        }
        foreach($milks as $key => $milk) {
            $this->validateMilk($milk);

            $this->milk_model->addMilk($milk);
        }
        $response_data = array(
            "code" => HttpCodes::STATUS_CREATED,
            "message"=>"The provided list of milk entries have been successfully created!"
    );
        return $this->prepareOkResponse(
            $response,
            $response_data,
            HttpCodes::STATUS_CREATED
        );
    }

    public function handleUpdateMilk(Request $request, Response $response, array $uri_args)
    {
        $milks = $request->getParsedBody();
        if(!isset($milks)) 
        {
            throw new HttpMissingDataException($request,
            "Couldn't update milk/process the request due to missing data.");
        }

        foreach($milks as $key => $milk) {
            $id = $milk['milk_id'];
            unset($milk['milk_id']);

            $this->validateMilk($milk);
            
            $this->milk_model->updateModel($milk, $id);
        }
        $response_data = array(
            "code" => HttpCodes::STATUS_ACCEPTED,
            "message"=>"The provided list of milk has been successfully updated!"
    );
        return $this->prepareOkResponse(
            $response,
            $response_data,
            HttpCodes::STATUS_ACCEPTED
        );

    }

    public function deleteMilk(Request $request, Response $response, array $uri_args)
    {
        $milks = $request->getParsedBody(); 
        foreach($milks as $key => $milk) {
        $id = $milk['milk_id'];
        unset($milk['milk_id']);
       
        if($id < 0) {
            //TODO: throw exception
           // throw new HttpNoNegativeId($request, "Invalid id");
        }

        $this->milk_model->deleteMilk($id);
    }

    $response_data = array(
        "code" => HttpCodes::STATUS_ACCEPTED,
        "message"=>"The provided list of milk entries have been successfully deleted!"
    );
    return $this->prepareOkResponse(
        $response,
        $response_data,
        HttpCodes::STATUS_ACCEPTED
    );
    }

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

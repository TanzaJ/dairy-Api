<?php

namespace Vanier\Api\Controllers;
use Fig\Http\Message\StatusCodeInterface as HttpCodes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Vanier\Api\Exceptions\HttpMissingDataException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Helpers\Validator;
use Vanier\Api\Models\ButterModel;
use Slim\Exception\HttpBadRequestException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * A controller class that handles requests concerning butter entries
 */
class ButterController extends BaseController
{
    private $butter_model =null;

    public function __construct() {
        $this->butter_model = new ButterModel();
    }

    /**
     * Fetches a list of butters
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleGetButter(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $validation_response = $this->isValidPagingParams($filters);
        if ($validation_response === true){
            $this->butter_model->setPaginationOptions(
                $filters['page'],
                $filters['page_size']
            );
        }
        else{
            throw new HttpBadRequestException($request, $validation_response);
        }


        $filters = $request->getQueryParams();
        $butter_info = $this->butter_model->getAll($filters);
        return $this->prepareOkResponse($response,(array) $butter_info);
    }

    /**
     * Fetches a list of butters based on the id provided
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleGetButterById(Request $request, Response $response, array $uri_args)
    {
        $filters = $request->getQueryParams();
        $butter_id = $uri_args['butter_id'];
        if (!Input::isInt($butter_id)) {
            //throw exception
        }
        if($butter_id < 0) {
            //throw exception
        }



        $butter = $this->butter_model->getButterById($uri_args['butter_id']);
        return $this->prepareOkResponse($response,(array) $butter);
    }

    /**
     * Creates butter entries
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     */
    public function handleCreateButter(Request $request, Response $response)
    {
        $butters = $request->getParsedBody();
        if(!isset($butters)) 
        {
            throw new HttpMissingDataException($request,
            "Couldn't create butters/process the request due to missing data.");
        }
        foreach($butters as $key => $butter) {
            // $this->validateButter($butter);

            $this->butter_model->addButter($butter);
        }
        $response_data = array(
            "code" => HttpCodes::STATUS_CREATED,
            "message"=>"The provided list of butter entries have been successfully created!"
    );
        return $this->prepareOkResponse(
            $response,
            $response_data,
            HttpCodes::STATUS_CREATED
        );
    }

    /**
     * Updates butter entries based on the request body
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleUpdateButter(Request $request, Response $response, array $uri_args)
    {
        $butters = $request->getParsedBody();
        if(!isset($butters)) 
        {
            throw new HttpMissingDataException($request,
            "Couldn't update butter/process the request due to missing data.");
        }

        foreach($butters as $key => $butter) {
            $id = $butter['butter_id'];
            unset($butter['butter_id']);

            $this->validateButter($butter);
            
            $this->butter_model->updateModel($butter, $id);
        }
        $response_data = array(
            "code" => HttpCodes::STATUS_ACCEPTED,
            "message"=>"The provided list of butter entries has been successfully updated!"
    );
        return $this->prepareOkResponse(
            $response,
            $response_data,
            HttpCodes::STATUS_ACCEPTED
        );

    }

    /**
     * Deletes butter entries based on the id provided
     * 
     * @param  Request $request the request
     * @param  Response $response the response
     * @param  array $uri_args the arguments added to the request
     */
    public function handleDeleteButter(Request $request, Response $response, array $uri_args)
    {
        $butters = $request->getParsedBody(); 
        foreach($butters as $key => $butter) {
        $id = $butter['butter_id'];
        unset($butter['butter_id']);
       
        if($id < 0) {
            //TODO: throw exception
           // throw new HttpNoNegativeId($request, "Invalid id");
        }

        $this->butter_model->deleteButter($id);
    }

    $response_data = array(
        "code" => HttpCodes::STATUS_ACCEPTED,
        "message"=>"The provided list of butter entries have been successfully deleted!"
    );
    return $this->prepareOkResponse(
        $response,
        $response_data,
        HttpCodes::STATUS_ACCEPTED
    );
    }

    /**
     * Validates butter entries
     * 
     * @param  array $butter the entry to be validated
     */
    public function validateButter(array $butter) 
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

        $v = new Validator($butter);
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

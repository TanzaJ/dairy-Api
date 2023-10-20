<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Exceptions\HttpInvalidInputException;
use Vanier\Api\Helpers\Input;
use Vanier\Api\Helpers\Validator;
class BaseController
{
    protected function prepareOkResponse(Response $response, array $data, int $status_code = 200)
    {
        // var_dump($data);
        $json_data = json_encode($data);
        //-- Write JSON data into the response's body.        
        $response->getBody()->write($json_data);
        return $response->withStatus($status_code)->withAddedHeader(HEADERS_CONTENT_TYPE, APP_MEDIA_TYPE_JSON);
    }

        /**
     * checks the validity of the Paging Parameters and returns true if alright if not it will return an array of the errors
     *
     * @param array $paging_params
     * @return mixed
     */
    protected function isValidPagingParams(array $paging_params) : mixed{
        $rules = array(
            'page' => [
                'required',
                'numeric',
                ['min', 1]
            ],
            'page_size' => [
                'required',
                'integer',
                ['min', 5],
                ['max', 50]
            ]
        );

        return $this->isValidData($paging_params, $rules);
    }
    /**
     * Checks if the id recieved is not negative or zero
     *
     * @param integer $id
     * @return boolean
     */
    protected function isValidId(int $id) : mixed{
        $rules = array(
            'id' => [
                'required',
                'numeric',
                ['min', 1]
            ]
        );

        return $this->isValidData(array("id" => $id), $rules);
    }
    protected function isValidData(array $data, array $rules) : mixed{
        $validator = new Validator($data);
        // Important: map the validation rules before calling validate()
        $validator->mapFieldsRules($rules);
        if ($validator->validate()) {
            return true;
        }
        return $validator->errorsToJson();
    }

    /**
     * Validates the pagination within the request and wether it is set or not
     *
     * @param [type] $request
     * @param [type] $filters
     * @param [type] $model
     * @return void
     */
    public function validatePagination($request, $filters, $model) {
        if (isset($filters['page'])){
            $page = $filters['page'];
            if(!Input::isInt($page)){
                throw new HttpInvalidInputException(
                    $request,
                    "The provided page number was invalid"
                );
        
            }

            if (isset($filters['page_size'])){
                $page_size = $filters['page_size'];
                $model->setPaginationOptions(
                    $page,
                    $page_size
                );
            }
            else{
                $model->setPaginationPage(
                    $page
                );
            }
 
        }
        else if (isset($filters['page_size'])){
            $page_size = $filters['page_size'];
            $model->setPaginationPageSize(
                $page_size
            );
        }
    }
}

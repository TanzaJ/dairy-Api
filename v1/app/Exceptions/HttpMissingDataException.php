<?php

namespace Vanier\Api\Exceptions;
use Slim\Exception\HttpSpecializedException;

class HttpMissingDataException extends HttpSpecializedException
{
    protected $code = 425;
    protected $message = 'Missing data.';
    protected string $title = 'Bad request.';
    protected string $description = 'Make sure you have entered data.';

}

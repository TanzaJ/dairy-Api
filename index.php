<?php
use Slim\Factory\AppFactory;
use Vanier\Api\Middleware\ContentNegotiationMiddleware;

require __DIR__ . '/vendor/autoload.php';

 // Include the file that contains the application's global configuration settings,
 // database credentials, etc.
require_once __DIR__ .'/app/Config/app_config.php';

//--Step 1) Instantiate a Slim app.s
$app = AppFactory::create();

$app->addMiddleware(new ContentNegotiationMiddleware());

$app->addBodyParsingMiddleware();

$app->addRoutingMiddleware();
// NOTE: the error handling middleware MUST be added last.
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->getDefaultErrorHandler()->forceContentType(APP_MEDIA_TYPE_JSON);

// TODO: change the name of the subdirectory here.
// You also need to change it in .htaccess
$app->setBasePath("/dairy-api");

// Here we include the file that contains the application routes. 
// NOTE: your routes must be managed in the api_routes.php file.
require_once __DIR__ . '/app/Routes/app_routes.php';

// Run the app.
$app->run();

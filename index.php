<?php
// if ($match = is_allowed_domain(null, ["http://localhost:3000"]))
//   header("Access-Control-Allow-Origin: $match");

require __DIR__ . '/vendor/autoload.php';

use Relaxdd\RestApi\Controllers\TestController;
use Relaxdd\RestApi\Request;
use Relaxdd\RestApi\Service;

$request = new Request([
        'GET' => $_GET,
        'POST' => $_POST,
        'FILES' => $_FILES,
        'SERVER' => $_SERVER
    ]
);


$service = new Service($request);
$service->append('tests', TestController::class);
$service->run();

// http://php-rest-api-router/v1/tests/getItem/342156
// http://php-rest-api-router/v1/tests/getAll
// http://php-rest-api-router/v1/tests/someMethod/1,2,3
// http://php-rest-api-router/v1/tests/getItemField/342156,name

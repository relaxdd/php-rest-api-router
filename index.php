<?php
header('Access-Control-Allow-Methods: GET, POST');
header("Content-Type: application/json; charset=UTF-8");

require __DIR__ . '/vendor/autoload.php';

// use Relaxdd\RestApi\Controllers\ProductController;
use Relaxdd\RestApi\Controllers\TestController;
use Relaxdd\RestApi\Request;
use Relaxdd\RestApi\Service;

$request = new Request([
  'GET' => $_GET,
  'POST' => $_POST,
  'FILES' => $_FILES,
  'SERVER' => $_SERVER
]);

$service = new Service($request);
$service->append('tests', TestController::class);
// $service->append("products", ProductController::class);
$service->run();


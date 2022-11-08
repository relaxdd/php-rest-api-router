<?php
// if ($match = is_allowed_domain(null, ["http://localhost:3000"]))
//   header("Access-Control-Allow-Origin: $match");

// Utils
require_once "./utils/functions.php";
// Data
require_once "./data/ControllerDI.php";
// Class
require_once "./class/BaseRouter.php";
// Service
require_once "./service/RouterService.php";
// Interface
require_once "./interface/BaseController.php";
// Controllers
require_once "./controllers/MainController.php";
require_once "./controllers/TestController.php";

if (BaseRouter::parse_url()["version"] !== "v1")
  BaseRouter::router_response("A non-existent version of the rest api is selected", 400);

$router_service = new RouterService();
$router_service->append("tests", new TestController());
$router_service->init_router();

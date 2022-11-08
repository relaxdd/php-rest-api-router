<?php

class RouterService extends BaseRouter {
  /** @var BaseController[] */
  public array $controllers;
  public string $method;
  public array $url_data;
  public array $request_body;

  public function __construct() {
    $this->controllers = array();
    $this->method = $_SERVER['REQUEST_METHOD'];
    $this->url_data = parent::parse_url();
    $this->request_body = $this->get_request_body($this->method);
  }

  public function append(string $slug, BaseController $controller) {
    $request = array_filter(
      $this->request_body,
      fn ($key) => ($key !== "q"),
      ARRAY_FILTER_USE_KEY
    );

    $dependency = new ControllerDI($this->method, $request);
    $controller->inject($dependency);

    $this->controllers[$slug] = $controller;
  }

  public function init_router() {
    $controller = $this->validate_request();

    if ($this->method != "GET")
      parent::router_response("Requests with this method are not supported", 501);
    else {
      $route_data = $this->url_data["data"];
      $res_data = null;

      if (count($route_data) == 0)
        $res_data = $controller->get_all();
      else if (count($route_data) == 1)
        $res_data = $controller->get_item($route_data[0]);
      else if (count($route_data) == 2)
        $res_data = $controller->get_item_field($route_data[0], $route_data[1]);

      parent::router_response(
        "Request completed successfully",
        200,
        array("response" => $res_data)
      );
    }
  }

  private function validate_request(): BaseController {
    $router = $this->url_data["router"];

    if (empty($router)) {
      parent::router_response(
        "Welcome to the RouterService v1, this is the main page of the router, here you can see which controllers are available for use",
        200,
        array("controllers" => array_keys($this->controllers)),
      );
    }

    $controller = $this->controllers[$router];

    if (empty($controller)) {
      parent::router_response(
        "This controller is not registered in the service, to view the available controllers, go to a higher level",
        400
      );
    }

    return $controller;
  }

  private function get_request_body($method): array {
    // GET или POST: данные возвращаем как есть
    if ($method === 'GET') return $_GET;
    if ($method === 'POST') return $_POST;

    // PUT, PATCH или DELETE
    $data = array();
    $exploded = explode('&', file_get_contents('php://input'));

    foreach ($exploded as $pair) {
      $item = explode('=', $pair);
      if (count($item) == 2) {
        $data[urldecode($item[0])] = urldecode($item[1]);
      }
    }

    return $data;
  }
}

<?php

namespace Relaxdd\RestApi;

use JsonException;
use Relaxdd\RestApi\Interfaces\ControllerInterface;

class Service {
  public array $controllers;
  public string $method;
  public array $urlData;

  /**
   * @throws JsonException
   */
  public function __construct(Request $request) {
    if (Utils::parseUrl($request)['version'] !== 'v1') {
      Utils::Response('A non-existent version of the rest api is selected', 400);
    }

    $this->method = $request->server('REQUEST_METHOD');
    $this->urlData = Utils::parseUrl($request);
  }

  public function append(string $slug, string $controller): void {
    $this->controllers[$slug] = new $controller();
  }

  public function run(): void {
    $controller = $this->getController();

    if ($this->method !== 'GET') {
      Utils::Response('Requests with this method are not supported', 501);
    } else {
      $body = $this->urlData['data'];

      if (empty($body))
        $data = $controller->getAll();
      else if (count($body) === 1)
        $data = $controller->getItem($body[0]);
      else if (count($body) === 2)
        $data = $controller->getItemField($body[0], $body[1]);
      else
        $data = null;

      Utils::Response(
        'Request completed successfully',
        200,
        ['response' => $data]
      );
    }
  }

  /**
   * @throws JsonException
   */
  private
  function getController(): ControllerInterface {
    $router = $this->urlData['controller'];

    if (empty($router)) {
      Utils::Response(
        'Welcome to the RouterService v1, this is the main page of the router, here you can see which controllers are available for use',
        200,
        ['controllers' => array_keys($this->controllers)],
      );
    }

    $controller = $this->controllers[$router];

    if (empty($controller)) {
      Utils::Response(
        'This controller is not registered in the service, to view the available controllers, go to a higher level',
        400
      );
    }

    return $controller;
  }
}

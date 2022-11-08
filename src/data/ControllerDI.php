<?php

class ControllerDI {
  public string $method;
  public array $request;

  public function __construct(string $method, array $request) {
    $this->method = $method;
    $this->request = $request;
  }
}

<?php

namespace Relaxdd\RestApi;

// в идеале смотреть реализации PSR
class Request {
  private array $get;
  private array $post;
  private array $files;
  private array $server;

  public function __construct(array $array) {
    $this->get = $array['GET'];
    $this->post = $array['POST'];
    $this->files = $array['FILES'];
    $this->server = $array['SERVER'];
  }

  public function get($value) {
    return $this->get[$value] ?? null;
  }

  public function post($value) {
    return $this->post[$value] ?? null;
  }

  public function server($value) {
    return $this->server[$value] ?? null;
  }

  public function files($value) {
    return $this->files[$value] ?? null;
  }

  public function getQueryString() {
    return $this->server('REQUEST_URI');
  }

  public function getRequestBody($method): array {
    // GET или POST: данные возвращаем как есть
    if ($method === 'GET') {
      return $this->get;
    }
    if ($method === 'POST') {
      return $this->post;
    }

    // TODO: тут сделать по аналогии
    $data = [];
    $exploded = explode('&', file_get_contents('php://input'));

    foreach ($exploded as $pair) {
      $item = explode('=', $pair);
      if (count($item) === 2) {
        $data[urldecode($item[0])] = urldecode($item[1]);
      }
    }

    return $data;
  }
}

<?php

abstract class BaseRouter {
  public static function parse_url() {
    $url = (isset($_GET['q'])) ? $_GET['q'] : '';
    $url = rtrim($url, '/');
    $urls = explode('/', $url);

    $version = $urls[0];
    $router = $urls[1];
    $data = array_slice($urls, 2);

    return array(
      "version" => $version,
      "router"  => $router,
      "data"    => $data,
    );
  }

  public static function router_response(string $message, int $code = 200, $concat = []) {
    $res = array(
      "status"  => $code >= 200 && $code < 300,
      "message" => $message,
    );

    http_response_code($code);
    die(json_encode(array_merge($res, $concat), JSON_UNESCAPED_UNICODE));
  }
}

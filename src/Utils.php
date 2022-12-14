<?php

namespace Relaxdd\RestApi;

use JsonException;

class Utils {
  /**
   * @param callable $callback
   * @param array $array
   * @return array|null
   */
  public static function arrayFind(callable $callback, array $array): ?array {
    foreach ($array as $key => $value) {
      if ($callback($value, $key, $array)) {
        return $value;
      }
    }

    return null;
  }

  /**
   * @param Request $request
   * @return array
   * @throws JsonException
   */
  public static function parseUrl(Request $request): array {
    $query = $request->getQueryString();

    if (!isset($query)) {
      http_response_code('404');
      echo json_encode('Bad request', JSON_THROW_ON_ERROR);
      exit;
    }

    $parts = explode('/', trim($query, '/'));
    $index = array_search("rest", $parts);
    $data = array_slice($parts, $index + 1);
    [$version, $controller] = $data;
    $data = array_slice($data, 2);

    return [
      'version' => $version,
      'controller' => $controller,
      'data' => $data
    ];
  }

  /**
   * @param string $message
   * @param int $code
   * @param array $concat
   * @return void
   * @throws JsonException
   */
  public static function Response(
    string $message,
    int $code = 200,
    array $concat = []
  ): string // Response в идеале PSR
  {
    $res = [
      'status' => $code >= 200 && $code < 300,
      'message' => $message,
    ];

    http_response_code($code);
    echo json_encode(array_merge($res, $concat), JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
    exit;
  }
}

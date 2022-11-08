<?php

namespace Relaxdd\RestApi\Controllers;

use JsonException;
use Relaxdd\RestApi\Interfaces\ControllerInterface;
use Relaxdd\RestApi\Request;
use Relaxdd\RestApi\Utils;

class TestController implements ControllerInterface {
  private array $data;

  public function __construct() {
    $this->data = [
      [
        'id' => '124356',
        'name' => 'Test name 1',
        'price' => '12500',
      ],
      [
        'id' => '906789',
        'name' => 'Test name 2',
        'price' => '15500',
      ],
      [
        'id' => '342156',
        'name' => 'Test name 3',
        'price' => '17500',
      ],
    ];
  }

  public function getAll(): array {
    return $this->data;
  }

  public function getItem(string $id): ?array {
    return Utils::arrayFind(static fn ($item) => ($item['id'] === $id), $this->data);
  }

  public function getItemField(string $id, string $key) {
    $item = Utils::arrayFind(static fn ($item) => ($item['id'] === $id), $this->data);

    return $item[$key];
  }

  /**
   * @throws JsonException
   */
  public function someMethod($a, $b, $c) {
    return json_encode(func_get_args(), JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
  }
}

<?php

/**
 * Пример реализации контроллера
 */

class TestController implements BaseController {
  public function __construct() {
    $this->db = array(
      [
        "id"    => "124356",
        "name"  => "Test name 1",
        "price" => "12500",
      ],
      [
        "id"    => "906789",
        "name"  => "Test name 2",
        "price" => "15500",
      ],
      [
        "id"    => "342156",
        "name"  => "Test name 3",
        "price" => "17500",
      ],
    );
  }

  /* Implements BaseController methods  */

  public function get_all() {
    return $this->db;
  }

  public function get_item(string $id) {
    return array_find(fn ($item) => ($item["id"] == $id), $this->db);
  }

  public function get_item_field(string $id, string $key) {
    $item = array_find(fn ($item) => ($item["id"] == $id), $this->db);
    return $item[$key];
  }

  public function inject(ControllerDI $di) {
  }
}

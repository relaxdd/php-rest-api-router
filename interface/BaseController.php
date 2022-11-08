<?php

interface BaseController {
  public function get_all();
  public function get_item(string $id);
  public function get_item_field(string $id, string $key);
  public function inject(ControllerDI $di);
}

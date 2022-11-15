<?php

namespace Relaxdd\RestApi\Data;

class Product {
  public string $articul;
  public string $id;
  public string $name;
  public string $photo;
  public string $price;
  public string $price_old;
  public string $stock;

  public function __construct(
    string $articul,
    string $id,
    string $name,
    string $photo,
    string $price,
    string $price_old,
    string $stock

  ) {
    $this->articul = $articul;
    $this->id = $id;
    $this->name = $name;
    $this->photo = $photo;
    $this->price = $price;
    $this->price_old = $price_old;
    $this->stock = $stock;
  }
}

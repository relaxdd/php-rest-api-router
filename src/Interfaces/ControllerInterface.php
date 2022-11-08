<?php

namespace Relaxdd\RestApi\Interfaces;

interface ControllerInterface
{
    public function __construct();

    public function getAll();

    public function getItem(string $id);

    public function getItemField(string $id, string $key);
}

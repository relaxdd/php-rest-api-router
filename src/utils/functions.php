<?php

function array_find(callable $callback, array $array) {
  foreach ($array as $key => $value) {
    if ($callback($value, $key, $array)) {
      return $value;
    }
  }

  return null;
}

<?php
  class Arrays {
    public function arraySearch($array, $field, $search) {
      if ($array) {
        foreach($array as $key => $value) {
          if ($value[$field] === $search)
            return $key;
        }
        return false;
      }
    }
  }
?>
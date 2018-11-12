<?php
  class Database {
    private static $bdd = null;

    private function __construct() {}

    public static function getBdd() {
      if (is_null(self::$bdd)) {
        self::$bdd = new PDO("pgsql:host=localhost;port=5432;dbname=photo_gallery;user=postgres;password=ADoORmri");
      }
      return self::$bdd;
    }
  }
?>
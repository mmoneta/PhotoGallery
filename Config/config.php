<?php
  class Config {
    static function getFullHost() {
      $protocole = $_SERVER['REQUEST_SCHEME'].'://';
      $host = $_SERVER['HTTP_HOST'] . '/';
      $project = explode('/', $_SERVER['REQUEST_URI'])[1];
      return $protocole . $host . $project;
    }
  }
?>
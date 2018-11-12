<?php
  class Controller {
    var $vars = [];

    function set($d) {
      $this->vars = array_merge($this->vars, $d);
    }

    function render($filename, $layout = "default") {
      extract($this->vars);
      ob_start();
      require(ROOT . "Views/" . ucfirst(str_replace('Controller', '', get_class($this))) . '/' . $filename . '.php');
      $content_for_layout = ob_get_clean();

      if ($layout == false) {
        $content_for_layout;
      }
      else {
        require(ROOT."Views/Layouts/".$layout.'.php');
      }
    }

    private function secure_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    protected function secure_form($form) {
      foreach ($form as $key => $value) {
        $form[$key] = $this->secure_input($value);
      }
    }
  }
?>
<?php
  class Preview extends Image {
    function __construct($image_url, $rotate_angle, $folder, $file) {
      parent::__construct($folder, $file, $image_url, $rotate_angle);
    }

    function createPreview() {
      echo('<div class="row text-center">');
        echo('<div class="offset-md-3 col-md-6">');
          echo($this->getImage());
        echo('</div>');
      echo('</div>');
    }
  }
?>
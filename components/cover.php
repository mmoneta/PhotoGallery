<?php
  class Cover extends Image {
    function __construct($image_url, $rotate_angle, $folder, $file) {
      parent::__construct($folder, $file, $image_url, $rotate_angle);
    }

    function createCover() {
      echo('<div class="col-md-6 photo photo-item" data-category="'.$this->folder.'">');
        echo('<figure class="figure">');
        echo('<a href="'.Config::getFullHost().'/dashboard/'.$this->folder.'">');
          echo($this->getImage());
        echo('</a>');
        echo('<figcaption class="figure-caption text-right row">');
          echo('<div class="col-md-1 centre"><i class="fa fa-pencil edit-button" aria-hidden="true"></i></div>');
          echo('<div class="col-md-1 centre"><i class="fa fa-trash delete-button" aria-hidden="true"></i></div>');
          echo('<div class="col-md-10 text-center d-block photo-description">'.$this->folder.'</div>');
        echo('</figcaption>');
      echo('</figure>');
      echo('</div>');
    }
  }
?>
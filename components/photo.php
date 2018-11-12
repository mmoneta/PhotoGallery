<?php
  class Photo extends Image {
  	private $photo_id;
    private $description;

    function __construct($photo_id, $image_url, $rotate_angle, $folder, $file, $description) {
      parent::__construct($folder, $file, $image_url, $rotate_angle);

 	  $this->photo_id = $photo_id;
      $this->description = $description;
    }

    function createPhoto() {
      echo('<div class="col-md-6 photo photo-item" data-category="'.$this->folder.'" data-file="'.$this->file.'">');
        echo('<figure class="figure">');
          echo('<a href="'.Config::getFullHost().'/dashboard/'.$this->folder.'/'.$this->photo_id.'">');
            echo($this->getImage());
          echo('</a>');
          echo('<figcaption class="figure-caption text-right row">');
            echo('<div class="col-md-1 centre"><i class="fa fa-pencil edit-button" aria-hidden="true"></i></div>');
            echo('<div class="col-md-6 centre photo-description">'.$this->description.'</div>');
            echo('<div class="col-md-1 centre"><i class="fa fa-floppy-o save-button" aria-hidden="true"></i></div>');
            echo('<div class="col-md-1 centre"><i class="fa fa-undo left-rotate-button" aria-hidden="true"></i></div>');
            echo('<div class="col-md-1 centre"><i class="fa fa-repeat right-rotate-button" aria-hidden="true"></i></div>');
            echo('<div class="col-md-1 centre"><i class="fa fa-trash delete-button" aria-hidden="true"></i></div>');
          echo('</figcaption>');
        echo('</figure>');
      echo('</div>');
    }
  }
?>
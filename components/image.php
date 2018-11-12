<?php
  abstract class Image {
    protected $folder;
    protected $file;
    protected $image_url;
    protected $rotate_angle;
    protected $photoGallery;

    function __construct($folder, $file, $image_url, $rotate_angle) {
      $this->folder = $folder;
      $this->file = $file;
      $this->image_url = $image_url;
      $this->rotate_angle = $rotate_angle;
    }

    function getImage() {
      return '<img src="'.$this->image_url.'" data-angle="'.$this->rotate_angle.'" class="figure-img img-fluid rounded" style="transform: rotate('.$this->rotate_angle.'deg)" alt="Photo">';
    }
  }
?>
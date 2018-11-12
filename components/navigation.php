<?php
  class Navigation {
 	function __construct($index, $files, $photoGallery) {
  	  if ($index > 0 || $index < count($files))
        echo('<div class="row navigation"><nav>');
      if ($index > 0) {
      	$photo_id = $photoGallery-> select_photo_id_by_filename($files[$index - 1]['name']);
		echo('<a href="'.$photo_id.'">Prev</a>');
      }
      if ($index + 1 < count($files)) {
      	$photo_id = $photoGallery-> select_photo_id_by_filename($files[$index + 1]['name']);
        echo('<a href="'.$photo_id.'">Next</a>');
      }
      if ($index > 0 || $index < count($files))
        echo('</nav></div>');
  	}
  }
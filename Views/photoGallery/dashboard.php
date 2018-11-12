<div id="body-content">
  <?php
    require(ROOT.'components/image.php');
    require(ROOT.'components/cover.php');
    require(ROOT.'components/photo.php');
    require(ROOT.'components/preview.php');
    require(ROOT.'components/navigation.php');

    switch ($type) {
      case 'categories':
        echo('<div class="row">');
        foreach ($folders as $folder) {
          foreach ($folder['children'] as $file) {
            $location = Config::getFullHost()."/Webroot/photos/".$_SESSION['username'].'/'.$folder['name'].'/'.$file['name'];
            $data = $photoGallery->select_data_of_photo($_SESSION['username'], $folder['name'], $file['name']);
            $cover = new Cover($location, $data->rotate_angle, $folder['name'], $file['name']);
            $cover->createCover();
            break;
          }
        }
        echo('</div>');
        break;
      case 'files':
        echo('<div class="row">');
        foreach ($files as $file) {
          $location = Config::getFullHost()."/Webroot/photos/".$_SESSION['username'].'/'.$category.'/'.$file['name'];
          $data = $photoGallery->select_data_of_photo($_SESSION['username'], $category, $file['name']);
          $photo = new Photo($data->photo_id, $location, $data->rotate_angle, $category, $file['name'], $data->description);
          $photo->createPhoto();
        }
        echo('</div>');
        break;
      case 'file':
        $navigation = new Navigation($index, $files, $photoGallery);
        $location = Config::getFullHost()."/Webroot/photos/".$_SESSION['username'].'/'.$category.'/'.$file;
        $data = $photoGallery->select_data_of_photo($_SESSION['username'], $category, $file);
        $preview = new Preview($location, $data->rotate_angle, $category, $file);
        $preview->createPreview();
        break;
    }
  ?>
</div>
<?php
  class Filesystem {
    public function getTree($path) {
      if (is_dir($path)) {
        $dir = scandir($path);
        $items = array();
        foreach($dir as $v) {
          // Ignore the current directory and it's parent
          if ($v == '.' || $v == '..')
            continue;
          $item = array();
          // If FILE
          if (!is_dir($path.'/'.$v)) {
            $fileName = basename($v);
            $size = filesize($path.'/'.$v);
            $file = array();
            $file['name'] = $fileName;
            $file['size'] = $size;
            $item = $file;
          } 
          else {
            // If FOLDER, then go inside and repeat the loop
            $folder = array();
            $folder['name'] = basename($v);
            $childs = $this-> getTree($path.'/'.$v);
            $folder['children'] = $childs;
            $item = $folder;
          }
          $items[] = $item;
        }
        return $items;
      }
    }

    public function list_directories($path) {
      $dir = scandir($path);
      $items = array();
      foreach($dir as $v) {
        // Ignore the current directory and it's parent
        if ($v == '.' || $v == '..')
          continue;
        // If FILE
        if (is_dir($path.'/'.$v)) {
          $items[] = $v;
        } 
      }
      return $items;
    }

    public function create_folder($path) {
      if (!file_exists($path)) {
        mkdir($path, 0777, true);
        return true;
      }
      return false;
    }

    public function delete_folder($path) {
      if (!is_dir($path)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
      }
      if (substr($path, strlen($path) - 1, 1) != '/') {
        $path .= '/';
      }

      $files = glob($path . '*', GLOB_MARK);
      foreach ($files as $file) {
        if (is_dir($file)) {
          $this-> deleteDir($file);
        }
        else {
          unlink($file);
        }
      }
      rmdir($path);
    }

    public function delete_file($path) {
      unlink($path);
    }

    public function save_photo($file, $path, $photoGallery, $category, $description) {
      $allowedExts = array("jpeg", "jpg", "png");
      $temp = explode(".", $file["name"]);
      $extension = end($temp);
      if ((($file["type"] == "image/jpeg") || ($file["type"] == "image/jpg") || ($file["type"] == "image/png")) && in_array($extension, $allowedExts)) {
        if ($file["error"] > 0) {
          echo "Return Code: ".$file["error"]."<br>";
        }
        else {
          $username = $_SESSION['username'];
          $filename = $file["name"];

          if (file_exists($path.'/'.$filename)) {
            echo ($filename." already exists.");
          } 
          else {
            move_uploaded_file($file["tmp_name"], $path.'/'.$filename);
            $photoGallery-> insert_photo($username, $category, $filename, $description);
            echo('Photo has been uploaded.');
          }
        }
      }
      else {
        echo "Invalid file";
      }
    }

    public function edit_name($path, $old_name, $new_name) {
      rename($path.'/'.$old_name, $path.'/'.$new_name);
    }
  }
?>
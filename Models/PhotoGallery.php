<?php
  class PhotoGallery extends Model {
    public function select_user_by_username($username) {
      $sql = 'SELECT * FROM users WHERE username = :username';
      $req = Database::getBdd()->prepare($sql);
      $req-> bindValue(':username', $username);
      $req-> execute();
      return $req-> fetchObject();
    }

    protected function select_user_id_by_name($username) {
      $sql = 'SELECT user_id FROM users WHERE username = :username';
      $req = Database::getBdd()->prepare($sql);
      $req-> bindValue(':username', $username);
      $req-> execute();
      return $req-> fetchObject()-> user_id;
    }

    public function insert_user($data) {
      $sql = 'INSERT INTO users(username, password, email) VALUES (:username,:password,:email)';
      $req = Database::getBdd()->prepare($sql);
      $req->execute($data);
    }

    public function update_password($data) {
      $sql = 'UPDATE users SET password = :password WHERE username = :username';
      $req = Database::getBdd()->prepare($sql);
      $req->execute($data);
    }

    protected function select_category_id_by_name($name) {
      $sql = 'SELECT category_id FROM categories WHERE name = :name';
      $req = Database::getBdd()->prepare($sql);
      $req-> bindValue(':name', $name);
      $req-> execute();
      return $req-> fetchObject()-> category_id;
    }

    public function insert_category($name) {
      if (!$this-> select_category_id_by_name($name)) {
        $sql = 'INSERT INTO categories(name) VALUES (:name)';
        $req = Database::getBdd()->prepare($sql);
        $req-> bindValue(':name', $name);
        $req-> execute();
      }
    }

    public function insert_photo($username, $category, $filename, $description) {
      if (!$description)
        $description = '';
      
      $data = [
        'user_id' => $this-> select_user_id_by_name($username),
        'category_id' => $this-> select_category_id_by_name($category),
        'rotate_angle' => 0,
        'description' => $description,
        'name' => $filename
      ];
      
      $sql = 'INSERT INTO photos(user_id, category_id, rotate_angle, description, name) VALUES (:user_id, :category_id, :rotate_angle, :description, :name)';
      $req = Database::getBdd()->prepare($sql);
      $req->execute($data);
    }

    public function select_data_of_photo($username, $category, $filename) {
      $sql = 'SELECT photos.photo_id, photos.description, photos.rotate_angle FROM photos INNER JOIN users ON photos.user_id = users.user_id INNER JOIN categories ON photos.category_id = categories.category_id WHERE users.username = :username AND categories.name = :category AND photos.name = :filename';
      $req = Database::getBdd()->prepare($sql);
      $req-> bindValue(':username', $username);
      $req-> bindValue(':category', $category);
      $req-> bindValue(':filename', $filename);
      $req-> execute();
      return $req-> fetchObject();
    }

    public function select_filename_by_photo_id($photo_id) {
      $sql = 'SELECT name FROM photos WHERE photo_id = :photo_id';
      $req = Database::getBdd()->prepare($sql);
      $req-> bindValue(':photo_id', $photo_id);
      $req-> execute();
      return $req-> fetchObject()-> name;
    }

    public function select_photo_id_by_filename($filename) {
      $sql = 'SELECT photo_id FROM photos WHERE name = :filename';
      $req = Database::getBdd()->prepare($sql);
      $req-> bindValue(':filename', $filename);
      $req-> execute();
      return $req-> fetchObject()-> photo_id;
    }
  }
?>
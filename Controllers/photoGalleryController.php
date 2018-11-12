<?php
  class photoGalleryController extends Controller {
    function __construct() {
      session_start();
      if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        // last request was more than 30 minutes ago
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage
      }
      $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
      if (!isset($_COOKIE['language'])) {
        setcookie('language', 'en', time() + (10 * 365 * 24 * 60 * 60),"/",false);
      }
    }

    function index() {
      if (!isset($_SESSION['username']))
        header("Location: ".Config::getFullHost()."/login");
      else
        header("Location: ".Config::getFullHost()."/dashboard");
    }

    function login() {
      require(ROOT.'Languages/'.$_COOKIE['language'].'/lang.'.$_COOKIE['language'].'.php');
      if (isset($_SESSION['username']))
        header("Location: dashboard");
      else {
        $d['lang'] = $lang;
        $this->set($d);
        $this->render("login");
      }
    }

    function register() {
      require(ROOT.'Languages/'.$_COOKIE['language'].'/lang.'.$_COOKIE['language'].'.php');
      if (isset($_SESSION['username']))
        header("Location: ".Config::getFullHost()."/dashboard");
      else {
        $d['lang'] = $lang;
        $this->set($d);
        $this->render("register");
      }
    }

    function create($type) {
      require(ROOT.'Languages/'.$_COOKIE['language'].'/lang.'.$_COOKIE['language'].'.php');
      if (!isset($_SESSION['username']))
        header("Location: ".Config::getFullHost()."/login");
      else {
        switch ($type) {
          case 'category':
            $d['lang'] = $lang;
            $this->set($d);
            $this->render("create_category", "navigation");
            break;
        }
      }
    }

    function upload($type) {
      require(ROOT.'Languages/'.$_COOKIE['language'].'/lang.'.$_COOKIE['language'].'.php');
      if (!isset($_SESSION['username']))
        header("Location: ".Config::getFullHost()."/login");
      else {
        require(ROOT.'Models/Filesystem.php');
        $filesystem = new Filesystem();

        switch ($type) {
          case 'photo':
            $path = "photos/".$_SESSION['username'];
            $directories = $filesystem-> list_directories($path);
            $d['directories'] = $directories;
            $d['lang'] = $lang;
            $this->set($d);
            $this->render("upload_photo", "navigation");
            break;
        }
      }
    }

    function recovery() {
      require(ROOT.'Languages/'.$_COOKIE['language'].'/lang.'.$_COOKIE['language'].'.php');
      $d['lang'] = $lang;
      $this->set($d);
      $this->render("recovery");
    }

    function dashboard($category = null, $photo_id = null) {
      if (!isset($_SESSION['username']))
        header("Location: ".Config::getFullHost()."/login");
      else {
        require(ROOT.'Models/PhotoGallery.php');
        require(ROOT.'Models/Filesystem.php');
        require(ROOT.'Languages/'.$_COOKIE['language'].'/lang.'.$_COOKIE['language'].'.php');

        $photoGallery = new PhotoGallery();
        $filesystem = new Filesystem();

        if (!$category && !$photo_id) {
          $path = ROOT."Webroot/photos/".$_SESSION['username'];
          $folders = $filesystem-> getTree($path);
          $d['type'] = 'categories';
          $d['folders'] = $folders;
        }
        else if ($category && !$photo_id) {
          $path = ROOT."Webroot/photos/".$_SESSION['username'].'/'.$category;
          $files = $filesystem-> getTree($path);
          $d['type'] = 'files';
          $d['category'] = $category;
          $d['files'] = $files;
        }
        else {
          require(ROOT.'Models/array.php');

          $array = new Arrays();

          $filename = $photoGallery-> select_filename_by_photo_id($photo_id);

          $path = ROOT."Webroot/photos/".$_SESSION['username'].'/'.$category;
          $files = $filesystem-> getTree($path);

          $index = $array-> arraySearch($files, "name", $filename);

          $d['type'] = 'file';
          $d['category'] = $category;
          $d['files'] = $files;
          $d['index'] = $index;
          $d['file'] = $filename;
        }
        $d['photoGallery'] = $photoGallery;
        $d['lang'] = $lang;
        $this->set($d);
        $this->render("dashboard", "navigation");
      }
    }

    function logout() {
      session_unset();
      session_destroy();
      header("Location: ".Config::getFullHost()."/login");
    }

    function API($action) {
      require(ROOT.'Models/PhotoGallery.php');
      require(ROOT.'Models/Filesystem.php');
      require(ROOT.'Models/Mail.php');
      $photoGallery = new PhotoGallery();
      $filesystem = new Filesystem();

      switch ($action) {
        case 'login':
          $user = $photoGallery-> select_user_by_username($_POST['username']);
          if ($user) {
            $auth = password_verify($_POST['password'], $user->password);
            if ($auth) {
              $_SESSION['username'] = $_POST['username'];
              $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            }
            else
              echo("Invalid password");
          }
          else
           echo("User hasn't been registered!");
          break;
        case 'register':
          if ($photoGallery-> select_user_by_username($_POST['username']))
            echo('Username is busy.');
          else {
            $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $data = [
              'username' => $_POST['username'],
              'password' => $hash,
              'email' => $_POST['email']
            ];
            $photoGallery-> insert_user($data); 
            $path = 'photos/'.$_POST['username'];
            $filesystem-> create_folder($path);
          }
          break;
        case 'change_password':
          $headers = apache_request_headers();
          if ($headers['CSRF-Token'] === $_SESSION['csrf_token']) {
            $hash = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
            $data = [
              'username' => $_SESSION['username'],
              'password' => $hash
            ];
            $photoGallery-> update_password($data);
          }
          break;
        case 'create_category':
          $headers = apache_request_headers();
          if ($headers['CSRF-Token'] === $_SESSION['csrf_token']) {
            $path = 'photos/'.$_SESSION['username'].'/'.$_POST['category'];
            if ($filesystem-> create_folder($path)) {
              $photoGallery-> insert_category($_POST['category']);
              echo('Category has been created.');
            }
            else
              echo('Category exist.');
          }
          break;
        case 'upload_photo':
          $headers = apache_request_headers();
          if ($headers['CSRF-Token'] === $_SESSION['csrf_token']) {
            $path = 'photos/'.$_SESSION['username'].'/'.$_POST['category'];
            $filesystem-> save_photo($_FILES["file"], $path, $photoGallery, $_POST['category'], $_POST['description']);
          }
          break;
        case 'edit':
          $headers = apache_request_headers();
          if ($headers['CSRF-Token'] === $_SESSION['csrf_token']) {
            $path = 'photos/'.$_SESSION['username'];
            $filesystem-> edit_name($path, $_POST['old_name'], $_POST['new_name']);
          }
          break;
        case 'remove':
          $headers = apache_request_headers();
          if ($headers['CSRF-Token'] === $_SESSION['csrf_token']) {
            switch ($_POST['type']) {
              case 'folder':
                $path = 'photos/'.$_SESSION['username'].'/'.$_POST['category'];
                //$this-> delete_category($_SESSION['username'], $name);
                $filesystem-> delete_folder($path);
                break;
              case 'file':
                $path = 'photos/'.$_SESSION['username'].'/'.$_POST['category'].'/'.$_POST['name'];
                $filesystem-> delete_file($path);
                break;
            }
          }
          break;
        case 'recovery':
          $email = $photoGallery-> select_user_by_username($_POST['username'])-> email;
          $mail = new Mail();
          $mail->adress($email);
          $mail->subject('Recovery password');
          $mail->message();
          $mail->send();
          break;
        case 'change_language':
          if (isset($_COOKIE['language'])) {
            if ($_COOKIE['language'] === $_POST['language'])
              echo("Language hasn't been changed.");
            else
              setcookie('language', $_POST['language'],time() + (10 * 365 * 24 * 60 * 60),"/",false);
          }
          else
            setcookie('language', $_POST['language'],time() + (10 * 365 * 24 * 60 * 60),"/",false);
          break;
        case 'rotate':
          $headers = apache_request_headers();
          if ($headers['CSRF-Token'] === $_SESSION['csrf_token']) {
            
          }
          break;
      }
    }
  }
?>
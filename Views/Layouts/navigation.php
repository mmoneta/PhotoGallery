<html>
  <head>
      <title><?= $lang['app_title'] ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta charset="utf-8" />
      <meta name="csrf-token" content="<?= $_SESSION['csrf_token'] ?>">
      <link rel="icon" href="<?= Config::getFullHost(); ?>/assets/images/favicon.ico" type="image/ico">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="<?= Config::getFullHost(); ?>/assets/css/style.css">
      <script type="text/javascript" src="<?= Config::getFullHost(); ?>/assets/js/dist/forms/index.js" defer></script>
      <script type="text/javascript" src="<?= Config::getFullHost(); ?>/assets/js/dist/forms/validation.js" defer></script>
      <script type="text/javascript" src="<?= Config::getFullHost(); ?>/assets/js/dist/photos/operations.js" defer></script>
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous" defer></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" defer></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous" defer></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 15px;">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarToggler">
        <a class="navbar-brand" href="<?= Config::getFullHost(); ?>"><?= $lang['app_title'] ?></a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?= $lang['manage'] ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"  style="min-width: 250px;">
              <a class="nav-link" href="<?= Config::getFullHost(); ?>/create/category"><?= $lang['create_category'] ?> <span class="sr-only">(current)</span></a>
              <a class="nav-link" href="<?= Config::getFullHost(); ?>/upload/photo"><?= $lang['upload_photo'] ?> <span class="sr-only">(current)</span></a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?= $lang['settings'] ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a href="" class="nav-link" data-toggle="modal" data-target="#modalChangePasswordForm"><?= $lang['change_password'] ?></a>
              <a href="" class="nav-link" data-toggle="modal" data-target="#modalChangeLanguageForm"><?= $lang['change_language'] ?></a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?= $_SESSION['username'] ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="nav-link" href="<?= Config::getFullHost(); ?>/logout"><?= $lang['logout'] ?> <span class="sr-only">(current)</span></a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <?= $content_for_layout ?>
    </div>
    <div class="modal fade" id="modalChangePasswordForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold" style="color: black;"><?= $lang['change_password'] ?></h4>
          </div>
          <div class="modal-body mx-3">
            <div class="md-form mb-5">
              <i class="fa fa-envelope prefix grey-text"></i>
              <label data-error="wrong" data-success="right" for="changePasswordForm-pass" style="color: black;"><?= $lang['password'] ?></label>
              <input type="password" id="changePasswordForm-pass" class="form-control validate" style="border: 1px solid black; color: black;">
            </div>
            <div class="md-form mb-4">
              <i class="fa fa-lock prefix grey-text"></i>
              <label data-error="wrong" data-success="right" for="changePasswordForm-repeat-pass" style="color: black;"><?= $lang['repeat_password'] ?></label>
              <input type="password" id="changePasswordForm-repeat-pass" class="form-control validate" style="border: 1px solid black; color: black;">
            </div>
          </div>
          <div class="modal-footer d-flex justify-content-center">
            <button class="btn btn-primary" onclick="return send('change_password');"><?= $lang['save_change'] ?></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $lang['close'] ?></button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modalChangeLanguageForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold" style="color: black;"><?= $lang['change_language'] ?></h4>
          </div>
          <div class="modal-body mx-3">
            <div class="md-form mb-5">
              <select class="form-control" id="select-language" style="border: 1px solid black; color: black;">
                <option name="en">English</option>
                <option name="pl">Polski</option>
              </select>
          </div>
          <div class="modal-footer d-flex justify-content-center">
            <button class="btn btn-primary" onclick="return send('change_language');"><?= $lang['save_change'] ?></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $lang['close'] ?></button>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
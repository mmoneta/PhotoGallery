<div class="row text-center d-block title">
  <h3><?= $lang['register_title'] ?></h3>
</div>
<div class="row">
  <div class="offset-md-3 col-md-6 col-xs-12">
    <form id="register-form" onsubmit="return send('register');">
      <div class="form-group">
        <input type="text" pattern=".{0}|.{5,20}" class="form-control" name="username" placeholder="<?= $lang['enter_username'] ?>" required />
      </div>
      <div class="form-group">
        <input type="password" pattern=".{0}|.{8,}" class="form-control" name="password" placeholder="<?= $lang['enter_password'] ?>" required />
      </div>
      <div class="form-group">
        <input type="password" pattern=".{0}|.{8,}" class="form-control" name="repeat-password" placeholder="<?= $lang['repeat_password'] ?>" required />
      </div>
      <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="<?= $lang['enter_email'] ?>" required />
      </div>
      <div class="form-group text-center">
        <button type="submit" class="btn btn-primary mb-2"><?= $lang['register_button'] ?></button>
      </div>
    </form>
  </div>
</div>
<div class="row">
  <div class="offset-md-3 col-md-6 col-xs-12 text-center d-block">
    <p><?= $lang['account'] ?><a href="<?= Config::getFullHost(); ?>/login"><?= $lang['login'] ?></a></p>
  </div>
</div>
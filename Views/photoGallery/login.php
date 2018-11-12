<div class="row text-center d-block title">
  <h3><?= $lang['login_title']; ?></h3>
</div>
<div class="row">
  <div class="offset-md-3 col-md-6 col-xs-12">
    <form id="login-form"  onsubmit="return send('login');">
      <div class="form-group">
        <input type="text" pattern=".{0}|.{5,20}" class="form-control" name="username" placeholder="<?= $lang['enter_username']; ?>" required />
      </div>
      <div class="form-group">
        <input type="password" pattern=".{0}|.{8,}" class="form-control" name="password" placeholder="<?= $lang['enter_password']; ?>" required />
      </div>
      <div class="form-group text-center">
        <button type="submit" class="btn btn-primary mb-2"><?= $lang['login_button']; ?></button>
      </div>
    </form>
  </div>
</div>
<div class="row">
  <div class="offset-md-3 col-md-6 col-xs-12 text-center d-block">
    <ul class="list-unstyled">
      <li><?= $lang['no_account']; ?><a href="<?php echo Config::getFullHost(); ?>/register"><?= $lang['register']; ?></a></li>
      <li><?= $lang['forgotten_password']; ?><a href="<?php echo Config::getFullHost(); ?>/recovery"><?= $lang['recover_account']; ?></a></li>
    </ul>
  </div>
</div>
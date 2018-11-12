<div class="row text-center d-block title">
  <h3><?= $lang['recovery_account_title']; ?></h3>
</div>
<div class="row">
  <div class="offset-md-3 col-md-6 col-xs-12">
    <form id="recovery-form"  onsubmit="return send('recovery');">
      <div class="form-group">
        <input type="text" pattern=".{0}|.{5,20}" class="form-control" name="username" placeholder="<?= $lang['enter_username']; ?>" required />
      </div>
      <div class="form-group text-center">
        <button type="submit" class="btn btn-primary mb-2"><?= $lang['send']; ?></button>
      </div>
    </form>
  </div>
</div>
<div class="row">
  <div class="offset-md-3 col-md-6 col-xs-12 text-center d-block">
    <ul class="list-unstyled">
      <li><?= $lang['reminded_password']; ?><a href="<?php echo Config::getFullHost(); ?>/login"><?= $lang['login']; ?></a></li>
    </ul>
  </div>
</div>
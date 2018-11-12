<div class="row text-center d-block title">
  <h3><?= $lang['create_category_title'] ?></h3>
</div>
<div class="row">
  <div class="offset-md-3 col-md-6 col-xs-12">
    <form id="category-form" onsubmit="return send('create_category');">
      <div class="form-group">
        <label><?= $lang['new_category_name'] ?></label>
        <input type="text" class="form-control" id="category" name="category" required />
      </div>
      <div class="form-group text-center">
        <button type="submit" class="btn btn-primary mb-2"><?= $lang['create'] ?></button>
      </div>
    </form>
  </div>
</div>
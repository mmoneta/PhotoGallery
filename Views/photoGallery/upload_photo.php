<div class="row text-center d-block title">
  <h3><?= $lang['upload_title'] ?></h3>
</div>
<div class="row">
  <div class="offset-md-3 col-md-6 col-xs-12">
    <form id="upload-form" onsubmit="return send('upload_photo');">
      <div class="form-group">
        <label><?= $lang['category'] ?></label>
        <select class="form-control" id="select-category" name="category" required>
          <?php 
            foreach ($directories as $directory) {
              echo('<option>'.$directory.'</option>');
            }
          ?>
        </select>
      </div>
      <div class="form-group">
        <input type="file" class="form-control" id="file" name="file" required />
      </div>
      <div class="form-group">
        <label for="descriptiom"><?= $lang['description'] ?></label>
        <textarea class="form-control" id="description" name="description" rows="2"></textarea>
      </div>
      <div class="form-group text-center">
        <button type="submit" class="btn btn-primary mb-2"><?= $lang['upload_button'] ?></button>
      </div>
    </form>
  </div>
</div>

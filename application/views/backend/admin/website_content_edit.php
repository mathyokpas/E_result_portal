<div class="row">
  <div class="col-md-8">
    <h3>Edit Section: <?= esc($section['slug']) ?></h3>
    <?php if($this->session->flashdata('flash_message')):?>
      <div class="alert alert-success"><?= $this->session->flashdata('flash_message') ?></div>
    <?php endif;?>
    <form method="post" action="<?= base_url('index.php?admin/website_content/edit_section/'.$section['id']) ?>" enctype="multipart/form-data">
      <div class="form-group">
        <label>Title</label>
        <input class="form-control" name="title" value="<?= esc($section['title']) ?>">
      </div>
      <div class="form-group">
        <label>Content (HTML allowed)</label>
        <textarea class="form-control" name="content" rows="8"><?= esc($section['content']) ?></textarea>
      </div>

      <div class="form-group">
        <label>Image (optional)</label>
        <?php if(!empty($section['image'])): ?>
          <div><img src="<?= base_url('uploads/website/'.$section['image']) ?>" style="max-width:200px"></div>
        <?php endif;?>
        <input type="file" name="image" accept="image/*" class="form-control-file mt-2">
      </div>

      <button class="btn btn-primary">Save</button>
    </form>
  </div>
</div>

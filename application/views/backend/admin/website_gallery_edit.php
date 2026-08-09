<div class="row">
  <div class="col-md-8">
    <h3>Edit Gallery Image</h3>
    <?php if($this->session->flashdata('flash_message')):?>
      <div class="alert alert-success"><?= $this->session->flashdata('flash_message') ?></div>
    <?php endif;?>
    <form method="post" action="<?= base_url('index.php?admin/website_content/gallery_edit/'.$item['id']) ?>" enctype="multipart/form-data">
      <div class="form-group">
        <label>Title</label>
        <input class="form-control" name="title" value="<?= esc($item['title']) ?>">
      </div>
      <div class="form-group">
        <label>Caption</label>
        <textarea class="form-control" name="caption" rows="4"><?= esc($item['caption']) ?></textarea>
      </div>
      <div class="form-group">
        <label>Display Order</label>
        <input class="form-control" name="display_order" type="number" value="<?= $item['display_order'] ?>">
      </div>
      <div class="form-group">
        <label>Image</label>
        <div><img src="<?= base_url('uploads/website/'.$item['image']) ?>" style="max-width:200px"></div>
        <input type="file" name="image" accept="image/*" class="form-control-file mt-2">
      </div>
      <button class="btn btn-primary">Save</button>
    </form>
  </div>
</div>

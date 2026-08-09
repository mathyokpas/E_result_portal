<div class="row">
  <div class="col-md-12">
    <h3>Gallery <a class="btn btn-sm btn-success float-right" href="<?= base_url('index.php?admin/website_content/gallery_add') ?>">Add Image</a></h3>
    <?php if($this->session->flashdata('flash_message')):?>
      <div class="alert alert-success"><?= $this->session->flashdata('flash_message') ?></div>
    <?php endif;?>
    <table class="table table-hover">
      <thead><tr><th>#</th><th>Thumb</th><th>Title</th><th>Caption</th><th>Order</th><th>Actions</th></tr></thead>
      <tbody>
      <?php foreach($gallery as $g): ?>
        <tr>
          <td><?= $g['id'] ?></td>
          <td><img src="<?= base_url('uploads/website/'.$g['image']) ?>" height="50"></td>
          <td><?= $g['title'] ?></td>
          <td><?= substr(strip_tags($g['caption']),0,80) ?></td>
          <td><?= $g['display_order'] ?></td>
          <td>
            <a class="btn btn-sm btn-primary" href="<?= base_url('index.php?admin/website_content/gallery_edit/'.$g['id']) ?>">Edit</a>
            <a class="btn btn-sm btn-danger" href="<?= base_url('index.php?admin/website_content/gallery_delete/'.$g['id']) ?>" onclick="return confirm('Delete this image?')">Delete</a>
          </td>
        </tr>
      <?php endforeach;?>
      </tbody>
    </table>
  </div>
</div>

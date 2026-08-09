<div class="row">
  <div class="col-md-12">
    <h3>Website Sections <a class="btn btn-sm btn-success float-right" href="<?= base_url('index.php?admin/website_content/add_section') ?>">Add Section</a></h3>
    <?php if($this->session->flashdata('flash_message')):?>
      <div class="alert alert-success"><?= $this->session->flashdata('flash_message') ?></div>
    <?php endif;?>
    <table class="table table-striped">
      <thead><tr><th>ID</th><th>Slug</th><th>Title</th><th>Image</th><th>Actions</th></tr></thead>
      <tbody>
        <?php foreach($sections as $s): ?>
        <tr>
          <td><?= $s['id'] ?></td>
          <td><?= $s['slug'] ?></td>
          <td><?= $s['title'] ?></td>
          <td>
            <?php if(!empty($s['image'])): ?>
              <img src="<?= base_url('uploads/website/'.$s['image']) ?>" height="40">
            <?php endif;?>
          </td>
          <td>
            <a class="btn btn-sm btn-primary" href="<?= base_url('index.php?admin/website_content/edit_section/'.$s['id']) ?>">Edit</a>
            <a class="btn btn-sm btn-danger" href="<?= base_url('index.php?admin/website_content/delete_section/'.$s['id']) ?>" onclick="return confirm('Delete?')">Delete</a>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>

    <hr>
    <h4>Gallery</h4>
    <a class="btn btn-sm btn-info" href="<?= base_url('index.php?admin/website_content/gallery') ?>">Manage Gallery</a>
  </div>
</div>

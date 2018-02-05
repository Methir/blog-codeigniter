      <?php if($formErrors): ?>
    <div class="alert alert-danger">
      <?= $formErrors ?>
    </div>
      <?php else:

        if($this->session->flashdata('success_msg')) : ?>
      <div class="alert alert-success">
        <?=$this->session->flashdata('success_msg')?>
      </div>
      <?php endif; endif; ?>
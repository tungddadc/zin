<?php if (!empty($oneItem)):
  $url = getUrlPage($oneItem);
  ?>
  <!-- Main Container -->
  <section class="main-container col2-left-layout">
    <div class="container">
      <div class="main-faq">
        <div class="row">
          <div class="col-md-9">
            <?php echo $this->load->view($this->template_path.'faq/top'); ?>
          </div>
          <div class="col-md-3">

          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Main Container End -->
<?php endif; ?>
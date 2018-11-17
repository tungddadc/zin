<!-- Main Container -->
<section class="main-container col2-left-layout">
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-sm-push-3">
        <article class="col-main">
          <?php if(!empty($main_profile)) echo $main_profile; ?>
        </article>
        <!--	///*///======    End article  ========= //*/// -->
      </div>
      <?php $this->load->view($this->template_path.'auth/profile/sidebar'); ?>
    </div>
  </div>
</section>
<!-- Main Container End -->
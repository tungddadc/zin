<?php if(!empty($category)): ?>
<section class="main-container col2-left-layout">
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-sm-push-3">
        <article class="col-main" id="content_ajax">
          <div class="page-title">
            <h1 style="display: none"><?php echo $category->title ?></h1>
          </div>
          <div class="blog-wrapper" id="main">
            <div class="site-content" id="primary">
              <div id="content" role="main" class="content-cat">
                <?php $this->load->view($this->template_path . 'news/list-item') ?>
                <?php if (!empty($pagination)): ?>
                  <div class="pages text-center">
                    <?php echo $pagination ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </article>
        <!--	///*///======    End article  ========= //*/// -->
      </div>
      <?php $this->load->view($this->template_path . 'news/sidebar') ?>
    </div>
  </div>
</section>
<?php endif; ?>
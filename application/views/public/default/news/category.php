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
                <?php
                if (!empty($data)) foreach ($data as $item) {
                  ?>
                  <article class="blog_entry clearfix wow bounceInUp animated" id="post-<?php echo $item->id ?>">
                    <div class="entry-content row">
                      <div class="col-md-4">
                        <div class="featured-thumb ">
                          <a href="<?php echo getUrlNews($item) ?>" title="<?php echo getTitle($item) ?>">
                            <img alt="blog-img3" src="<?php echo getImageThumb($item->thumbnail,850,395,true) ?>"
                                 alt="<?php echo getTitle($item) ?>">
                          </a>
                        </div>

                      </div>
                      <div class="col-md-8">
                          <header class="blog_entry-header clearfix">
                            <div class="blog_entry-header-inner">
                              <h2 class="blog_entry-title">
                                <a href="<?php echo getUrlNews($item) ?>" itle="<?php echo getTitle($item) ?>" rel="bookmark">
                                  <?php echo $item->title ?>
                                </a></h2>
                            </div>
                            <!--blog_entry-header-inner-->
                          </header>
                          <div class="entry-content">
                            <ul class="post-meta">
                              <li><i class="fa fa-user"></i>Cập nhât bởi <a href="#">admin</a></li>
                              <li><i
                                    class="fa fa-clock-o"></i><?php echo date('d/m/Y', strtotime($item->created_time)) ?></span>
                              </li>
                            </ul>
                            <p>
                              <?php echo $item->description; ?>
                            </p>
                          </div>
                          <p><a class="btn" href="<?php echo getUrlNews($item) ?>">Xem tiếp</a></p>
                      </div>
                    </div>
                  </article>
                  <?php
                }
                ?>
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
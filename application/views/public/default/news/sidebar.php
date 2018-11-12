<aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
  <div class="side-banner"><img alt="banner" src="<?php echo $this->templates_assets ?>images/side-banner.jpg"></div>
  <div class="widget_wrapper13" id="secondary" role="complementary">
    <div class="popular-posts widget widget__sidebar wow bounceInUp animated" id="recent-posts-4">
      <h3 class="widget-title"><span>Most Popular Post</span></h3>
      <div class="widget-content">
        <ul class="posts-list unstyled clearfix">
          <?php
          $list_post = getPostNews();
          if (!empty($list_post)) foreach ($list_post as $item):
            ?>
            <li>
              <figure class="featured-thumb">
                <a href="<?php getUrlNews($item) ?>" title="<?php echo getTitle($item) ?>">
                  <img width="80" height="53" alt="blog image"
                       src="<?php echo getImageThumb($item->thumbnail, 80, 53, true) ?>">
                </a>
              </figure>
              <!--featured-thumb-->
              <h4>
                <a <a href="<?php getUrlNews($item) ?>"
                      title="<?php echo getTitle($item) ?>"><?php echo $item->title ?></a>
              </h4>
              <p class="post-meta"><i class="icon-calendar"></i>
                <time class="entry-date" datetime="2014-07-10T07:09:31+00:00"><?php echo date('d/m/Y') ?></time>
              </p>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <!--widget-content-->
    </div>
    <div class="popular-posts widget widget_categories wow bounceInUp animated" id="categories-2">
      <h3 class="widget-title"><span>Danh mục tin tức</span></h3>
      <ul>
        <?php
        $cats = getCategoryByType(0, 'post');
        if (!empty($cats)) foreach ($cats as $item) {
          ?>
          <li class="cat-item cat-item-19599"><a
              href="<?php echo getUrlCateNews($item) ?>"><?php echo $item->title; ?></a></li>
          <?php
        }
        ?>

      </ul>
    </div>
    <!-- Banner Ad Block -->
  </div>
</aside>
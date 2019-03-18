<aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
  <div class="side-banner">
      <?php $bannerSidebarTop = listBannerByPosition(2);if(!empty($bannerSidebarTop)) foreach ($bannerSidebarTop as $item): ?>
          <a href="<?php echo $item->url ?>" title="banner sidebar" rel="nofollow">
              <img src="<?php echo getImageThumb($item->thumbnail,265,425,false,false) ?>" alt="banner sidebar">
          </a>
      <?php endforeach; ?>
  </div>
  <div class="widget_wrapper13" id="secondary" role="complementary">
    <div class="popular-posts widget widget__sidebar wow bounceInUp animated" id="recent-posts-4">
      <h3 class="widget-title"><span>Tin nổi bật</span></h3>
      <div class="widget-content">
        <ul class="posts-list unstyled clearfix">
          <?php
          $list_post = getPostNews();
          if (!empty($list_post)) foreach ($list_post as $item):
            ?>
            <li>
              <figure class="featured-thumb">
                <a href="<?php echo getUrlNews($item) ?>" title="<?php echo getTitle($item) ?>">
                  <img width="80" height="53" alt="<?php echo getTitle($item) ?>"
                       src="<?php echo getImageThumb($item->thumbnail, 80, 53, true) ?>">
                </a>
              </figure>
              <!--featured-thumb-->
              <h4>
                <a <a href="<?php echo getUrlNews($item) ?>"
                      title="<?php echo getTitle($item) ?>"><?php echo $item->title ?></a>
              </h4>
              <p class="post-meta"><i class="icon-calendar"></i>
                <time class="entry-date" datetime="<?php echo timeAgo($item->created_time,"c") ?>"><?php echo date('d/m/Y') ?></time>
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
          <li class="cat-item cat-item-19599"><a title="<?php echo getTitle($item) ?>"
              href="<?php echo getUrlCateNews($item) ?>"><?php echo $item->title; ?></a></li>
          <?php
        }
        ?>

      </ul>
    </div>
    <!-- Banner Ad Block -->
  </div>
</aside>
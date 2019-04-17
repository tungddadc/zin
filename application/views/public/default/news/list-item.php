<?php
if (!empty($data)) foreach ($data as $item) {
  $oneCat = getCategoryByPost($item->id);
  ?>
  <article class="blog_entry clearfix wow bounceInUp animated" id="post-<?php echo $item->id ?>">
    <div class="entry-content row">
      <div class="col-md-4">
        <div class="featured-thumb ">
          <a href="<?php echo getUrlNews($item) ?>" title="<?php echo getTitle($item) ?>">
            <img alt="blog-img3" src="<?php echo getImageThumb($item->thumbnail, 850, 395, true) ?>"
                 alt="<?php echo getTitle($item) ?>">
          </a>
        </div>

      </div>
      <div class="col-md-8">
        <header class="blog_entry-header clearfix">
          <div class="blog_entry-header-inner">
            <h2 class="blog_entry-title">
              <a href="<?php echo getUrlNews($item) ?>" itle="<?php echo getTitle($item) ?>"
                 rel="bookmark">
                <?php echo $item->title ?>
              </a></h2>
          </div>
          <!--blog_entry-header-inner-->
        </header>
        <div class="entry-content">
          <p>
            <?php echo $item->description; ?>
          </p>
          <ul class="post-meta">
            <li>
              <i class="fa fa-clock-o"></i><?php echo date('d/m/Y', strtotime($item->created_time)) ?></span>
            </li>
            <li>
              <?php
              if (!empty($oneCat)) {
                echo '<a href="' . getUrlCateNews($oneCat) . '"><i class="fa fa-circle" style="font-size: 8px; float: left; margin-top: 5px; padding-right: 5px;" aria-hidden="true"></i> ' . $oneCat->title . '</a>';
              }
              ?>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </article>
  <?php
}
?>
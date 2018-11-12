<section class="main-container col2-left-layout">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-sm-push-3">
                <article class="col-main">
                    <div class="page-title">
                        <h2><?php echo $oneCategory->title ?></h2>
                    </div>
                    <div class="blog-wrapper" id="main">
                        <div class="site-content" id="primary">
                            <div id="content" role="main">
                                <article class="blog_entry clearfix" id="post-<?php echo $oneItem->id?>">

                                    <!--blog_entry-header clearfix-->
                                    <div class="entry-content">
                                        <div class="featured-thumb">
                                            <a href="<?php echo getUrlNews($oneItem) ?>" title="<?php echo getTitle($oneItem) ?>">
                                                <img alt="blog-img3" src="<?php echo getImageThumb($oneItem->thumbnail) ?>"
                                                     alt="<?php echo getTitle($oneItem) ?>">
                                                </a>
                                        </div>
                                        <header class="blog_entry-header clearfix">
                                            <div class="blog_entry-header-inner">
                                                <h1 class="blog_entry-title"> <?php echo $oneItem->title ?> </h1>
                                            </div>
                                            <!--blog_entry-header-inner-->
                                        </header>
                                        <div class="entry-content">
                                            <?php echo $oneItem->content ?>
                                        </div>
                                    </div>
                                </article>
                                <div class="comment-content wow bounceInUp animated">
                                    <div class="fb-comments" data-href="<?php echo current_url() ?>" data-numposts="5"
                                         data-width="100%"></div>
                                </div>
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
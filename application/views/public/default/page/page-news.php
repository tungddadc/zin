<?php if (!empty($oneItem)):
    $url = getUrlPage($oneItem);
    extract($dataNews);
    ?>
    <!-- Main Container -->
    <section class="main-container col2-left-layout">
        <div class="container">
            <?php $this->load->view($this->template_path . 'news/menu-top') ?>
            <div class="row">
                <div class="col-sm-9">
                    <article class="col-main" id="content_ajax">
                        <div class="blog-wrapper" id="main">
                            <div class="site-content page-news" id="primary">
                                <div id="content" role="main" class="content-cat">
                                    <?php $this->load->view($this->template_path . 'news/list-item', array('data' => $data)) ?>
                                    <?php if (!empty($pagination)): ?>
                                        <div class="pages text-center">
                                            <?php echo $pagination ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <?php $this->load->view($this->template_path . 'news/sidebar') ?>
            </div>
        </div>
    </section>
    <!-- Main Container End -->
<?php endif; ?>
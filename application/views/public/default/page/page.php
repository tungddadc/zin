<?php if(!empty($oneItem)):
    $url = getUrlPage($oneItem);
    ?>

    <?php $this->load->view($this->template_path . 'account/_header') ?>
    <section class="page-faq">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb">
                        <?php echo !empty($breadcrumb) ? $breadcrumb : '' ?>
                    </nav>
                    <div class="content-news-details">
                        <div class="item-news-title" style="padding: 10px 0;">
                            <h1><a href="<?php echo getUrlPage($oneItem) ?>" title="<?php echo getTitle($oneItem, $this->settings) ?>"><?php echo $oneItem->title ?></a></h1>
                        </div>
                        <p class="desc-news-details"><strong><?php echo $oneItem->description ?></strong></p>
                        <div>
                            <?php echo $oneItem->content ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-news">
                        <ul class="list-group">
                            <?php $listPage = sidebarPage();if(!empty($listPage)) foreach ($listPage as $item): $item = (object) $item; ?>
                                <li class="list-group-item"><a href="<?php echo base_url($item->link) ?>" title="<?php echo $item->title ?>"><?php echo $item->title ?></a> </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <script>
        var urlCurrent = '<?php echo getUrlCateNews($oneParent) ?>';
    </script>
<?php endif; ?>
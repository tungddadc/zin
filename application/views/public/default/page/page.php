<?php if(!empty($oneItem)):
    $url = getUrlPage($oneItem);
    ?>
    <!-- Main Container -->
    <section class="main-container col2-left-layout">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-sm-push-3">
                    <article class="col-main">
                        <div class="page-title">
                            <h1><?php echo $oneItem->title ?></h1>
                        </div>
                        <div class="static-contain">
                            <p><strong><?php echo $oneItem->description ?></strong></p>
                            <?php echo $oneItem->content ?>
                        </div>
                    </article>
                </div>
                <aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
                    <?php $this->load->view($this->template_path . 'page/_sidebar') ?>
                </aside>
            </div>
        </div>
    </section>
    <!-- Main Container End -->
<?php endif; ?>
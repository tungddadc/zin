<?php if(!empty($oneItem)):
    $url = getUrlPage($oneItem);
    ?>
        <div class="banner-intro mgt-banner">
            <img src="<?php echo $this->templates_assets ?>images/banner-intro.jpg" alt="">
            <div class="title">
                <h2 class="heading">before all</h2>
                <span>vững bước tương lai</span>
            </div>
        </div>
        <section class="page-intro">
            <nav class="navigation-product nav-intro" id="mainNav">
                <a class="navigation-product__link" href="#1">Về before all</a>
                <a class="navigation-product__link" href="#2">lịch sử phát triển</a>
                <a class="navigation-product__link" href="#3">giải thưởng</a>
                <a class="navigation-product__link" href="#4">đội ngũ nhân sự</a>
            </nav>
            <div class="page-section-product page-section-intro page-section-intro-step1 first" id="1">
                <div class="container container-sm">
                    <div class="row">
                        <div class="col-lg-9">
                            <h1 class="title-intro-primary"><?php echo $oneItem->meta_title ?></h1>
                            <div class="content">
                                <?php echo $oneItem->content ?>
                            </div>
                            <a href="<?php echo getUrlPage($oneItem) ?>" title="">Xem thêm <i class=""></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-section-product page-section-intro page-section-intro-step2" id="2">
                <div class="container container-sm">
                    <h3 class="title-intro-primary">lịch sử phát triển before all</h3>
                    <div class="content-history">
                        <div class="row">
                            <div class="wrap-history">
                                <?php if(!empty($listHistory)) foreach ($listHistory as $k => $item): ?>
                                    <?php if($k%2 == 0): ?>
                                        <div class="item col-xl-3 col-md-4 col-sm-6 col-12">
                                            <div class="img-year top-item">
                                                <a href="<?php echo getImageThumb($item->thumbnail) ?>" title="<?php echo $item->title ?>" data-fancybox="history"> <img src="<?php echo getImageThumb($item->thumbnail,142,142) ?>" alt="<?php echo $item->title ?>"></a>
                                                <div class="year"><?php echo $item->title ?></div>
                                            </div>
                                            <div class="content">
                                                <?php echo $item->content ?>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="item col-xl-3 col-md-4 col-sm-6 col-12">
                                            <div class="content top-item">
                                                <?php echo $item->content ?>
                                            </div>
                                            <div class="img-year bottom-item">
                                                <div class="year"><?php echo $item->title ?></div>
                                                <a href="<?php echo getImageThumb($item->thumbnail) ?>" title="<?php echo $item->title ?>" data-fancybox="history"><img src="<?php echo getImageThumb($item->thumbnail,142,142) ?>" alt="<?php echo $item->title ?>"></a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-section-product page-section-intro page-section-intro-step3" id="3">
                <div class="container container-sm">
                    <h3 class="title-intro-primary dark">thành tựu</h3>
                    <div class="slideProsper owl-carousel owl-theme">
                         <?php if(!empty($listAchievement)) foreach ($listAchievement as $k => $item): ?>
                            <div class="item">
                                <a href="<?php echo getImageThumb($item->thumbnail) ?>" title="<?php echo $item->title ?>" class="img" data-fancybox="prosper">
                                    <img src="<?php echo getImageThumb($item->thumbnail,270,200) ?>" alt="<?php echo $item->title ?>">
                                </a>
                                <div class="title">
                                    <?php echo $item->content ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="page-section-product page-section-intro page-section-intro-step4" id="4">
                <div class="container container-sm">
                    <h3 class="title-intro-primary">đội ngũ nhân sự</h3>
                    <div class="slideTeam owl-carousel owl-theme">
                        <?php if(!empty($listNhansu)) foreach ($listNhansu as $item): ?>
                            <div class="item">
                                <img src="<?php echo getImageThumb($item->thumbnail,270,458) ?>" alt="<?php echo $item->fullname ?>">
                                <div class="title">
                                    <b><?php echo $item->fullname ?></b>
                                    <span><?php echo $item->title ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
<?php endif; ?>

<?php if(!empty($oneItem)):
    $url = getUrlNews($oneItem);
    ?>
    <div class="top-banner-primary news">
        <div class="container">
            <div class="title-banner-page">
                <h2 class="heading-page"><a href="<?php echo getUrlCateNews($oneCategory) ?>" title="<?php echo $oneCategory->meta_title ?>"><?php echo $oneCategory->meta_title ?></a></h2>
                <div class="direct-page">
                    <?php echo !empty($breadcrumb) ? $breadcrumb : '' ?>
                </div>
            </div>
        </div>
    </div>
    <section class="news-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="content-news-details">
                        <div class="item-news-img">
                            <a href="<?php echo getUrlNews($oneItem) ?>" title="<?php echo getTitle($oneItem, $this->settings) ?>">
                                <img src="<?php echo getImageThumb($oneItem->thumbnail,770,430); ?>" alt="<?php echo getTitle($oneItem,$this->settings) ?>">
                            </a>
                        </div>
                        <div class="item-news-title">
                            <div class="date-box">
                                <?php echo timeAgo($oneItem->created_time, 'd') ?> <span>Tháng <?php echo timeAgo($oneItem->created_time, 'm') ?></span>
                            </div>
                            <h1><a href="<?php echo getUrlNews($oneItem) ?>" title="<?php echo getTitle($oneItem, $this->settings) ?>"><?php echo $oneItem->title ?></a></h1>
                        </div>
                        <p class="desc-news-details"><strong><?php echo $oneItem->description ?></strong></p>
                        <div>
                            <?php echo $oneItem->content ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-news">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#related" role="tab" aria-controls="home" aria-selected="true">Tin xem nhiều</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#latest" role="tab" aria-controls="profile" aria-selected="false">tin mới nhất</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="related" role="tabpanel" aria-labelledby="home-tab">
                                <?php if(!empty($list_mostview)) foreach ($list_mostview as $item): ?>
                                    <div class="item-sidebar">
                                        <div class="item-news-img">
                                            <a href="<?php echo getUrlNews($item) ?>" title="<?php echo getTitle($item,$this->settings) ?>">
                                                <img src="<?php echo getImageThumb($item->thumbnail,370,258); ?>" alt="<?php echo getTitle($item,$this->settings) ?>">
                                            </a>
                                        </div>
                                        <div class="item-news-title">
                                            <div class="date-box">
                                                <?php echo timeAgo($item->created_time, 'd') ?> <span>Tháng <?php echo timeAgo($item->created_time, 'm') ?></span>
                                            </div>
                                            <h3><a href="<?php echo getUrlNews($item) ?>" title="<?php echo getTitle($item,$this->settings) ?>"><?php echo $item->title ?></a></h3>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="tab-pane fade" id="latest" role="tabpanel" aria-labelledby="profile-tab">
                                <?php if(!empty($list_new)) foreach ($list_new as $item): ?>
                                    <div class="item-sidebar">
                                        <div class="item-news-img">
                                            <a href="<?php echo getUrlNews($item) ?>" title="<?php echo getTitle($item,$this->settings) ?>">
                                                <img src="<?php echo getImageThumb($item->thumbnail,370,258); ?>" alt="<?php echo getTitle($item,$this->settings) ?>">
                                            </a>
                                        </div>
                                        <div class="item-news-title">
                                            <div class="date-box">
                                                <?php echo timeAgo($item->created_time, 'd') ?> <span>Tháng <?php echo timeAgo($item->created_time, 'm') ?></span>
                                            </div>
                                            <h3><a href="<?php echo getUrlNews($item) ?>" title="<?php echo getTitle($item,$this->settings) ?>"><?php echo $item->title ?></a></h3>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="news-lq">
        <div class="container">
            <h3 class="title">tin liên quan</h3>
            <div class="row">
                <?php if(!empty($list_related)) foreach ($list_related as $item): ?>
                    <div class="col-lg-4">
                        <div class="item-sidebar">
                            <div class="item-news-img">
                                <a href="<?php echo getUrlNews($item) ?>" title="<?php echo getTitle($item,$this->settings) ?>">
                                    <img src="<?php echo getImageThumb($item->thumbnail,370,258); ?>" alt="<?php echo getTitle($item,$this->settings) ?>">
                                </a>
                            </div>
                            <div class="item-news-title">
                                <div class="date-box">
                                    <?php echo timeAgo($item->created_time, 'd') ?> <span>Tháng <?php echo timeAgo($item->created_time, 'm') ?></span>
                                </div>
                                <h3><a href="<?php echo getUrlNews($item) ?>" title="<?php echo getTitle($item,$this->settings) ?>"><?php echo $item->title ?></a></h3>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <script>
        var urlCurrent = '<?php echo getUrlCateNews($oneParent) ?>';
    </script>
<?php endif; ?>
<script src="https://apis.google.com/js/platform.js" async defer></script>
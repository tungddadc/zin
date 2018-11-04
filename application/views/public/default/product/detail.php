<?php if(!empty($oneItem)):
    $url = getUrlProduct($oneItem);
    $album = !empty($oneItem->album) ? json_decode($oneItem->album) : null;
    $oneFormat = getPropertyByProduct($oneItem->id,'format');
    $oneColorMode = getPropertyByProduct($oneItem->id,'color_mode');
    ?>
    <div class="heading-poster-details">
        <div class="container">
            <div class="content">
                <nav aria-label="breadcrumb">
                    <?php echo !empty($breadcrumb) ? $breadcrumb : '' ?>
                </nav>
                <div class="cart-primary">
                    <a href="<?php echo base_url('cart') ?>" title="Giỏ hàng">
                        <i class="icon_bag_alt"></i>
                        <span>giỏ hàng</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <section class="poster-details-page">
        <div class="container">
            <div class="wrap-content-poster">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="content-poster">
                            <h1 class="title"><?php echo $oneItem->title ?></h1>
                            <div class="content">
                                <p><?php echo $oneItem->description ?></p>
                                <?php if(!empty($album)) foreach ($album as $item): ?>
                                    <img src="<?php echo getImageThumb($item) ?>" alt="<?php echo getTitle($oneItem, $this->settings) ?>">
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 pd-left">
                        <div class="sidebarPoster">
                            <?php if(!empty($oneItem->account_id)): $oneAccount = getUserById($oneItem->account_id);  ?>
                                <div class="author">
                                    <a href="<?php echo base_url('account/profile/'.$oneItem->account_id) ?>" title="Trang cá nhân của <?php echo !empty($oneAccount->fullname) ? $oneAccount->fullname : $oneAccount->username ?>" class="avatar"><i class="icon_profile"></i></a>
                                    <div class="info-author">
                                        <a href="<?php echo base_url('account/profile/'.$oneItem->account_id) ?>" title="<?php echo !empty($oneAccount->fullname) ? $oneAccount->fullname : $oneAccount->username ?>"><?php echo !empty($oneAccount->fullname) ? $oneAccount->fullname : $oneAccount->username ?></a>
                                        <span><?php echo $oneAccount->job ?></span>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="author">
                                    <a href="javascript:;" title="Admin" class="avatar"><i class="icon_profile"></i></a>
                                    <div class="info-author">
                                        <a href="javascript:;" title="Admin">Admin</a>
                                        <span>Ban Quản Trị</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="info-poster">
                                <?php if(!empty($oneItem->price)): ?>
                                <div class="parameter mb-2">
                                    <span><?php echo priceVipPromotion($oneItem->price, $this->settings) ?></span>
                                </div>
                                <?php endif; ?>
                                <div class="btn-poster">
                                    <?php if(!empty($oneItem->price)): ?>
                                        <?php $checkExistBuyProduct = checkOrderProduct($oneItem->id);
                                        if($checkExistBuyProduct == true):
                                        ?>
                                            <a target="_blank" href="javascript:;" title="Tải <?php echo $oneItem->title ?>" data-id="<?php echo $oneItem->id ?>" class="btn-download-poster btn-item btnDownload"><span class="lnr lnr-cloud-download"></span>Tải về</a>
                                        <?php else: ?>
                                            <?php echo form_open('cart/add',array('id' => 'form_add_to_cart')) ?>
                                            <input type="hidden" name="product_id" value="<?php echo $oneItem->id ?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="price" value="<?php echo getPoint($oneItem->price,$this->settings) ?>">
                                            <input type="hidden" name="name" value="<?php echo $oneItem->title ?>">
                                            <input type="hidden" name="image" value="<?php echo getImageThumb($oneItem->thumbnail, 128,128) ?>">
                                            <button type="submit" class="btn btn-download-poster btn-item"><span class="lnr lnr-cart"></span>Cho vào giỏ hàng</button>
                                            <?php echo form_close() ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a target="_blank" href="javascript:;" title="Tải miễn phí <?php echo $oneItem->title ?>" data-id="<?php echo $oneItem->id ?>" class="btn-download-poster btn-item btnDownload"><span class="lnr lnr-cloud-download"></span>Tải miễn phí</a>
                                    <?php endif ?>
                                    <a href="javascript:;" data-id="<?php echo $oneItem->id ?>"  title="Thêm <?php echo $oneItem->title ?> vào bộ sưu tập" class="btn-collection-poster btn-item"><span class="lnr lnr-heart"></span>Bộ sưu tập</a>
                                </div>
                                <div class="parameter">
                                    <span><i class="lnr lnr-eye"></i><?php echo $oneItem->viewed ?></span>
                                    <span><i class="lnr lnr-cloud-download"></i><?php echo getTotalDownload($oneItem->id) ?></span>
                                    <span><i class="lnr lnr-heart"></i><?php echo getTotalFavouriteByProduct($oneItem->id) ?></span>
                                </div>
                            </div>
                            <div class="list-parameter-poster">
                                <span class="id-poster">ID: <?php echo $oneItem->id ?></span>
                                <div class="item">
                                    <span><?php echo !empty($oneFormat->title) ?  "Định dạng: $oneFormat->title" : '' ?></span>
                                    <span><?php echo !empty($oneItem->size) ? "Kích cỡ: $oneItem->size pixels" : ''; ?></span>
                                </div>
                                <div class="item">
                                    <span><strong><?php echo !empty($oneColorMode->title) ?  "Chế độ màu: $oneColorMode->title" : '' ?></strong></span>
                                    <span><?php echo $oneItem->capacity ? "Dung lượng: $oneItem->capacity" : '' ?></span>
                                </div>
                            </div>
                            <div class="tags-poster">
                                <span class="heading">Tags</span>
                                <ul>
                                    <?php if(!empty($list_tags)) foreach ($list_tags as $item): ?>
                                        <li><a href="<?php echo getUrlTag($item) ?>" title="<?php echo $item->title ?>"><?php echo $item->title ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="sb-report">
                                <button class="report-btn" type="button" data-target="#report-md" data-toggle="modal"><i class="icon_shield"></i> Báo cáo</button>
                            </div>
                            <div class="share-poster">
                                <span>Chia sẻ:</span>
                                <div id="share_socials" class="social"></div>
                            </div>
                            <div class="ads-sidebar text-center">
                                <?php $ads = getBannerByPosition(64); echo !empty($ads->script) ? $ads->script : (!empty($ads->thumbnail) ? getImageThumb($ads->thumbnail) : '')?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if(!empty($list_related)): ?>
        <div class="poster-related">
            <div class="container">
                <div class="list-poster-related">
                    <h2 class="heading-poster-related">Áp phích liên quan</h2>
                    <div class="row">
                        <?php foreach ($list_related as $item): ?>
                            <div class="col-lg-3 col-md-6">
                                <div class="item-home-primary">
                                    <a href="<?php echo getUrlProduct($item) ?>" title="<?php echo getTitle($item, $this->settings) ?>" class="img">
                                        <img src="<?php echo getImageThumb($item->thumbnail, 270, 356) ?>" alt="<?php echo getTitle($item, $this->settings) ?>">
                                        <div class="bg-black"><span>Chi tiết</span></div>
                                    </a>
                                    <h3 class="title">
                                        <a href="<?php echo getUrlProduct($item) ?>" title="<?php echo getTitle($item, $this->settings) ?>"><?php echo $item->title ?></a>
                                        <?php if(strtotime('+10 day',strtotime($item->created_time)) - time() > 0): ?>
                                            <span class="new">NEW</span>
                                        <?php endif; ?>
                                    </h3>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div id="report-md" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content report-ct">
                <h3 class="title">Vui lòng giải thích lý do cho báo cáo</h3>
                <button type="button" class="md-close" data-dismiss="modal">&times;</button>
                <?php echo form_open('product/ajax_report',['id'=>'form_report_product']) ?>
                <input type="hidden" name="product_id" value="<?php echo $oneItem->id ?>">
                <input type="hidden" name="account_id" value="<?php echo $this->session->userdata('account')['account_id'] ?>">
                <div class="reasons">
                    <?php if(!empty($property_reason)) foreach ($property_reason as $item): ?>
                        <p>
                            <label>
                                <input type="radio" name="title" value="<?php echo $item->title ?>">
                                <i></i>
                                <?php echo $item->title ?>
                            </label>
                        </p>
                    <?php endforeach; ?>
                </div>

                <div class="hc-upload single">
                    <label>
                        <input type="text" name="image" autocomplete="disable" accept="image/x-png,image/gif,image/jpeg" onclick="uploadImage(this)">
                        <span class="butn">Tải ảnh</span>
                        <span class="text">
                                <span class="i-title">Nhấp / kéo để tải ảnh lên</span>
                            </span>
                    </label>
                    <div class="img preview hidden">
                        <img src="//via.placeholder.com/400x200">
                        <button class="remove" type="button">&times;</button>
                    </div>
                </div>

                <textarea placeholder="Mô tả"></textarea>
                <button class="butn v3" type="submit">Xác nhận</button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <script>
        var urlCurrent = '<?php echo getUrlCateProduct($oneParent) ?>';
        var urlCurrentMenu = '<?php echo getUrlProduct($oneItem) ?>';
    </script>
<?php endif; ?>


<?php
    /**
     * Created by PhpStorm.
     * User: Steven Nguyen
     * Date: 28/06/2018
     * Time: 12:56 SA
     */
    defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view($this->template_path . 'account/_header') ?>
<section class="page-profile">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <?php $this->load->view($this->template_path . 'account/_sidebar') ?>
            </div>
            <div class="col-lg-10">
                <div class="wrap-profile-summary collection">
                    <div class="content-profile-collection">
                        <div class="top">
                            <div class="title">Bộ sưu tập của bạn <span>(<?php echo !empty($total) ? $total : 0 ?>)</span></div>
                            <div class="count">Tổng cộng <span><?php echo !empty($total_favourite) ? $total_favourite : 0 ?></span> ảnh</div>
                        </div>
                        <div class="list-collection">
                            <div class="row row13">
                                <div class="col-lg-3 col-md-6">
                                    <div class="add-collection">
                                        <a href="javascript:;" title="Tạo bộ sưu tập" data-toggle="modal" data-target="#popupCreateLove">
                                            <img src="<?php echo $this->templates_assets ?>images/icon-collection.png" alt="">
                                            <span>Tạo bộ sưu tập</span>
                                        </a>
                                    </div>
                                </div>
                                <?php if(!empty($data)) foreach ($data as $item): ?>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="item-collection">
                                            <a href="<?php echo base_url('account/favourites/'.$item->id) ?>" title="<?php echo $item->title ?>">
                                                <span class="heading">
                                                    <small><?php echo getTotalFavourite($this->session->userdata('account')['account_id'],$item->id) ?> ảnh</small>
                                                    <?php echo $item->title ?>
                                                </span>
                                                <span class="img-big">
                                                    <img src="<?php echo getImageThumb(!empty($listProductByCollection[$item->id][0]->thumbnail) ? $listProductByCollection[$item->id][0]->thumbnail :'',274,274) ?>" alt="">
                                                </span>
                                                <span class="img-small">
                                                    <?php for($i = 1; $i < 4; $i++): ?>
                                                        <img src="<?php echo getImageThumb(!empty($listProductByCollection[$item->id][$i]->thumbnail) ? $listProductByCollection[$item->id][$i]->thumbnail :'',88,88) ?>" alt="">
                                                    <?php endfor; ?>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

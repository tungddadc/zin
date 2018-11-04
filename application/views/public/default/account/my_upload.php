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
                <div class="wrap-profile-summary upload">
                    <div class="content-profile-upload">
                        <div class="top">
                            <nav>
                                <div class="nav nav-tabs filterStatus">
                                    <a href="javascript:;" class="nav-item nav-link <?php echo $this->input->get('is_status') == 1 ? 'active' : (!isset($_GET['is_status']) ? 'active' : '') ?>" data-value="1">Đang hoạt động <span>(<?php echo getTotalProductByStatus(1) ?>)</span></a>
                                    <a href="javascript:;" class="nav-item nav-link <?php echo $this->input->get('is_status') == 2 ? 'active' : '' ?>" data-value="2">Chờ duyệt <span>(<?php echo getTotalProductByStatus(2) ?>)</span></a>
                                    <a href="javascript:;" class="nav-item nav-link <?php echo isset($_GET['is_status']) && $this->input->get('is_status') == 0 ? 'active' : '' ?>" data-value="0">Không thành công <span>(<?php echo getTotalProductByStatus(0) ?>)</span></a>
                                </div>
                            </nav>
                            <?php echo form_open(base_url('account/my_upload'), array('method' => 'GET','id' => 'filter_category')) ?>
                            <input type="hidden" name="is_status" value="1">
                            <div class="filter">
                                <select name="filter_sort" class="form-control">
                                    <option value="DESC" <?php echo $this->input->get('filter_sort') === 'DESC' ? 'selected' : '' ?>>Mới nhất</option>
                                    <option value="ASC" <?php echo $this->input->get('filter_sort') === 'ASC' ? 'selected' : '' ?>>Cũ nhất</option>
                                </select>
                            </div>
                            <?php echo form_close() ?>
                        </div>

                        <div class="tab-content" id="content_ajax_html">
                            <div class="tab-pane fade show active" id="nav-tabs1" role="tabpanel" aria-labelledby="tabs1">
                                <div class="block-item-profile">
                                    <div class="row row13">
                                        <?php if(!empty($data)) foreach ($data as $item): ?>
                                            <div class="col-md-3 col-sm-6">
                                                <div class="item-profile-primary">
                                                    <a target="_blank" href="<?php echo getUrlProduct($item) ?>" title="<?php echo getTitle($item, $this->settings) ?>" class="img">
                                                        <img src="<?php echo getImageThumb($item->thumbnail, 257,257) ?>" alt="<?php echo getTitle($item, $this->settings) ?>">
                                                    </a>
                                                    <div class="title">
                                                        <a target="_blank"  href="<?php echo getUrlProduct($item) ?>" title="<?php echo getTitle($item, $this->settings) ?>"><?php echo $item->title ?></a>
                                                        <?php if($this->input->get('is_status') == 2): ?>
                                                            <a href="<?php echo site_url('product/edit/'.$item->id) ?>" title="Sửa"><i class="lnr lnr-pencil"></i></a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach;else echo "<div class='text-center col-md-12'>".lang('text_data_empty')."</div>"; ?>
                                    </div>

                                    <div class="pagination-primary upload">
                                        <?php echo !empty($pagination) ? $pagination : '' ?>
                                        <?php if(!empty($total) && $total > $limit): ?>
                                            <div class="goto-page">
                                                Tới trang
                                                <input type="text" class="form-control" value="<?php echo !empty($page) ? $page : 1 ?>">
                                                <button data-url="<?php echo current_url() ?>" class="btn btnGoToPage">OK</button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var urlCurrent = '<?php echo base_url('account/my_upload') ?>';
</script>

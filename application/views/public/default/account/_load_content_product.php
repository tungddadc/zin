<div class="wrap-profile-summary upload">
    <div class="content-profile-upload">
        <div class="top">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active">Ảnh đã mua <span>(<?php echo !empty($total) ? $total : 0 ?>)</span></a>
                </div>
            </nav>
            <?php echo form_open(base_url($_SERVER['REQUEST_URI']), array('method' => 'GET','id' => 'filter_category')) ?>
            <div class="filter">
                <select name="filter_sort" class="form-control">
                    <option value="DESC" <?php echo $this->input->get('filter_sort') === 'DESC' ? 'selected' : '' ?>>Mới nhất</option>
                    <option value="ASC" <?php echo $this->input->get('filter_sort') === 'ASC' ? 'selected' : '' ?>>Cũ nhất</option>
                </select>
            </div>
            <?php echo form_close() ?>
        </div>

        <div class="tab-content" id="nav-tabContent">
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
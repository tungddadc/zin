<div class="nav-tabs-custom">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item active">
            <a href="#tab_general" class="nav-link" data-toggle="tab">Chung</a>
        </li>

        <li class="nav-item">
            <a href="#tab_page" class="nav-link" data-toggle="tab">Page</a>
        </li>
        <?php if(!empty($list_category_type)) foreach ($list_category_type as $k => $catg):?>
            <li class="nav-item">
                <a href="#tab_<?php echo $k ?>" class="nav-link" data-toggle="tab">Category <?php echo $catg['type']; ?></a>
            </li>
        <?php endforeach; ?>
        <li class="nav-item">
            <a href="#tab_post" class="nav-link" data-toggle="tab">Post</a>
        </li>
        <li class="nav-item">
            <a href="#tab_product" class="nav-link" data-toggle="tab">Product</a>
        </li>
    </ul>
    <div id="listDataItem" class="tab-content">
        <div class="tab-pane active" id="tab_general">
            <input type="hidden" value="" name="type">
            <select class="form-control select2"   style="width: 100%;" tabindex="-1" aria-hidden="true">
                <option value="#">Link khác</option>
                <option value="/">Trang chủ</option>
            </select>
        </div>

        <div class="tab-pane" id="tab_page">
            <input type="hidden" value="page" name="type"   style="width: 100%;" tabindex="-1" aria-hidden="true">
            <select class="form-control select2"   style="width: 100%;" tabindex="-1" aria-hidden="true">
                <?php
                if(!empty($list_pages)) foreach ($list_pages as $p):
                    $linkPage = str_replace(base_url(),'',getUrlPage($p));
                    ?>
                    <option value="<?php echo $linkPage; ?>">
                        <?php echo $p->title; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- /.tab-pane -->
        <?php if(!empty($list_category_type)) foreach ($list_category_type as $k => $categ):?>
            <div class="tab-pane" id="tab_<?php echo $k ?>">
                <input type="hidden" value="<?php echo $categ['type'] ?>" name="type">
                <select class="form-control select2"  style="width: 100%;" tabindex="-1" aria-hidden="true">
                    <?php
                    if(!empty($list[$categ['type']])) foreach ($list[$categ['type']] as $cat):
                        switch ($categ['type']){
                            case 'product':case 'document':
                                $linkPage = str_replace(base_url(),'',getUrlCateProduct($cat));
                                break;
                            default:
                                $linkPage = str_replace(base_url(),'',getUrlCateNews($cat));
                        }
                        ?>
                        <option value="<?php echo $linkPage; ?>"><?php echo $cat->title; ?></option>
                    <?php endforeach; ?>
                </select>
                <br/>
            </div>
        <?php endforeach; ?>

        <div class="tab-pane" id="tab_post">
            <input type="hidden" value="page" name="type"   style="width: 100%;" tabindex="-1" aria-hidden="true">
            <select class="form-control select2"   style="width: 100%;" tabindex="-1" aria-hidden="true">
                <?php
                if(!empty($list_posts)) foreach ($list_posts as $p):
                    $linkPage = str_replace(base_url(),'',getUrlNews($p));
                    ?>
                    <option value="<?php echo $linkPage; ?>">
                        <?php echo $p->title; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="tab-pane" id="tab_product">
            <input type="hidden" value="page" name="type"   style="width: 100%;" tabindex="-1" aria-hidden="true">
            <select class="form-control select2"   style="width: 100%;" tabindex="-1" aria-hidden="true">
                <?php
                if(!empty($list_products)) foreach ($list_products as $p):
                    $linkPage = str_replace(base_url(),'',getUrlProduct($p));
                    ?>
                    <option value="<?php echo $linkPage; ?>">
                        <?php echo $p->title; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
    <button type="button" class="btn btn-success addtonavmenu  mt-3"><i class="glyphicon glyphicon-plus"></i> Thêm vào menu</button>
</div>
<!-- nav-tabs-custom -->

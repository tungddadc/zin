<?php if (!empty($cate)) foreach ($cate as $item):?>
<div class="search-cate">
    <p><a href="<?php echo getUrlCateProduct($item)?>"><?php echo $item->title?></a> trong <a href="<?php echo getUrlCateProduct($oneParent)?>"><?php echo $oneParent->title?></a></p>
</div>
<?php endforeach;?>
<?php if(!empty($data)) foreach ($data as $item): ?>
    <div class="product_add">
        <div class="images_product">
            <a href="<?php echo getUrlProduct($item) ?>" title="<?php echo getTitle($item) ?>">
                <img src="<?php echo getImageThumb($item->thumbnail,100,100,true) ?>" alt="<?php echo getTitle($item) ?>">
            </a>
        </div>
    
        <div class="product_name">
            <a href="<?php echo getUrlProduct($item) ?>" title="<?php echo getTitle($item) ?>"><?php echo $item->title ?></a>
        </div>
        <div class="price">
            <?php $data_detail = getProductDetail($item->id); ?>
            <?php if($this->session->userdata('is_agency') == true && !empty($data_detail)): ?>
                <span class="price"><strong><?php echo formatMoney($data_detail[0]->price_agency) ?></strong></span>
            <?php else: ?>
                <?php if(!empty($item->price_sale)): ?>
                    <span class="price"><strong><?php echo formatMoney($item->price_sale) ?></strong></span>
                    <span class="price"><?php echo formatMoney($item->price) ?></span>
                <?php else: ?>
                    <span class="price"><strong><?php echo formatMoney($item->price) ?></strong></span>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>
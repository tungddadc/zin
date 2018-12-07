<?php
if (!empty($this->cart->contents())) {
  ?>
    <div class="top-cart-content">
      <!--block-subtitle-->
      <ul class="mini-products-list" id="cart-sidebar">
        <?php foreach ($this->cart->contents() as $i => $item): ?>
          <li class="item <?php echo $i == 0 ? 'first' : '' ?>">
            <div class="item-inner">
              <a title="<?php echo $item['name'] ?>" class="product-image"
                 href="<?php echo getUrlProduct(array('slug'=>$item['slug'],'id'=>$item['id'])) ?>">
                <img alt="<?php echo $item['name'] ?>" src="<?php echo $item['image'] ?>">
              </a>
              <div class="product-details">
                <div class="access">
                  <a onclick="CART.delete(this,'<?php echo $item['rowid'] ?>')" title="Bỏ sản phẩm này khỏi giỏ hàng" class="btn-remove1" href="javascript:;">Xóa</a>
                </div>
                <strong><?php echo $item['qty'] ?></strong> x <span class="price"><?php echo formatMoney($item['price']) ?></span>
                <p class="product-name"><a href="<?php echo getUrlProduct(array('slug'=>$item['slug'],'id'=>$item['id'])) ?>"><?php echo $item['name'] ?></a></p>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
      <!--actions-->
      <div class="actions">
        <button title="Checkout" class="btn-checkout" type="button"><span>Thanh toán</span></button>
        <a class="view-cart" href="<?php echo base_url('cart') ?>"><span>Xem giỏ hàng</span></a></div>
    </div>
  <?php
}
?>
<div class="heading-profile">
    <div class="container">
        <div class="content">
            <div class="info-account">
                <?php if($this->session->is_logged == true): ?>
                <?php $oneAccount = getUserById($this->session->userdata('account')['account_id']); ?>
                <span class="avatar">
                    <?php if(!empty($oneAccount->avatar)): ?>
                        <img src="<?php echo getImageThumb($oneAccount->avatar,80,80) ?>">
                    <?php else: ?>
                        <i class="icon_profile"></i>
                    <?php endif; ?>
                </span>
                <div class="info">
                    <span>ID: <?php echo $this->session->userdata('account')['account_id'] ?></span>
                    <span><?php echo !empty($oneAccount->fullname) ? $oneAccount->fullname : $oneAccount->username ?></span>
                    <span>Đã đăng ký ngày: <?php echo timeAgo($oneAccount->created_time,'d/m/Y') ?></span>
                </div>
                <?php endif; ?>
            </div>
            <div class="cart-primary">
                <a href="<?php echo base_url('cart') ?>" title="Giỏ hàng">
                    <i class="icon_bag_alt"></i>
                    <span>giỏ hàng</span>
                </a>
            </div>
        </div>
    </div>
</div>
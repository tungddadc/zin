<div class="comment-fr">
    <div class="cmt-head">
        <div class="table">
            <div class="cell">
                <strong>2 Bình Luận</strong>
            </div>
            <div class="cell text-right">
                <select name="comment_sort" style="width: 100px">
                    <option>Mới nhất</option>
                    <option>Cũ nhất</option>
                </select>
            </div>
        </div>
    </div>
    <div class="cmt-list">
        <div class="cmt-list">
            <div class="hc-comment">
                <div class="head">
                    <div class="avt">T</div>
                    <h4 class="name">Toàn Nguyễn Đức</h4>
                </div>
                <div class="text">
                    test        </div>
                <div class="ctrl">
                    <a class="smooth reply-btn" data-id="47" href="#" title="">Trả lời</a> •
                    <time>14 giờ trước đây</time>
                </div>
                <div class="replys">
                    <div class="hc-comment f2">
                        <div class="head">
                            <div class="avt">H</div>
                            <h4 class="name">Hacker</h4>
                            <label>Cá nhân</label>
                        </div>
                        <div class="text">
                            @Toàn Nguyễn Đức: test replies                    </div>
                        <div class="ctrl">
                            <time>14 giờ trước đây</time>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo form_open('product/comments',['class'=>'form-input form-comment']) ?>
    <input type="hidden" name="product_id" value="<?php echo $oneItem->id ?>">
    <div class="clearfix">
        <input type="text" name="full_name" placeholder="Tên của bạn" class="form_50 pull-left">
        <input type="text" name="email" placeholder="Email" class="form_50 pull-right">
    </div>
    <textarea name="content" placeholder="Mời bạn để lại bình luận" class="comments"></textarea>
    <div class="fr-photo"></div>
    <div class="fr-ctrl">
        <a href="<?php echo site_url('quy-dinh-dang-binh-luan') ?>" target="_blank" rel="nofollow" title="Quy định đăng bình luận" class="smooth quydinh_">Quy định đăng bình luận</a>
        <button type="submit" class="smooth send send_comment">Gửi bình luận</button>
    </div>
    <?php echo form_close() ?>


</div>
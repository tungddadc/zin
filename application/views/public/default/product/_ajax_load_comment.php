<div class="cmt-list">
    <?php if (!empty($data)) foreach ($data as $item): ?>
        <div class="hc-comment">
            <div class="head">
                <div class="avt"><?php echo ucfirst($item->name[0]) ?></div>
                <h4 class="name"><?php echo $item->name ?></h4>
                <?php echo $item->account_id == 1 ? '<label>Quản trị viên</label>' : '<label>Thành viên</label>' ?>
            </div>
            <div class="text"><?php echo $item->content ?></div>
            <div class="ctrl">
                <a class="reply-btn" data-id="<?php echo $item->id ?>" href="javascript:;" title="Trả lời"
                   rel="nofollow">Trả lời</a> •
                <time><?php echo timeAgo($item->created_time) ?></time>
            </div>
            <?php if (!empty($item->list_child)): ?>
                <div class="replys">
                    <?php foreach ($item->list_child as $itemChild): ?>
                        <div class="hc-comment f2">
                            <div class="head">
                                <div class="avt"><?php echo ucfirst($itemChild->name[0]) ?></div>
                                <h4 class="name"><?php echo $itemChild->name ?></h4>
                                <?php echo $itemChild->account_id == 1 ? '<label>Quản trị viên</label>' : '<label>Thành viên</label>' ?>
                            </div>
                            <div class="text">
                                <?php echo $itemChild->content ?></div>
                            <div class="ctrl">
                                <time><?php echo timeAgo($itemChild->created_time) ?></time>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
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
                <div id="content_ajax_html" class="wrap-profile-summary history">
                    <div class="content-profile-history">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Thời gian</th>
                                    <th scope="col">Mã giao dịch</th>
                                    <th scope="col">Loại giao dịch</th>
                                    <th scope="col">Giá trị</th>
                                    <th scope="col" class="text-center">Trạng thái</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($data)) foreach ($data as $item): ?>
                                    <tr>
                                        <th scope="row"><?php echo timeAgo($item->created_time, 'H:i:s d-m-Y') ?></th>
                                        <td>#<?php echo $item->id ?></td>
                                        <td>
                                        <?php
                                        switch ($item->type):
                                            case 'vip':
                                                echo 'Gia hạn gói dịch vụ VIP';
                                                break;
                                            case 'point':
                                                echo 'Nạp tiền';
                                                break;
                                            default:
                                                echo 'Mua lượt tải';
                                        endswitch;
                                        ?>
                                        </td>
                                        <td><?php echo $item->point .' đ' ?> (<?php echo formatMoney($item->point* $this->settings['config']['point_fee']) ?>)</td>
                                        <td align="center"><?php echo $item->payment_status == 1 ? '<span class="text-primary">Thành công</span>' : '<span class="text-danger">Không thành công</span>' ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination-primary">
                            <?php echo !empty($pagination) ? $pagination : '' ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var urlCurrent = '<?php echo base_url('account/transaction') ?>';
</script>
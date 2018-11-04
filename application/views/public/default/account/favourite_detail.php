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
            <div id="content_ajax_html" class="col-lg-10">
                <?php $this->load->view($this->template_path . 'account/_load_content_product') ?>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var urlCurrent = '<?php echo base_url('account/favourites') ?>';
</script>
<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 05/12/2017
 * Time: 4:19 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en" >
<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>
        Admin CMS | Dashboard
    </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta id="csrf_token" name="<?php echo $this->security->get_csrf_token_name(); ?>" content="<?php echo $this->security->get_csrf_hash() ?>">
    <!--begin::Web font -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>-->
    <script>
        WebFont.load({
            google: {"families":["Nunito Sans:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->
    <link href="<?php echo $this->templates_assets ?>assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->templates_assets ?>assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->templates_assets ?>css/custom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->templates_assets ?>css/custom.css" rel="stylesheet" type="text/css" />

    <!--end::Base Styles -->
    <link rel="shortcut icon" href="<?php echo site_url() ?>favicon.ico" />
</head>
<!-- end::Head -->

<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
<script>
    var base_url = '<?php echo base_url();?>',
        current_url = '<?php echo current_url(); ?>',
        path_media = '<?php echo MEDIA_PATH; ?>',
        script_name = '<?php echo BASE_SCRIPT_NAME; ?>', //Tên sub-folder chạy site
        media_name = '<?php echo MEDIA_NAME; ?>',
        media_url = '<?php echo MEDIA_URL; ?>',
        language = {},
        lang_cnf = {}
    ;
    <?php if(!empty($this->_controller)): ?>
        var url_ajax_list = '<?php echo site_url("admin/$this->_controller/ajax_list")?>',
            url_ajax_load = '<?php echo site_url("admin/$this->_controller/ajax_load")?>',
            url_ajax_add = '<?php echo site_url("admin/$this->_controller/ajax_add")?>',
            url_ajax_copy = '<?php echo site_url("admin/$this->_controller/ajax_copy")?>',
            url_ajax_edit = '<?php echo site_url("admin/$this->_controller/ajax_edit")?>',
            url_ajax_update = '<?php echo site_url("admin/$this->_controller/ajax_update")?>',
            url_ajax_update_field = '<?php echo site_url("admin/$this->_controller/ajax_update_field")?>',
            url_ajax_delete = '<?php echo site_url("admin/$this->_controller/ajax_delete")?>';
        <?php endif; ?>
    <?php if(!empty($this->config->item('language_name'))) foreach ($this->config->item('language_name') as $lang_code => $lang_name){ ?>
    lang_cnf['<?php echo $lang_code;?>'] = '<?php echo $lang_name;?>';
    <?php } ?>
</script>

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <!-- BEGIN: Header -->
    <?php $this->load->view($this->template_path.'_header') ?>
    <!-- END: Header -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <!-- BEGIN: Left Aside -->
        <?php $this->load->view($this->template_path.'_sidebar') ?>
        <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- begin::Body -->
            <div class="m-grid__item m-grid__item--fluid m-wrapper">
                <!-- BEGIN: Subheader -->
                <div class="m-subheader ">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h3 class="m-subheader__title ">
                                <?php echo !empty($heading_title)?$heading_title:'' ?>
                            </h3>
                        </div>
                        <small><?php echo !empty($heading_description)?$heading_description:'' ?></small>
                    </div>
                </div>
                <!-- END: Subheader -->
                <?php echo !empty($main_content)?$main_content:'' ?>
            </div>
        <!-- end:: Body -->
        </div>
    </div>
    <!-- begin::Footer -->
    <?php $this->load->view($this->template_path.'_footer') ?>
    <!-- end::Footer -->
</div>
<!-- end:: Page -->
<!-- begin::Quick Sidebar -->

<!-- end::Quick Sidebar -->
<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->

<!--begin::Base Scripts -->
<script src="<?php echo $this->templates_assets ?>assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="<?php echo $this->templates_assets ?>assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<!--end::Base Scripts -->
<!--begin::Page Vendors -->
<script src="<?php echo $this->templates_assets ?>assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Snippets -->
<script src="<?php echo $this->templates_assets ?>js/jquery.nestable.js" type="text/javascript"></script>


<script src="<?php echo $this->templates_assets ?>plugins/tinymce/tinymce.min.js" type="text/javascript"></script>
<script src="<?php echo $this->templates_assets ?>plugins/moxiemanager/js/moxman.loader.min.js" type="text/javascript"></script>


<script src="<?php echo $this->templates_assets ?>js/main.js" type="text/javascript"></script>
<?php if(!empty($this->_controller)): ?><script src="<?php echo $this->templates_assets ?>js/page/<?php echo $this->_controller ?>.js" type="text/javascript"></script><?php endif; ?>
<!--end::Page Snippets -->
</body>
</html>

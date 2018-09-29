<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 05/12/2017
 * Time: 4:19 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo !empty($heading_title) ? $heading_title : 'CMS' ?> | Apecsoft CMS</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="<?php echo $this->templates_assets ?>/favicon.ico" type="image/x-icon">
    <?php $asset_css[] = '../bower_components/bootstrap/dist/css/bootstrap.min.css'; ?>
    <?php $asset_css[] = '../bower_components/font-awesome/css/font-awesome.min.css'; ?>
    <?php $asset_css[] = '../bower_components/Ionicons/css/ionicons.min.css'; ?>

    <?php $asset_css[] = '../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'; ?>
    <?php $asset_css[] = '../bower_components/datatables.net-buttons-bs/css/buttons.bootstrap.min.css'; ?>
    <?php $asset_css[] = '../bower_components/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css'; ?>
    <?php $asset_css[] = '../bower_components/datatables.net-rowreorder-bs/css/rowReorder.bootstrap.min.css'; ?>

    <?php /*$asset_css[] = '../bower_components/morris.js/morris.css'; */?><!--
    <?php /*$asset_css[] = '../bower_components/jvectormap/jquery-jvectormap.css'; */?>
    <?php /*$asset_css[] = '../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'; */?>
    <?php /*$asset_css[] = '../bower_components/bootstrap-daterangepicker/daterangepicker.css'; */?>
    --><?php /*$asset_css[] = '../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'; */?>

    <?php $asset_css[] = '../bower_components/fancybox/dist/jquery.fancybox.min.css'; ?>
    <?php $asset_css[] = '../plugins/pace/pace.min.css'; ?>
    <?php $asset_css[] = '../plugins/iCheck/all.css'; ?>
    <?php $asset_css[] = '../bower_components/bootstrap-sweetalert/dist/sweetalert.css'; ?>
    <?php $asset_css[] = '../bower_components/toastr/toastr.min.css'; ?>


    <?php $asset_css[] = '../bower_components/select2/dist/css/select2.min.css'; ?>
    <?php $asset_css[] = '../bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css'; ?>
    <?php $asset_css[] = '../bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'; ?>

    <?php $asset_css[] = 'AdminLTE.min.css'; ?>
    <?php $asset_css[] = 'skins/_all-skins.min.css'; ?>
    <?php $asset_css[] = 'custom.css'; ?>
    <?php
        $this->minify->css($asset_css);
        echo $this->minify->deploy_css(TRUE);
    ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
</head>
<!--<style>
    .modal-footer-top-button{position:unset!important}
</style>-->
<body class="hold-transition skin-red sidebar-mini fixed">
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
    <?php if(!empty($controller)): ?>
        var url_ajax_list = '<?php echo site_url("admin/$controller/ajax_list")?>',
            url_ajax_load = '<?php echo site_url("admin/$controller/ajax_load")?>',
            url_ajax_add = '<?php echo site_url("admin/$controller/ajax_add")?>',
            url_ajax_copy = '<?php echo site_url("admin/$controller/ajax_copy")?>',
            url_ajax_edit = '<?php echo site_url("admin/$controller/ajax_edit")?>',
            url_ajax_update = '<?php echo site_url("admin/$controller/ajax_update")?>',
            url_ajax_update_field = '<?php echo site_url("admin/$controller/ajax_update_field")?>',
            url_ajax_delete = '<?php echo site_url("admin/$controller/ajax_delete")?>';
        <?php endif; ?>
    <?php if(!empty($this->config->item('cms_language'))) foreach ($this->config->item('cms_language') as $lang_code => $lang_name){ ?>
    lang_cnf['<?php echo $lang_code;?>'] = '<?php echo $lang_name;?>';
    <?php } ?>
</script>
<div class="wrapper">
    <?php $this->load->view($this->template_path.'_header') ?>
    <!-- Left side column. contains the logo and sidebar -->
    <?php $this->load->view($this->template_path.'_sidebar') ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php echo !empty($heading_title)?$heading_title:'' ?>
                <small><?php echo !empty($heading_description)?$heading_description:'' ?></small>
            </h1>
            <?php echo !empty($breadcrumbs)?$breadcrumbs:''; ?>
        </section>
        <?php echo !empty($main_content)?$main_content:'' ?>
    </div>
    <!-- /.content-wrapper -->
    <?php $this->load->view($this->template_path.'_footer') ?>
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<?php $asset_jquery[] = '../bower_components/jquery/dist/jquery.min.js'; ?>
<?php $asset_jquery[] = '../bower_components/jquery-ui/jquery-ui.min.js'; ?>
<?php $this->minify->js($asset_jquery); echo $this->minify->deploy_js();  ?>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<?php $asset_js[] = '../bower_components/bootstrap/dist/js/bootstrap.min.js'; ?>
<?php $asset_js[] = '../bower_components/datatables.net/js/jquery.dataTables.min.js'; ?>
<?php $asset_js[] = '../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'; ?>
<?php $asset_js[] = '../bower_components/datatables.net-rowreorder/js/dataTables.rowReorder.min.js'; ?>
<?php $asset_js[] = '../bower_components/datatables.net-buttons/js/dataTables.buttons.min.js'; ?>
<?php $asset_js[] = '../bower_components/datatables.net-buttons-bs/js/buttons.bootstrap.min.js'; ?>
<?php $asset_js[] = '../bower_components/datatables.net-buttons/js/buttons.print.min.js'; ?>
<?php $asset_js[] = '../bower_components/datatables.net-buttons/js/buttons.html5.min.js'; ?>
<?php $asset_js[] = '../bower_components/datatables.net-buttons/js/buttons.flash.min.js'; ?>
<?php $asset_js[] = '../bower_components/datatables.net-buttons/js/buttons.colVis.min.js'; ?>


<?php /*$asset_js[] = '../bower_components/raphael/raphael.min.js'; */?><!--
<?php /*$asset_js[] = '../bower_components/morris.js/morris.min.js'; */?>
<?php /*$asset_js[] = '../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js'; */?>
<?php /*$asset_js[] = '../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'; */?>
<?php /*$asset_js[] = '../plugins/jvectormap/jquery-jvectormap-world-mill-en.js'; */?>
--><?php /*$asset_js[] = '../bower_components/jquery-knob/dist/jquery.knob.min.js'; */?>



<?php $asset_js[] = '../bower_components/moment/min/moment.min.js'; ?>
<?php $asset_js[] = '../bower_components/bootstrap-daterangepicker/daterangepicker.js'; ?>
<?php $asset_js[] = '../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'; ?>
<?php $asset_js[] = '../bower_components/select2/dist/js/select2.min.js'; ?>
<?php $asset_js[] = '../bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js'; ?>
<?php $asset_js[] = '../bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'; ?>
<?php $asset_js[] = 'jquery.nestable.js'; ?>


<?php //$asset_js[] = '../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'; ?>
<?php $asset_js[] = '../bower_components/jquery-slimscroll/jquery.slimscroll.min.js'; ?>
<?php $asset_js[] = '../bower_components/fastclick/lib/fastclick.js'; ?>


<?php $asset_js[] = '../bower_components/fancybox/dist/jquery.fancybox.min.js'; ?>
<?php $asset_js[] = '../bower_components/PACE/pace.min.js'; ?>
<?php $asset_js[] = '../plugins/iCheck/icheck.min.js'; ?>
<?php $asset_js[] = '../bower_components/toastr/toastr.min.js'; ?>
<?php $asset_js[] = '../bower_components/bootstrap-sweetalert/dist/sweetalert.min.js'; ?>

<?php $asset_js[] = 'adminlte.min.js'; ?>
<?php $asset_js[] = 'demo.js'; ?>

<?php $asset_js[] = '../plugins/tinymce/tinymce.min.js'; ?>
<?php $asset_js[] = '../plugins/moxiemanager/js/moxman.loader.min.js'; ?>

<?php $asset_js[] = 'main.js'; ?>
<?php if(!empty($controller)) $asset_js[] = "pages/$controller.js"; ?>

<?php $this->minify->js($asset_js); echo $this->minify->deploy_js();  ?>
<script type="text/javascript">
    toastr.options.escapeHtml = true;
    toastr.options.closeButton = true;
    toastr.options.positionClass = "toast-bottom-right";
    toastr.options.timeOut = 5000;
    toastr.options.showMethod = 'fadeIn';
    toastr.options.hideMethod = 'fadeOut';
    toastr.options.progressBar = true;
    <?php if($this->session->flashdata('message')): $message = $this->session->flashdata('message'); ?>
    <?php if(!empty($message['type'])) echo "toastr['".$message['type']."']('".trim(strip_tags($message['message']))."');" ?>
    <?php endif; ?>
</script>
</body>
</html>

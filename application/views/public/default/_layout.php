<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 05/12/2017
 * Time: 4:19 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="https://m.me/thietkewebsitechatluongcao">
    <?php if (!empty($SEO)): ?>
        <title><?php echo !empty($SEO['meta_title']) ? $SEO['meta_title'] . ' - ' . $this->settings['name'] : ''; ?></title>
        <meta name="description"
              content="<?php echo !empty($SEO['meta_description']) ? $SEO['meta_description'] : ''; ?>"/>
        <meta name="keywords" content="<?php echo !empty($SEO['meta_keyword']) ? $SEO['meta_keyword'] : ''; ?>"/>
        <!--Meta Facebook Page Other-->
        <meta property="og:type" content="website"/>
        <meta property="og:title"
              content="<?php echo !empty($SEO['meta_title']) ? $SEO['meta_title'] . ' - ' . $this->settings['name'] : ''; ?>"/>
        <meta property="og:description"
              content="<?php echo !empty($SEO['meta_description']) ? $SEO['meta_description'] : ''; ?>"/>
        <meta property="og:image" content="<?php echo !empty($SEO['image']) ? $SEO['image'] : ''; ?>"/>
        <meta property="og:url" content="<?php echo !empty($SEO['url']) ? $SEO['url'] : base_url(); ?>"/>
        <!--Meta Facebook Page Other-->
        <link rel="canonical" href="<?php echo !empty($SEO['url']) ? $SEO['url'] : base_url(); ?>"/>
    <?php else: ?>
        <title><?php echo !empty($SEO['meta_title']) ? $SEO['meta_title'] . ' - ' . $this->settings['title'] : isset($this->settings['title']) ? $this->settings['title'] . ' - ' . $this->settings['name'] : ''; ?></title>
        <meta name="description"
              content="<?php echo !empty($SEO['meta_description']) ? $SEO['meta_description'] : isset($this->settings['meta_desc']) ? $this->settings['meta_desc'] : ''; ?>"/>
        <meta name="keywords"
              content="<?php echo !empty($SEO['meta_keyword']) ? $SEO['meta_keyword'] : isset($this->settings['meta_keyword']) ? $this->settings['meta_keyword'] : ''; ?>"/>
        <!--Meta Facebook Homepage-->
        <meta property="og:type" content="website"/>
        <meta property="og:title"
              content="<?php echo isset($this->settings['title']) ? $this->settings['title'] . ' | ' . $this->settings['name'] : ''; ?>"/>
        <meta property="og:description"
              content="<?php echo isset($this->settings['meta_desc']) ? $this->settings['meta_desc'] : ''; ?>"/>
        <meta property="og:image" content="<?php echo getImageThumb('', 400, 200); ?>"/>
        <meta property="og:url" content="<?php echo base_url(); ?>"/>
        <!--Meta Facebook Homepage-->
        <link rel="canonical" href="<?php echo base_url(); ?>"/>
    <?php endif; ?>

    <link rel="icon"
          href="<?php echo !empty($this->settings['favicon']) ? getImageThumb($this->settings['favicon'], 32, 32) : base_url("favicon.ico"); ?>"
          sizes="32x32">
    <link rel="icon"
          href="<?php echo !empty($this->settings['favicon']) ? getImageThumb($this->settings['favicon'], 192, 192) : base_url("favicon.ico"); ?>"
          sizes="192x192">
    <link rel="apple-touch-icon-precomposed"
          href="<?php echo !empty($this->settings['favicon']) ? getImageThumb($this->settings['favicon'], 180, 180) : base_url("favicon.ico"); ?>">
    <meta name="msapplication-TileImage"
          content="<?php echo !empty($this->settings['favicon']) ? getImageThumb($this->settings['favicon'], 270, 270) : base_url("favicon.ico"); ?>">

    <?php $asset_css[] = 'bootstrap.min.css'; ?>
    <?php $asset_css[] = 'font-awesome.min.css'; ?>
    <?php $asset_css[] = 'simple-line-icons.css'; ?>
    <?php $asset_css[] = 'owl.carousel.css'; ?>
    <?php $asset_css[] = 'owl.theme.css'; ?>
    <?php $asset_css[] = 'jquery.bxslider.css'; ?>
    <?php $asset_css[] = 'jquery.mobile-menu.css'; ?>
    <?php $asset_css[] = 'style.css'; ?>
    <?php $asset_css[] = 'revslider.css'; ?>

    <?php //$asset_css[] = 'plugins/jssocials/dist/jssocials.css'; ?>
    <?php //$asset_css[] = 'plugins/jssocials/dist/jssocials-theme-flat.css'; ?>

    <?php //$asset_css[] = 'plugins/toastr/toastr.min.css'; ?>
    <?php //$asset_css[] = 'plugins/select2/dist/select2.min.css'; ?>
    <?php $asset_css[] = 'custom.css'; ?>

    <?php
    $this->minify->css($asset_css);
    echo $this->minify->deploy_css(TRUE);
    ?>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        var urlCurrentMenu = window.location.href,
            urlCurrent = window.location.href,
            base_url = '<?php echo base_url(); ?>',
            media_url = '<?php echo MEDIA_URL . '/'; ?>',
            script_folder = '<?php echo BASE_SCRIPT_NAME; ?>',
            csrf_cookie_name = '<?php echo $this->config->item('csrf_cookie_name') ?>',
            csrf_token_name = '<?php echo $this->security->get_csrf_token_name() ?>',
            csrf_token_hash = '<?php echo $this->security->get_csrf_hash() ?>'
        ;
    </script>
</head>
<body class="cms-index-index cms-home-page">
<div id="fb-root"></div>
<div id="page">
    <?php $this->load->view($this->template_path . '_header') ?>
    <?php echo !empty($main_content) ? $main_content : '' ?>
    <?php $this->load->view($this->template_path . '_footer') ?>
</div>
<div id="preloader" class="d-none">
    <div id="loader"></div>
</div>

<?php $asset_js[] = 'jquery-3.2.1.min.js'; ?>
<?php $asset_js[] = 'bootstrap.min.js'; ?>
<?php $asset_js[] = 'revslider.js'; ?>
<?php $asset_js[] = 'common.js'; ?>
<?php $asset_js[] = 'owl.carousel.min.js'; ?>
<?php $asset_js[] = 'jquery.mobile-menu.min.js'; ?>
<?php $asset_js[] = 'countdown.js'; ?>
<?php //$asset_js[] = 'plugins/toastr/toastr.min.js'; ?>
<?php //$asset_js[] = 'plugins/select2/dist/js/select2.min.js'; ?>
<?php //$asset_js[] = 'plugins/jssocials/dist/jssocials.min.js'; ?>
<?php $asset_js[] = 'jquery.form.min.js'; ?>
<?php $asset_js[] = 'custom.js'; ?>
<?php $this->minify->js($asset_js);
echo $this->minify->deploy_js(); ?>
</body>
</html>
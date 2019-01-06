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
    <meta name="theme-color" content="#be1e2d">
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
        <meta property="og:image"
              content="<?php echo !empty($this->settings['homepage_thumbnail']) ? getImageThumb($this->settings['homepage_thumbnail'], 200, 200, true, false) : getImageThumb('', 200, 200); ?>"/>
        <meta property="og:url" content="<?php echo base_url(); ?>"/>
        <!--Meta Facebook Homepage-->
        <link rel="canonical" href="<?php echo base_url(); ?>"/>
    <?php endif; ?>

    <link rel="icon"
          href="<?php echo !empty($this->settings['favicon']) ? getImageThumb($this->settings['favicon'], '', '', false, false) : $this->templates_assets . "favicon.ico"; ?>"
          sizes="32x32">
    <link rel="icon"
          href="<?php echo !empty($this->settings['favicon']) ? getImageThumb($this->settings['favicon'], '', '', false, false) : $this->templates_assets . "favicon.ico"; ?>"
          sizes="192x192">
    <link rel="apple-touch-icon-precomposed"
          href="<?php echo !empty($this->settings['favicon']) ? getImageThumb($this->settings['favicon'], '', '', false, false) : $this->templates_assets . "favicon.ico"; ?>">
    <meta name="msapplication-TileImage"
          content="<?php echo !empty($this->settings['favicon']) ? getImageThumb($this->settings['favicon'], '', '', false, false) : $this->templates_assets . "favicon.ico"; ?>">

    <script type="text/javascript">
        WebFontConfig = {
            google: {
                families: [
                    "Nunito+Sans:400,400italic,500,600,700,700italic:vietnamese",
                    "Open+Sans:400,400italic,700,700italic:vietnamese",
                ]
            },
            custom: {
                families: [
                    'FontAwesome',
                    'Simple-Line-Icons'
                ],
                urls: [
                    '/public/plugins/font-awesome-4.7.0/css/font-awesome.css',
                    '/public/plugins/simple-line-icons-master/css/simple-line-icons.css'
                ]
            },
            timeout: 2000
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>
    <?php $asset_css[] = 'bootstrap.min.css'; ?>
    <?php $asset_css[] = 'owl.carousel.css'; ?>
    <?php $asset_css[] = 'owl.theme.css'; ?>
    <?php $asset_css[] = 'jquery.bxslider.css'; ?>
    <?php $asset_css[] = 'jquery.mobile-menu.css'; ?>
    <?php $asset_css[] = 'style.css'; ?>
    <?php $asset_css[] = 'revslider.css'; ?>
    <?php $asset_css[] = 'bootstrap-social.css'; ?>
    <?php $asset_css[] = 'fancybox.css'; ?>

    <?php $asset_css[] = '../plugins/jssocials/jssocials.css'; ?>
    <?php $asset_css[] = '../plugins/jssocials/jssocials-theme-flat.css'; ?>

    <?php $asset_css[] = '../plugins/toastr/toastr.min.css'; ?>
    <?php $asset_css[] = '../plugins/rateit/rateit.css'; ?>
    <?php $asset_css[] = 'select2.min.css'; ?>
    <?php $asset_css[] = 'blogmate.css'; ?>
    <?php $asset_css[] = 'custom.css'; ?>
    <?php $asset_css[] = 'menu.css'; ?>

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

    <script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "ElectronicsStore",
	"name": "Zin Viet Nam Company Limited",
	"address": {
		"@type": "PostalAddress",
		"streetAddress": "241 Le Loi, Minh Khai",
		"addressLocality": "Phu Ly",
		"addressRegion": "Hanam",
		"postalCode": "40000"
	},
	"image": "https://zinlinhkien.com.vn/public/media/thumb/ZIN-LOGO-500-260x50.png",
	"email": "admin@zinlinhkien.com.vn",
	"telePhone": "1900-299-922",
	"url": "zinlinhkien.com.vn",
	"paymentAccepted": [ "cash", "check", "credit card", "invoice", "paypal" ],
	"openingHours": "Mo,Tu,We,Th,Fr,Sa 08:00-19:00",
	"openingHoursSpecification": [ {
		"@type": "OpeningHoursSpecification",
		"dayOfWeek": [
			"Monday",
			"Tuesday",
			"Wednesday",
			"Thursday",
			"Friday",
			"Saturday"
		],
		"opens": "08:00",
		"closes": "19:00"
	} ],
	"geo": {
		"@type": "GeoCoordinates",
		"latitude": "20.542285",
		"longitude": "105.922401"
	},
	"priceRange":"$$$$$"

}

    </script>


    <script>
        var urlCurrentMenu = window.location.href,
            urlCurrent = window.location.href,
            base_url = '<?php echo base_url(); ?>',
            media_url = '<?php echo MEDIA_URL . '/'; ?>',
            script_folder = '<?php echo BASE_SCRIPT_NAME; ?>',
            csrf_cookie_name = '<?php echo $this->config->item('csrf_cookie_name') ?>',
            csrf_token_name = '<?php echo $this->security->get_csrf_token_name() ?>',
            csrf_token_hash = '<?php echo $this->security->get_csrf_hash() ?>',
            mobileDetect = '<?php echo $this->agent->is_mobile() ? true : false ?>'
        ;
    </script>
    <?php echo !empty($this->settings['script_head']) ? $this->settings['script_head'] : '' ?>
</head>
<?php
switch ($this->_controller) {
    case 'product':
        $classBody = $this->_method === 'category' ? 'grid-page' : 'category-page';
        break;
    default:
        $classBody = 'cms-index-index cms-home-page';
}
?>
<body class="<?php echo $classBody ?>">
<div id="fb-root"></div>
<div id="page">
    <?php $this->load->view($this->template_path . '_header') ?>
    <?php echo !empty($main_content) ? $main_content : '' ?>
    <?php $this->load->view($this->template_path . '_footer') ?>
</div>
<!-- mobile menu -->
<div id="mobile-menu">
    <?php echo navMenuMain('mobile-menu') ?>
    <div class="top-links">

        <ul class="links">
            <?php if ($this->session->userdata('is_logged')): ?>
                <li>
                    <a title="Tài khoản" href="<?php echo base_url('auth') ?>">
                        <span class="hidden-xs">Tài khoản</span>
                    </a>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?php echo base_url('auth/window/Facebook') ?>" title="Đăng nhập Facebook"
                       class="btn btn-block btn-social btn-facebook">
                        <span class="fa fa-facebook"></span>
                        Đăng nhập Facebook
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('auth/window/Google') ?>" title="Đăng nhập Google"
                       class="btn btn-block btn-social btn-google">
                        <span class="fa fa-google-plus"></span>
                        Đăng nhập Google
                    </a>
                </li>
                <li>
                    <a href="https://oauth.zaloapp.com/v3/auth?app_id=<?php echo ZALO_APP_ID_CFG ?>&redirect_uri=<?php echo urlencode(ZALO_CAL_BACK) ?>"
                       title="Đăng nhập Zalo"
                       class="btn btn-block btn-social btn-zalo">
                        <span class="fa fa-zalo"></span>
                        Đăng nhập Zalo
                    </a>
                </li>
            <?php endif; ?>
            <li>
                <a title="Checkout" href="<?php echo base_url('wishlisht') ?>">
                    <span class="hidden-xs">Sản phẩm yêu thích</span>
                </a>
            </li>
            <li class="last">
                <a title="Lịch sử đơn hàng" href="<?php echo base_url('cart/history') ?>">
                    <span class="hidden-xs">Lịch sử đơn hàng</span>
                </a>
            </li>
        </ul>
    </div>
</div>


<!--<div id="popup_newsletter" style="display: none;" class="popup1">
  <div class="newsletter-sign-box">
    <div class="newsletter">
        <a href="javascript:;" title="<?php /*echo $this->settings['title'] */ ?>" rel="nofollow" class="x">
            <img src="<?php /*echo $this->templates_assets */ ?>images/f-box-close-icon.png" alt="close">
        </a>
      <?php /*echo form_open('contact/subscriber', ['id' => 'popup-newsletter', 'class' => 'email-form']) */ ?>
      <h3>Đăng ký nhận thông tin khuyến mại</h3>
      <h4>Đăng ký email với chúng tôi để chúng tôi tự động thông báo chương trình khuyến mại một cách nhanh
        nhất.</h4>
      <div class="newsletter-form">
        <div class="input-box">
          <input type="text" class="input-text required-entry validate-email" placeholder="Nhập email của bạn"
                 id="newsletter2" name="email">
          <button class="button subscribe" title="Đăng ký" type="submit"><span>Đăng ký</span></button>
          <img style="display:none;margin-left:120px;margin-top:10px;" id="loader1" alt="Loading"
               src="<?php /*echo $this->templates_assets */ ?>images/loading.gif">
        </div>
      </div>
      <?php /*echo form_close() */ ?>
      <label class="subscribe-bottom"><input type="checkbox" id="notshowpopup" name="notshowpopup">Không hiển thị
        lại cửa sổ này. </label>
    </div>
  </div>
</div>-->

<?php $this->load->view($this->template_path . 'product/_quick_view') ?>

<div id="overlay" style="display: none;"></div>

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
<?php $asset_js[] = 'cloud-zoom.js'; ?>
<?php $asset_js[] = 'lazyload.min.js'; ?>
<?php $asset_js[] = '../plugins/toastr/toastr.min.js'; ?>
<?php $asset_js[] = '../plugins/rateit/jquery.rateit.min.js'; ?>
<?php $asset_js[] = '../plugins/jssocials/jssocials.min.js'; ?>
<?php $asset_js[] = 'jquery.form.min.js'; ?>
<?php $asset_js[] = 'jquery.sticky-kit.min.js'; ?>
<?php $asset_js[] = 'select2.min.js'; ?>
<?php $asset_js[] = 'custom.js'; ?>
<?php $asset_js[] = 'account.js'; ?>
<?php $this->minify->js($asset_js);
echo $this->minify->deploy_js(); ?>
<script type="text/javascript">
    $(document).ready(function () {
        toastr.options.escapeHtml = true;
        toastr.options.closeButton = true;
        toastr.options.positionClass = "toast-bottom-right";
        toastr.options.timeOut = 5000;
        toastr.options.showMethod = 'fadeIn';
        toastr.options.hideMethod = 'fadeOut';
        <?php if(!empty($this->session->flashdata('message'))): ?>
        toastr.<?php echo $this->session->flashdata('type'); ?>('<?php echo trim(strip_tags($this->session->flashdata('message'))); ?>');
        <?php
        unset($_SESSION['message']);
        endif; ?>
        setTimeout(sdkInit(), 4000);
    });

    function sdkInit() {
        window.fbAsyncInit = function () {
            FB.init({
                appId: '<?php echo FB_API ?>',
                cookie: true,
                xfbml: true,
                version: '<?php echo FB_VER ?>'
            });

            FB.AppEvents.logPageView();

        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    }
</script>
<?php if (GG_CAPTCHA_MODE == true): ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>
<?php echo !empty($this->settings['script_body']) ? $this->settings['script_body'] : '' ?>
</body>
</html>
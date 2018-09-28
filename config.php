<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 05/12/2017
 * Time: 4:34 CH
 */
$root = str_replace('\\','/',dirname(__FILE__));
$domain = $_SERVER['HTTP_HOST'];
$script_name = str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
$domain .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
$base = "http://" . $domain;
if (!empty($_SERVER['HTTPS'])) $base = "https://" . $domain;
define('BASE_URL', $base);
define('BASE_ADMIN_URL', $base."admin/");
define('BASE_SCRIPT_NAME', $script_name);
define('MEDIA_NAME',"public/media/"); //Tên đường dẫn lưu media
define('MEDIA_PATH',$root.'/'.MEDIA_NAME); //Đường dẫn lưu media
define('MEDIA_URL',BASE_URL . MEDIA_NAME);

define('DB_DEFAULT_HOST','localhost'); //DB HOST
define('DB_DEFAULT_USER','root'); //DB USER
define('DB_DEFAULT_PASSWORD','Abcd1234@'); //DB PASSWORD
define('DB_DEFAULT_NAME','sportshop'); //DB NAME

define('MAINTAIN_MODE',FALSE); //Bảo trì
define('DEBUG_MODE',TRUE);
define('CACHE_MODE',TRUE);
define('CACHE_TIMEOUT_LOGIN',1800);


define('FB_API','383863395372857');
define('FB_SECRET','5d0fa0a80a67db2a6d0fd72bd27f7750');
define('FB_VER','v2.9');

define('GG_API','778836651692-hn9srbboktca7kke49lg9uq88amq0cl7.apps.googleusercontent.com');
define('GG_SECRET','P5BJVSsjeDkyvqm-mvZ-z-Mh');
define('GG_KEY','AIzaSyCfmCVTjRI007pC1Yk2o2d_EhgkjTsFVN8');//AIzaSyAhR8OG9cUL1jDfAAc6i35nt5Ki1ZJnykA
define('GG_CAPTCHA_SITE_KEY','6LevJWcUAAAAAMi7qfknK1bnVNd8sjQPcrShoZjC');
define('GG_CAPTCHA_SECRET_KEY','6LevJWcUAAAAAHE2cjYE-Kfy5LiHEnSl7bpj_Ssq');

<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 14/12/2017
 * Time: 10:07 SA
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
</head>
<body onload="loadMoxman()">
<script src="<?php echo $this->templates_assets ?>assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="<?php echo $this->templates_assets;?>plugins/moxiemanager/js/moxman.loader.min.js"></script>
<script src="<?php echo $this->templates_assets;?>js/page/media.js"></script>
</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 8/13/2018
 * Time: 4:30 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<body>
<table align="center" bgcolor="#eeeeee" border="0" cellpadding="0" cellspacing="0"
       style="background:#eeeeee;border-collapse:collapse;line-height:100%!important;margin:0;padding:0;width:100%!important">
    <tbody>
    <tr>
        <td>
            <table style="border-collapse:collapse;margin:auto;max-width:635px;min-width:320px;width:100%">
                <tbody>
                <tr>
                    <td>
                        <table style="border-collapse:collapse;color:#c0c0c0;font-family:'Helvetica Neue',Arial,sans-serif;font-size:13px;line-height:26px;margin:0 auto 26px;width:100%">
                            <tbody>
                            <tr>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table align="center" border="0" cellspacing="0"
                               style="border-collapse:collapse;border-radius:3px;color:#545454;font-family:'Helvetica Neue',Arial,sans-serif;font-size:13px;line-height:20px;margin:0 auto;width:100%">
                            <tbody>
                            <tr>
                                <td>
                                    <table border="0" cellpadding="0" cellspacing="0"
                                           style="border:none;border-collapse:separate;font-size:1px;height:2px;line-height:3px;width:100%">
                                        <tbody>
                                        <tr>
                                            <td bgcolor="#007fff" valign="top"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" height="100%"
                                           id="m_3332006583715546621backgroundTable"
                                           style="border-collapse:collapse;border-color:#dddddd;border-radius:0 0 3px 3px;border-style:solid;border-width:1px;width:100%"
                                           width="100%">
                                        <tbody>
                                        <tr>
                                            <td align="center" valign="top">
                                                <table border="0" cellpadding="0" cellspacing="0"
                                                       id="m_3332006583715546621templateHeader" width="100%">
                                                    <tbody>
                                                    <tr>
                                                        <td align="center" class="m_3332006583715546621headerContent" style="background:#ffffff">
                                                            <a class="m_3332006583715546621logo" href="<?php echo BASE_URL; ?>" target="_blank">
                                                                <img alt="⚛" src="<?php echo BASE_URL; ?>/public/media/logo.png" style="margin-top:25px" class="CToWUd">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background:white;color:#525252;font-family:'Helvetica Neue',Arial,sans-serif;font-size:15px;line-height:22px;overflow:hidden;padding:40px 40px 30px">
                                                <p>
                                                    <span>Xin chào <b>BQT</b>,</span>
                                                </p>
                                                <p>Bạn vừa có 1 đơn hàng mới:</p>
                                                <p>Danh sách đơn hàng: </p>
                                                <table border="1" style="border-collapse: collapse;width: 100%">
                                                    <thead>
                                                    <tr>
                                                        <th  align="center">Ảnh</th>
                                                        <th align="center">Tên</th>
                                                        <th align="center">Số tiền</th>
                                                        <th align="center">Số tiền nhận</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if (!empty($orderDetail)) foreach ($orderDetail as $items):
                                                        $oneProduct = getProduct($items['id']);
                                                        $pointProduct = !empty($oneProduct->price_sale) ? $oneProduct->price_sale : $oneProduct->price;
                                                        $pointAdminReceived = round($pointProduct * ($this->settings['config']['commission_percent']/100));
                                                    ?>
                                                        <tr>
                                                            <td align="center">
                                                                <a href="<?php echo getUrlProduct($oneProduct) ?>" target="_blank" title="<?php echo $oneProduct->title; ?>">
                                                                    <img src="<?php echo getImageThumb($oneProduct->thumbnail,70,70) ?>" alt="<?php echo $oneProduct->title; ?>">
                                                                </a>
                                                            </td>
                                                            <td align="center">
                                                                <a href="<?php echo getUrlProduct($oneProduct) ?>" target="_blank" title="<?php echo $oneProduct->title; ?>"><?php echo $oneProduct->title; ?></a>
                                                            </td>
                                                            <td align="center"><strong><?php echo $oneProduct->price ?></strong> đ</td>
                                                            <td align="center"><strong> +<?php echo $pointAdminReceived ?></strong> đ</td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top">
                                                <table border="0" cellpadding="10" cellspacing="0"
                                                       id="m_3332006583715546621templateFooter" width="100%">
                                                    <tbody>
                                                    <tr>
                                                        <td class="m_3332006583715546621footerContent" valign="top">
                                                            <table border="0" cellpadding="10" cellspacing="0"
                                                                   width="100%">
                                                                <tbody>
                                                                <tr>
                                                                    <td valign="top" width="350">
                                                                        <div><a href="<?php echo base_url(); ?>" target="_blank"><?php echo $this->settings['name'] ?></a>
                                                                            - <?php echo $this->settings['title'] ?><br>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <br></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="20" valign="top"></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>

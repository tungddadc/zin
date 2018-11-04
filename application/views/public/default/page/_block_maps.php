<?php
/**
 * Created by PhpStorm.
 * User: Steven Nguyen
 * Date: 18/03/2018
 * Time: 9:52 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed');
$showroom = $this->settings['showroom'][$this->session->public_lang_code];
?>
<div class="map-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div id="page-map"></div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <?php if(!empty($showroom)) foreach ($showroom as $k => $item): $item = (object) $item; ?>
                        <div class="col-md-6">
                            <div class="map-box">
                                <div class="map-box__title"><?php echo $k+1 ?>. <?php echo $item->title ?></div>
                                <div class="map-box__content">
                                    <div class="map-box__item">
                                        <span class="icon_pin map-box__icon"></span>
                                        <span><?php echo $item->address ?></span>
                                    </div>
                                    <div class="map-box__item">
                                        <span class="icon_phone map-box__icon"></span>

                                    </div><a href="tel:<?php echo $item->phone ?>" title="<?php echo $item->phone ?>"><?php echo $item->phone ?></a>
                                    <div class="map-box__item">
                                        <span class="icon_printer map-box__icon"></span>
                                        <a href="javascript:;" title="<?php echo $item->fax ?>"><?php echo $item->fax ?></a>
                                    </div>
                                    <a href="javascript:showMap(<?php echo $k ?>);"  class="btn btn--primary map-box__btn">View map</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

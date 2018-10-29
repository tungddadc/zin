<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 9/30/2018
 * Time: 1:10 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="m-content">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <?php echo form_open("admin/setting"); ?>
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <div class="form-group m-form__group row align-items-center">
                            <div class="col-md-4">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label>
                                            Trạng thái:
                                        </label>
                                    </div>
                                    <div class="m-form__control">
                                        <select class="form-control m-bootstrap-select" name="is_status">
                                            <option value="">
                                                All
                                            </option>
                                            <option value="1">
                                                Kích hoạt
                                            </option>
                                            <option value="0">
                                                Khóa
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>
                            <div class="col-md-8">
                                <div class="m-input-icon m-input-icon--left">
                                    <input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
                                    <span class="m-input-icon__icon m-input-icon__icon--left">
                                        <span>
                                            <i class="la la-search"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                        <a href="javascript:;" class="btn btn-primary m-btn m-btn--icon m-btn--air m-btn--pill btnAddForm">
                            <span>
                                <i class="la la-plus"></i>
                                <span>
                                    Add
                                </span>
                            </span>
                        </a>
                        <a href="javascript:;" class="btn btn-danger m-btn m-btn--icon m-btn--air m-btn--pill btnDeleteAll">
                            <span>
                                <i class="la la-remove"></i>
                                <span>
                                    Delete
                                </span>
                            </span>
                        </a>
                        <a href="javascript:;" class="btn btn-info m-btn m-btn--icon m-btn--air m-btn--pill btnReload">
                            <span>
                                <i class="la la-refresh"></i>
                                <span>Refresh</span>
                            </span>
                        </a>
                        <div class="m-separator m-separator--dashed d-xl-none"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_general" data-toggle="tab"><?php echo lang('tab_general'); ?></a></li>
                            <li><a href="#tab_contact" data-toggle="tab">Liên hệ</a></li>
                            <li><a href="#tab_block" data-toggle="tab">Tùy chỉnh block</a></li>
                            <li><a href="#tab_config" data-toggle="tab">Cấu hình tài khoản</a></li>
                            <li><a href="#tab_popup" data-toggle="tab">Quảng cáo</a></li>
                            <li><a href="#tab_social" data-toggle="tab"><?php echo lang('tab_social'); ?></a></li>
                            <li><a href="#tab_image" data-toggle="tab"><?php echo lang('tab_image'); ?></a></li>
                            <li><a href="#tab_system" data-toggle="tab"><?php echo lang('tab_system'); ?></a></li>
                            <li><a href="#tab_backup" data-toggle="tab"><?php echo lang('tab_backup');?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_general">

                                <ul class="nav nav-tabs">
                                    <?php foreach ($this->config->item('cms_language') as $lang_code => $lang_name) { ?>
                                        <li<?php echo ($lang_code == 'vi') ? ' class="active"' : ''; ?>><a
                                                    href="#tab_<?php echo $lang_code; ?>"
                                                    data-toggle="tab"><img src="<?php echo $this->templates_assets;?>/flag/<?php echo $lang_code ?>.png"> <?php echo $lang_name; ?></a></li>
                                    <?php } ?>
                                </ul>

                                <div class="tab-content">
                                    <?php foreach ($this->config->item('cms_language') as $lang_code => $lang_name) { ?>
                                        <div class="tab-pane <?php echo ($lang_code == 'vi') ? 'active' : ''; ?>" id="tab_<?php echo $lang_code; ?>">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label><?php echo lang('form_name'); ?></label>
                                                    <input name="meta[<?php echo $lang_code; ?>][name]"
                                                           placeholder="<?php echo lang('form_name'); ?>"
                                                           class="form-control" type="text"
                                                           value="<?php echo isset($meta[$lang_code]['name']) ? $meta[$lang_code]['name'] : ''; ?>"/>
                                                </div>

                                                <div class="form-group">
                                                    <label>Tiêu đề SEO</label>
                                                    <input name="meta[<?php echo $lang_code; ?>][title]"
                                                           placeholder="Tiêu đề SEO"
                                                           class="form-control" type="text"
                                                           value="<?php echo isset($meta[$lang_code]['title']) ? $meta[$lang_code]['title'] : ''; ?>"/>
                                                </div>

                                                <div class="form-group">
                                                    <label>Mô tả SEO Website</label>
                                                    <textarea name="meta[<?php echo $lang_code; ?>][meta_desc]" class="form-control"><?php echo isset($meta[$lang_code]['meta_desc']) ? $meta[$lang_code]['meta_desc'] : ''; ?></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Từ khóa SEO Website</label>
                                                    <input name="meta[<?php echo $lang_code; ?>][meta_keyword]"
                                                           placeholder="Từ khóa SEO Website"
                                                           class="form-control" type="text"
                                                           value="<?php echo isset($meta[$lang_code]['meta_keyword']) ? $meta[$lang_code]['meta_keyword'] : ''; ?>"/>
                                                </div>

                                                <div class="form-group">
                                                    <label>Địa chỉ trụ sở chính</label>
                                                    <input name="meta[<?php echo $lang_code; ?>][address]" class="form-control" value="<?php echo isset($meta[$lang_code]['address']) ? $meta[$lang_code]['address'] : ''; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Địa chỉ văn phòng</label>
                                                    <input name="meta[<?php echo $lang_code; ?>][address_office]" class="form-control" value="<?php echo isset($meta[$lang_code]['address_office']) ? $meta[$lang_code]['address_office'] : ''; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Hotline</label>
                                                    <input name="meta[<?php echo $lang_code; ?>][hotline]" class="form-control" value="<?php echo isset($meta[$lang_code]['hotline']) ? $meta[$lang_code]['hotline'] : ''; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Email Hotline</label>
                                                    <input name="meta[<?php echo $lang_code; ?>][email]" class="form-control" value="<?php echo isset($meta[$lang_code]['email']) ? $meta[$lang_code]['email'] : ''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <label>Chèn script ở Head</label>
                                        <textarea name="script_head" rows="10" class="form-control"><?php echo !empty($script_head) ? $script_head : '' ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Chèn script ở trước Body đóng</label>
                                        <textarea name="script_body" rows="10" class="form-control"><?php echo !empty($script_body) ? $script_body : '' ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Script Short Url auto</label>
                                        <textarea name="script_short_url" rows="10" class="form-control"><?php echo !empty($script_short_url) ? $script_short_url : '' ?></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="tab_popup">
                                <div class="form-group">
                                    <label>Banner Popup</label>
                                    <div class="input-group input-group-lg">
                                    <span class="input-group-addon" onclick="chooseImage('popup_banner')"
                                          data-toggle="tooltip" title="<?php echo lang('btn_select_image'); ?>">
                                        <i class="fa fa-fw fa-image"></i>
                                    </span>
                                        <input onclick="chooseImage('popup_banner')" id="popup_banner" name="block[popup][image]" placeholder="Banner ..." class="form-control" value="<?php echo !empty($block['popup']['image']) ? $block['popup']['image'] : '' ?>" type="text"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Bật tắt quảng cáo</label> <br>
                                    <input type="radio" name="block[popup][enable]" value="1" id="on"
                                        <?php if (!empty($block['popup']['enable']) == "1")  {
                                            echo "checked";
                                        }?> > Bật<br>
                                    <input type="radio" name="block[popup][enable]" value="0" id="off"
                                        <?php if (!empty($block['popup']['enable'])== "0") {
                                            echo "checked";
                                        } ?>> Tắt
                                </div>
                                <div class="form-group">
                                    <label>Link</label>
                                    <input type="text" name="block[popup][link]" placeholder="Link" value="<?php echo !empty($block['popup']['link']) ? $block['popup']['link'] : '' ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Thời gian hiện khi vào trang web (Nhập số giây)</label>
                                    <input type="number" name="block[popup][time_start]" value="<?php echo !empty($block['popup']['time_start']) ? $block['popup']['time_start'] : '30' ?>" class="form-control">
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_config">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Giới hạn download miễn phí (Theo IP): </label>
                                            <input type="text" name="config[limit_download_free]" class="form-control" value="<?php echo isset($config['limit_download_free'])?$config['limit_download_free']:5; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Cấu hình hoa hồng (%): </label>
                                            <input type="text" name="config[commission_percent]" class="form-control" value="<?php echo isset($config['commission_percent'])?$config['commission_percent']:5; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <fieldset>
                                            <legend>Cấu hình tài khoản thường</legend>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label>Giá mua 1 điểm (đồng): </label>
                                                    <input type="text" name="config[point_fee]" class="form-control" value="<?php echo isset($config['point_fee'])?$config['point_fee']:'1000'; ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label>Mức mua tổi thiểu (điểm): </label>
                                                    <input type="text" name="config[point_buy_min]" class="form-control" value="<?php echo isset($config['point_buy_min'])?$config['point_buy_min']:'50'; ?>"/>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-xs-12">
                                        <fieldset>
                                            <legend>Cấu hình VIP</legend>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label>Bật khuyến mại: </label>
                                                    <input type="checkbox" name="config[vip_promotion][is_active]" class="bootstrapSwitch" <?php echo isset($config['vip_promotion']['is_active'])?'checked':''; ?>/>
                                                </div>

                                                <div class="form-group">
                                                    <label>Thời gian Khuyến mại VIP cho tất cả tài khoản: </label>
                                                    <input type="text" name="config[vip_promotion][datetime]" class="form-control daterange" value="<?php echo isset($config['vip_promotion']['datetime'])?$config['vip_promotion']['datetime']:''; ?>"/>
                                                </div>

                                                <div class="form-group">
                                                    <label>Giá giá (%): </label>
                                                    <input type="text" name="config[vip_promotion][value]" class="form-control" value="<?php echo isset($config['vip_promotion']['value'])?$config['vip_promotion']['value']:''; ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label>Danh sách các gói (đơn vị là tháng): </label>
                                                    <input type="text" name="config[vip_list_package]" class="form-control" placeholder="1|6|12" value="<?php echo isset($config['vip_list_package'])?$config['vip_list_package']:'1|6|12'; ?>"/>
                                                </div>
                                                <?php if(!empty($config['vip_list_package'])):
                                                    $dataPackage = explode('|',$config['vip_list_package']);
                                                    foreach ($dataPackage as $package): ?>
                                                        <div class="form-group">
                                                            <label>Giá gói VIP <?php echo $package ?> tháng (điểm): </label>
                                                            <input type="text" name="config[vip_package][<?php echo $package ?>]" class="form-control" value="<?php echo isset($config['vip_package'][$package])?$config['vip_package'][$package]:''; ?>"/>
                                                        </div>
                                                    <?php endforeach; endif; ?>
                                            </div>
                                        </fieldset>
                                    </div>




                                </div>
                            </div>
                            <div class="tab-pane" id="tab_contact">

                                <ul class="nav nav-tabs">
                                    <?php foreach ($this->config->item('cms_language') as $lang_code => $lang_name) { ?>
                                        <li<?php echo ($lang_code == 'vi') ? ' class="active"' : ''; ?>><a
                                                    href="#tab_contact_<?php echo $lang_code; ?>"
                                                    data-toggle="tab"><img src="<?php echo $this->templates_assets;?>/flag/<?php echo $lang_code ?>.png"> <?php echo $lang_name; ?></a></li>
                                    <?php } ?>
                                </ul>

                                <div class="tab-content">
                                    <?php foreach ($this->config->item('cms_language') as $lang_code => $lang_name) { ?>
                                        <div class="tab-pane <?php echo ($lang_code == 'vi') ? 'active' : ''; ?>" id="tab_contact_<?php echo $lang_code; ?>">
                                            <div class="box-body">

                                                <div class="form-group">
                                                    <label>Tên công ty</label>
                                                    <input name="contact[<?php echo $lang_code; ?>][title]"
                                                           placeholder="Tên công ty"
                                                           class="form-control" type="text"
                                                           value="<?php echo !empty($contact[$lang_code]['title']) ? $contact[$lang_code]['title'] : ''; ?>"/>
                                                </div>

                                                <div class="form-group">
                                                    <label>Trụ sở chính</label>
                                                    <input name="contact[<?php echo $lang_code; ?>][address]"
                                                           placeholder="Địa chỉ"
                                                           class="form-control" type="text"
                                                           value="<?php echo !empty($contact[$lang_code]['address']) ? $contact[$lang_code]['address'] : ''; ?>"/>
                                                </div>

                                                <div class="form-group">
                                                    <label>Mua hàng & CSKH</label>
                                                    <input name="contact[<?php echo $lang_code; ?>][phone]"
                                                           placeholder="Mua hàng & CSKH"
                                                           class="form-control" type="text"
                                                           value="<?php echo !empty($contact[$lang_code]['phone']) ? $contact[$lang_code]['phone'] : ''; ?>"/>
                                                </div>

                                                <div class="form-group">
                                                    <label>Tư vấn kỹ thuật</label>
                                                    <input name="contact[<?php echo $lang_code; ?>][phone1]"
                                                           placeholder="Tư vấn kỹ thuật"
                                                           class="form-control" type="text"
                                                           value="<?php echo !empty($contact[$lang_code]['phone1']) ? $contact[$lang_code]['phone1'] : ''; ?>"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Liên hệ làm đại lý</label>
                                                    <input name="contact[<?php echo $lang_code; ?>][phone2]"
                                                           placeholder="Liên hệ làm đại lý"
                                                           class="form-control" type="text"
                                                           value="<?php echo !empty($contact[$lang_code]['phone2']) ? $contact[$lang_code]['phone2'] : ''; ?>"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mời quảng cáo</label>
                                                    <input name="contact[<?php echo $lang_code; ?>][phone3]"
                                                           placeholder="Mời quảng cáo"
                                                           class="form-control" type="text"
                                                           value="<?php echo !empty($contact[$lang_code]['phone3']) ? $contact[$lang_code]['phone3'] : ''; ?>"/>
                                                </div>

                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input name="contact[<?php echo $lang_code; ?>][email]"
                                                           placeholder="mail"
                                                           class="form-control" type="text"
                                                           value="<?php echo !empty($contact[$lang_code]['email']) ? $contact[$lang_code]['email'] : ''; ?>"/>
                                                </div>

                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <label>Địa chỉ Google maps </label>
                                        <div class="row">
                                            <div class="col-sm-6 col-xs-12">
                                                <input name="contact[maps_latitude]"
                                                       placeholder="Kinh độ (latitude)"
                                                       class="form-control" type="text"
                                                       value="<?php echo !empty($contact['maps_latitude']) ? $contact['maps_latitude'] : ''; ?>"/>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <input name="contact[maps_longitude]"
                                                       placeholder="Vĩ độ (longitude)"
                                                       class="form-control" type="text"
                                                       value="<?php echo !empty($contact['maps_longitude']) ? $contact['maps_longitude'] : ''; ?>"/>
                                            </div>
                                            <!-- <div class="col-sm-12 col-xs-12">
                                        <input name="contact[url_map]"
                                               placeholder="url map"
                                               class="form-control" type="text"
                                               value="<?php echo !empty($contact['url_map']) ? $contact['url_map'] : ''; ?>"/>
                                    </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_files">
                                <div class="form-group">
                                    <label>File CV mẫu</label>
                                    <div class="input-group">
                                        <span class="input-group-addon" onclick="chooseFiles('files')"><i class="fa fa-fw fa-file-pdf-o"></i></span>
                                        <input id="files" name="files" value="<?php echo !empty($files) ? $files : '' ?>" placeholder="files" class="form-control" type="text" />
                                    </div>
                                </div>


                            </div>
                            <div class="tab-pane" id="tab_block">

                            </div>

                            <div class="tab-pane" id="tab_social">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label><?php echo lang('form_social_fb'); ?></label>
                                        <input name="social_fb" placeholder="<?php echo lang('form_social_fb'); ?>"
                                               class="form-control" type="text"
                                               value="<?php echo isset($social_fb) ? $social_fb : ''; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('form_social_google'); ?></label>
                                        <input name="social_google"
                                               placeholder="<?php echo lang('form_social_google'); ?>"
                                               class="form-control" type="text"
                                               value="<?php echo isset($social_google) ? $social_google : ''; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('form_social_twitter'); ?></label>
                                        <input name="social_twitter"
                                               placeholder="<?php echo lang('form_social_twitter'); ?>"
                                               class="form-control" type="text"
                                               value="<?php echo isset($social_twitter) ? $social_twitter : ''; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('form_social_youtube'); ?></label>
                                        <input name="social_youtube"
                                               placeholder="<?php echo lang('form_social_youtube'); ?>"
                                               class="form-control" type="text"
                                               value="<?php echo isset($social_youtube) ? $social_youtube : ''; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('form_social_instagram'); ?></label>
                                        <input name="social_instagram"
                                               placeholder="<?php echo lang('form_social_instagram'); ?>"
                                               class="form-control" type="text"
                                               value="<?php echo isset($social_instagram) ? $social_instagram : ''; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('form_social_tumblr'); ?></label>
                                        <input name="social_tumblr"
                                               placeholder="<?php echo lang('form_social_tumblr'); ?>"
                                               class="form-control" type="text"
                                               value="<?php echo isset($social_tumblr) ? $social_tumblr : ''; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('form_social_linkedin'); ?></label>
                                        <input name="social_linkedin"
                                               placeholder="<?php echo lang('form_social_linkedin'); ?>"
                                               class="form-control" type="text"
                                               value="<?php echo isset($social_linkedin) ? $social_linkedin : ''; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Pinterest</label>
                                        <input name="social_pinterest"
                                               placeholder="Pinterest"
                                               class="form-control" type="text"
                                               value="<?php echo isset($social_pinterest) ? $social_pinterest : ''; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_image">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label><?php echo lang('form_favicon'); ?></label>
                                        <div class="input-group input-group-lg">
                                        <span class="input-group-addon" onclick="chooseImage('favicon')"
                                              data-toggle="tooltip" title="<?php echo lang('btn_select_image'); ?>"><i
                                                    class="fa fa-fw fa-image"></i></span>
                                            <input id="favicon" name="favicon"
                                                   value="<?php echo isset($favicon) ? $favicon : ''; ?>"
                                                   placeholder="<?php echo lang('form_favicon'); ?>" class="form-control"
                                                   type="text"/>
                                            <span class="input-group-addon"><a class="fancybox"
                                                                               href="<?php echo getImageThumb(isset($favicon) ? $favicon : '') ?>"
                                                                               title="Click để xem ảnh"> <img
                                                            src="<?php echo getImageThumb(isset($favicon) ? $favicon : '') ?>"
                                                            width="30"></a> </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo lang('form_logo'); ?></label>
                                        <div class="input-group input-group-lg">
                                        <span class="input-group-addon" onclick="chooseImage('logo')"
                                              data-toggle="tooltip" title="<?php echo lang('btn_select_image'); ?>"><i
                                                    class="fa fa-fw fa-image"></i></span>
                                            <input id="logo" name="logo" value="<?php echo isset($logo) ? $logo : ''; ?>"
                                                   placeholder="<?php echo lang('form_logo'); ?>" class="form-control"
                                                   type="text"/>
                                            <span class="input-group-addon"><a class="fancybox"
                                                                               href="<?php echo getImageThumb(isset($logo) ? $logo : '') ?>"
                                                                               title="Click để xem ảnh"> <img
                                                            src="<?php echo getImageThumb(isset($logo) ? $logo : '', 64, 45) ?>"
                                                            width="30"> </a></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Logo Footer</label>
                                        <div class="input-group input-group-lg">
                                        <span class="input-group-addon" onclick="chooseImage('logo_footer')"
                                              data-toggle="tooltip" title="<?php echo lang('btn_select_image'); ?>"><i
                                                    class="fa fa-fw fa-image"></i></span>
                                            <input id="logo_footer" name="logo_footer"
                                                   value="<?php echo isset($logo_footer) ? $logo_footer : ''; ?>"
                                                   placeholder="Logo Footer"
                                                   class="form-control" type="text"/>
                                            <span class="input-group-addon"><a class="fancybox"
                                                                               href="<?php echo getImageThumb(isset($logo_footer) ? $logo_footer : '') ?>"
                                                                               title="Click để xem ảnh"> <img
                                                            src="<?php echo getImageThumb(isset($logo_footer) ? $logo_footer : '', 64, 45) ?>"
                                                            width="30"> </a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_system">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label><?php echo lang('form_reCaptcha'); ?></label>
                                        <input type="checkbox" name="is_reCaptcha"
                                               placeholder="<?php echo lang('form_reCaptcha'); ?>"
                                               class="form-control" <?php if (isset($is_reCaptcha) && $is_reCaptcha === "on") echo "checked"; ?>/>
                                    </div>

                                    <div class="form-group">
                                        <label><?php echo lang('form_email_admin'); ?></label>
                                        <input type="text" name="email_admin"
                                               placeholder="Ví dụ: email@email.com, email2@email.com,..."
                                               class="form-control"
                                               value="<?php echo isset($email_admin) ? $email_admin : ''; ?>"/>
                                    </div>

                                    <!--<div class="form-group">
                                    <label><?php /*echo lang('form_email_server');*/ ?></label>
                                    <input type="text" name="email_server" placeholder="<?php /*echo lang('form_email_server');*/ ?>" class="form-control" value="<?php /*echo isset($email_server)?$email_server:''; */ ?>"/>
                                </div>

                                <div class="form-group">
                                    <label><?php /*echo lang('form_email_server_pass');*/ ?></label>
                                    <input type="text" name="email_server_pass" placeholder="<?php /*echo lang('form_email_server_pass');*/ ?>" class="form-control" value="<?php /*echo isset($email_server)?$email_server:''; */ ?>"/>
                                </div>-->

                                    <div class="form-group">
                                        <label>Protocol</label>
                                        <input type="text" name="protocol" placeholder="Protocol" class="form-control"
                                               value="<?php echo isset($protocol) ? $protocol : ''; ?>"/>
                                    </div>


                                    <div class="form-group">
                                        <label>SMTP Host</label>
                                        <input type="text" name="smtp_host" placeholder="SMTP Host" class="form-control"
                                               value="<?php echo isset($smtp_host) ? $smtp_host : ''; ?>"/>
                                    </div>

                                    <div class="form-group">
                                        <label>SMTP User</label>
                                        <input type="text" name="smtp_user" placeholder="SMTP User" class="form-control"
                                               value="<?php echo isset($smtp_user) ? $smtp_user : ''; ?>"/>
                                    </div>

                                    <div class="form-group">
                                        <label>SMTP Password</label>
                                        <input type="text" name="smtp_pass" placeholder="SMTP Password" class="form-control"
                                               value="<?php echo isset($smtp_pass) ? $smtp_pass : ''; ?>"/>
                                    </div>

                                    <div class="form-group">
                                        <label>SMTP Port</label>
                                        <input type="text" name="smtp_port" placeholder="SMTP Port" class="form-control"
                                               value="<?php echo isset($smtp_port) ? $smtp_port : ''; ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_backup">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Create backup database</label>
                                        <button type="button" class="btn btn-primary btn-ajax-generate-db"> Generate <i class="fa fa-spinner fa-spin" style="display: none"></i> </button>
                                    </div>
                                    <div class="box">
                                        <div class="box-header">
                                            <h3 class="box-title">Danh sách phiên bản backup</h3>
                                        </div>

                                        <div class="alert alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <div class="content-msg"></div>
                                        </div>

                                        <!-- /.box-header -->
                                        <div class="box-body no-padding">
                                            <table id="datatable-database" class="table table-condensed">
                                                <tbody><tr>
                                                    <th class="text-center" style="width: 10px">STT</th>
                                                    <th class="text-center">Tên file</th>
                                                    <th class="text-center">Size</th>
                                                    <th class="text-center">Ngày backup</th>
                                                    <th class="text-center" style="width: 230px">Action</th>
                                                </tr>
                                                <?php if(!empty($list_db)) foreach ($list_db as $j => $db): ?>
                                                    <tr class="text-center">
                                                        <td><?php echo $j+1 ?></td>
                                                        <td class="file-name"><?php echo $db['name'] ?></td>
                                                        <td><?php echo number_format($db['size']) ?> KB</td>
                                                        <td>
                                                            <?php echo date('H:i:s d/m/Y',$db['date']) ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo site_url('admin/setting/downloadFile?file='.$db['name']) ?>" class="btn btn-default btn-sm">Download </a>
                                                            <!--                                                    <a class="btn btn-primary btn-sm btn-ajax-restore-db">Restore <i class="fa fa-spinner fa-spin" style="display: none"></i> </a>-->
                                                            <a class="btn btn-danger btn-sm btn-ajax-delete-db">Delete <i class="fa fa-spinner fa-spin" style="display: none"></i> </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody></table>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
    var url_ajax_backup_db = '<?php echo site_url('admin/setting/ajax_backup_db')?>',
        url_ajax_restore_db = '<?php echo site_url('admin/setting/ajax_restore_db')?>',
        url_ajax_delete_db = '<?php echo site_url('admin/setting/ajax_delete_db')?>'
    ;
</script>
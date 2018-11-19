<!-- Main Container -->
<section class="main-container col2-left-layout">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-sm-push-3">
                <article class="col-main">
                    <div class="page-title">
                        <h1>Liên hệ với <?php echo $this->settings['name'] ?></h1>
                    </div>
                    <div class="static-contain">
                        <fieldset class="group-select account-login">
                            <form class="content sb_form" method="post" action="#">
                                <ul class="form-list">
                                    <li>
                                        <label for="full_name">Họ và tên <span class="required">*</span></label>
                                        <input name="full_name" title="Họ và tên" class="input-text required-entry"
                                               type="text" value="">
                                    </li>
                                    <li>
                                        <label for="email">Email <span class="required">*</span></label>
                                        <input name="email" title="Email" class="input-text required-entry" type="text"
                                               value="">
                                    </li>

                                    <li>
                                        <label for="phone">Số điện thoại</span></label>
                                        <input name="phone" title="Số điện thoại" class="input-text required-entry"
                                               type="text" value="">
                                    </li>
                                    <li>
                                        <label for="address">Địa chỉ</label>
                                        <input name="address" title="Địa chỉ" class="input-text required-entry"
                                               type="text" value="">
                                    </li>
                                    <li>
                                        <label for="content">Nội dung <span class="required">*</span></label>
                                        <textarea name="content" title="content" class="required-entry input-text"
                                                  id="comment" rows="3"
                                                  cols="5"></textarea>
                                    </li>


                                </ul>
                                <div class="buttons-set">
                                    <button name="send" class="button login" type="submit"><span>Gửi</span></button>
                            </form>
                        </fieldset>
                    </div>
                </article>
                <!--	///*///======    End article  ========= //*/// -->
            </div>
            <aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
                <?php $this->load->view($this->template_path . 'page/_sidebar') ?>
            </aside>
        </div>
    </div>
</section>
<!-- Main Container End -->
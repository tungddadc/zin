<?php if (!empty($oneItem)):
  $account=getUserById($oneItem->account_id);

  ?>
  <!-- Main Container -->
  <section class="main-container col2-left-layout">
    <div class="container">
      <div class="main-faq">
        <div class="row row8">
          <div class="col-md-9">
            <div class="row row8">
              <div class="col-md-3">
                <?php $this->load->view($this->template_path . 'faq/left'); ?>
              </div>
              <div class="col-md-9">
                <div class="primary">
                  <form class="search_ask" action="<?php echo site_url('hoi-dap.html') ?>">
                    <input type="text" name="key_search" autocomplete="off" placeholder="Tìm hướng dẫn, mẹo hay, câu hỏi..." value="<?php if(!empty($this->input->get('key_search'))) echo $this->input->get('key_search'); ?>">
                    <button type="submit">Tìm kiếm</button>
                    <i class="iconask-searchask"></i>
                  </form>
                  <div class="content content-detail">
                    <h1><?php echo $oneItem->title ?></h1>
                    <div class="rowuser">
                      <img src="<?php echo getImageThumb($account->avatar,20,20,true) ?>">
                      <?php echo $account->fullname ?>  <span class="span_time"><i class="fa fa-circle" aria-hidden="true"></i><?php echo timeAgo($oneItem->created_time) ?></span>
                    </div>
                    <div class="clearfix"></div>
                    <div style="margin-top: 15px; margin-bottom: 10px">
                      <?php echo $oneItem->content ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="fb-comments" data-href="<?php echo current_url() ?>" width="100%" data-numposts="5"></div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="col-md-3">
            <?php $this->load->view($this->template_path . 'faq/right'); ?>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- Main Container End -->
<?php endif; ?>
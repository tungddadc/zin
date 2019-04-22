<?php if (!empty($oneItem)):
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
                  <form class="search_ask" action="#">
                    <input type="text" name="key_search" autocomplete="off" placeholder="Tìm hướng dẫn, mẹo hay, câu hỏi..." value="<?php if(!empty($this->input->get('key_search'))) echo $this->input->get('key_search'); ?>">
                    <button type="submit">Tìm kiếm</button>
                    <i class="iconask-searchask"></i>
                  </form>
                  <div class="content content-detail">
                    <h1><?php echo $oneItem->title ?></h1>
                    <div class="rowuser">
                      <span><?php echo timeAgo($oneItem->created_time) ?></span>
                    </div>
                    <div class="clearfix"></div>
                    <div style="margin-top: 15px">
                      <?php echo $oneItem->content ?>
                    </div>
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
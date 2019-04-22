<?php if (!empty($oneItem)):
  ?>
  <!-- Main Container -->
  <section class="main-container col2-left-layout">
    <div class="container">
      <div class="main-faq">
        <h1><?php echo $oneItem->title ?></h1>
        <div class="row row8">
          <div class="col-md-9">
            <?php $this->load->view($this->template_path . 'faq/top'); ?>
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
                  <div class="content">
                    <h2>HƯỚNG DẪN, THỦ THUẬT MỚI NHẤT</h2>
                    <?php $this->load->view($this->template_path . 'faq/list-item', array('data' => $data)); ?>
                    <?php if (!empty($pagination)): ?>
                      <div class="pages text-center" style="margin-top: 30px">
                        <?php echo $pagination ?>
                      </div>
                    <?php endif; ?>
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
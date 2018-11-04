<?php
/**
 * Created by PhpStorm.
 * User: Steven Nguyen
 * Date: 16/03/2018
 * Time: 5:26 CH
 */
defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php if (!empty($category)):
    $oneItem = $category;
    ?>
    <?php $this->load->view($this->template_path . 'account/_header') ?>
    <section class="page-faq">
        <div class="container">
            <h2 class="heading"><?php echo $oneItem->title ?></h2>
            <div id="accordion-faq">
                <?php if(!empty($data)) foreach ($data as $k => $item): ?>
                <div class="card">
                    <div class="card-header" id="question<?php echo $item->id ?>">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo $item->id ?>" aria-expanded="true" aria-controls="collapse1">
                                <i class="icon_question_alt"></i><?php echo $item->title ?>
                            </button>
                        </h5>
                    </div>
                    <div id="collapse<?php echo $item->id ?>" class="collapse" aria-labelledby="heading<?php echo $item->id ?>" data-parent="#accordion-faq">
                        <div class="card-body">
                            <?php echo $item->description ?>
                            <?php echo $item->content ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <script>
        var urlCurrentMenu = '<?php echo getUrlCateNews($oneParent) ?>';
        var urlCurrent = '<?php echo getUrlCateNews($oneItem) ?>';
    </script>
<?php endif; ?>
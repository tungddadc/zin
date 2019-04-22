<div class="top-faq">
  <ul>
    <?php if(!empty($this->settings['faq'])) foreach ($this->settings['faq'] as $item): ?>
    <li>
      <a href="<?php echo $item['link'] ?>">
        <img src="<?php echo getImageThumb($item['thumb'],165,50) ?>" alt="<?php echo $item['title'] ?>">
      </a>
    </li>
    <?php endforeach; ?>
  </ul>
</div>
<div class="top-faq">
  <ul>
    <?php dd($this->settings); ?>
    <?php if(!empty($this->settings['faq'])) foreach ($this->settings['faq'] as $item): ?>
    <li>
      <a href="<?php echo $item['link'] ?>">
        <img src="<?php echo getImageThumb() ?>" alt="">
      </a>
    </li>
    <?php endforeach; ?>
  </ul>
</div>
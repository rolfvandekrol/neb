<div class="feed-item">
  <h3><a href="<?php print $feed_url; ?>"><?php print $feed_title; ?></a></h3>

  <div class="meta">
    <?php print $source_url ? l($source_title, $source_url, array('attributes' => array('class' => ''))) : ''; ?>
    <span class="date"><?php print $source_date; ?></span>
  </div>

  <?php if ($content) : ?>
    <div class="body"><?php print $content; ?></div>
  <?php endif; 

  if ($categories): ?>
    <div class="categories"><?php print t('Categories'); ?>: <?php print implode(', ', $categories); ?></div>
  <?php endif ;?>
</div>

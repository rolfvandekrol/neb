<?php

if ($classes) {
  $classes = ' class="'. $classes . ' "';
}

if ($id_node) {
  $id_node = ' id="'. $id_node . '"';
}

hide($content['comments']);
hide($content['links']);
?>
<article <?php print $id_node . $classes .  $attributes; ?> role="article">
  <?php print render($title_prefix); 

  if (!$page): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>" rel="bookmark"><?php print $title; ?></a></h2>
  <?php endif; 

  print render($title_suffix); 

  if ($display_submitted): ?>
    <footer>
      <?php print $user_picture; ?>
      <span class="author"><?php print t('Written by'); ?> <?php print $name; ?></span>
      <span class="date"><?php print t('On the'); ?> <time><?php print $date; ?></time></span>
      <span class="changed"><?php print t('Last'); ?> <time><?php print $changed; ?></time></span>

      <?php if(module_exists('comment')): ?><span class="comments"><?php print $comment_count; ?> Comments</span><?php endif; ?>
    </footer>
  <?php endif; ?>

  <div class="content"><?php print render($content); ?></div>
  <?php print render($content['links']) . render($content['comments']); ?>
</article>

<?php

if ($classes) {
  $classes = ' class="'. $classes . ' "';
}

?>
<nav <?php print $id_block . $classes .  $attributes; ?> role="navigation">

  <?php print render($title_prefix); 

  if ($block->subject): ?>
    <h2<?php print $title_attributes; ?>><?php print $block->subject ?></h2>
  <?php endif;

  print render($title_suffix); 

  print $content; ?>

</nav>

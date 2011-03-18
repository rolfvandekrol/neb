<?php

/*
* dsm($variables['template_files']);
* dsm($node);
* dsm($node->content);

*/


//  http://api.drupal.org/api/drupal/modules--block--block.tpl.php/7
if ($classes) {
  $classes = ' class="'. $classes . ' "';
}
?>

<div <?php print $id_block . $classes .  $attributes; ?>>

  <?php print $mothership_poorthemers_helper;  ?>

  <?php print render($title_prefix); ?>
  <?php if ($block->subject): ?>
    <h2<?php print $title_attributes; ?>><?php print $block->subject ?></h2>
  <?php endif;?>
  <?php print render($title_suffix); ?>
  

  <div class="content"<?php print $content_attributes; ?>>
    <?php print $content ?>
  </div>
</div>

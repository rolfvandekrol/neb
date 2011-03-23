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
<!--block-->
<div <?php print $id_block . $classes .  $attributes; ?>>
  <?php print $mothership_poorthemers_helper;  ?>

  <?php print render($title_prefix); ?>
  <?php if ($block->subject): ?>
    <h2<?php print $title_attributes; ?>><?php print $block->subject ?></h2>
  <?php endif;?>
  <?php print render($title_suffix); ?>
  
  <?php if (!theme_get_setting('mothership_classes_block_contentdiv')): ?>
  <div class="content"<?php print $content_attributes; ?>>
  <?php endif ?>  

    <?php print $content ?>

  <?php if (!theme_get_setting('mothership_classes_block_contentdiv')): ?>
  </div>
  <?php endif ?>  

</div>

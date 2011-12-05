<?php
if ($classes) {
  $classes = ' class="'. $classes . ' ' . $blocktheme . ' "';
}
?>

<div <?php print $id_block . $classes .  $attributes; ?>>

  <?php print $mothership_poorthemers_helper;  ?>
  <?php print render($title_prefix); ?>
  <?php print render($title_suffix); ?>

  <?php print $content ?>
</div>

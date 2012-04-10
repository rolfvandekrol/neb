<?php

if ($classes) {
  $classes = ' class="'. $classes . ' "';
}

// add a aria role search if this is the search block
if($variables['block_html_id'] == "block-search-form"){
	$role = ' role="search"';
}else{
  $role = '';
}
?>
<div <?php print $id_block . $classes .  $attributes . $role; ?>>
  <?php print render($title_prefix);

  if ($block->subject): ?>
    <h2<?php print $title_attributes; ?>><?php print $block->subject ?></h2>
  <?php endif;

  print render($title_suffix);

  print $content ?>
</div>

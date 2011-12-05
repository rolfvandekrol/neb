<?php
//kpr(get_defined_vars());
//http://drupalcontrib.org/api/drupal/drupal--modules--node--node.tpl.php
//node--[CONTENT TYPE].tpl.php

if ($classes) {
  $classes = ' class="'. $classes . ' "';
}

if ($id_node) {
  $id_node = ' id="'. $id_node . '"';
}

hide($content['comments']);
hide($content['links']);
?>

<!--node-->
<article <?php print $id_node . $classes .  $attributes; ?>>
  <?php print $mothership_poorthemers_helper; ?>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>" rel="bookmark"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <footer>
    <?php print $user_picture; ?>
    date: <time><?php print $date; ?></time>
    changed: <time><?php print $changed; ?></time>    
    <span class="author">By: <?php print $name; ?></span>
    <span class="type">Type:<?php print $type; ?> </span>
    <?php if(module_exists('comment')): ?>
      <div class="comments">Comments: <?php print $comment_count; ?></div>
    <?php endif; ?>

  </footer>

  <div class="content">
    <?php print render($content);?>
  </div>

  <?php print render($content['links']); ?>
  
  <?php print render($content['comments']); ?>
</article>

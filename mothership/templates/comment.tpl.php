<?php

if ($classes) {
  $classes = ' class="'. $classes . ' "';
}
?>
<!-- comments -->
<article<?php print $classes; ?><?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <h3<?php print $title_attributes; ?>>
      <?php print $title; ?>
    </h3>
    <?php endif; ?>
  <?php print render($title_suffix); ?>

  <footer class="meta">
    <?php if ($new): ?>
      <mark><?php print $new; ?></mark>
    <?php endif; ?>

    author: <?php print $author; ?>
    created: <time><?php print $created; ?></time>
    changed: <time><?php print $changed; ?></time>
    <?php print $permalink; ?>
    <?php print $picture; ?>      
  </footer>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['links']);
      print render($content);
    ?>

    <?php if ($signature): ?>
      <aside class="user-signature">
        <?php print $signature; ?>
      </aside>
    <?php endif; ?>
  </div>

  <?php print render($content['links']) ?>
</article> <!-- /.comment -->

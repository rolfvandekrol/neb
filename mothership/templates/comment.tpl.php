<?php

if ($classes) {
  $classes = ' class="'. $classes . ' "';
}
?>
<!-- comments -->
<article<?php print $classes; ?><?php print $attributes; ?>>

  <footer>
    <?php if ($new): ?>
      <mark><?php print $new; ?></mark>
    <?php endif; ?>
    <figure>
      <?php print $picture; ?>
      <figcaption><?php print $author; ?></figcaption>
    </figure>

    <span class="date"><?php print t('Date'); ?> <time><?php print $created; ?></time></span>
    <span class="changed"><?php print t('Last'); ?> <time><?php print $changed; ?></time></span>
    
    <?php print $permalink; ?>
  </footer>

  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <h3<?php print $title_attributes; ?>>
      <?php print $title; ?>
    </h3>
    <?php endif; ?>
  <?php print render($title_suffix); ?>

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

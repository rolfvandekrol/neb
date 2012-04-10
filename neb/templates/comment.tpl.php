<?php
if ($classes) {
  $classes = ' class="'. $classes . ' "';
}
?>

<article<?php print $classes; ?><?php print $attributes; ?>>

  <?php print render($title_prefix); 

  if ($title): ?>
    <h3<?php print $title_attributes; ?>>
      <?php print $title; ?>
    </h3>
  <?php endif; 
  print render($title_suffix); ?>


  <footer>
    <?php if ($new): ?>
      <mark><?php print $new; ?></mark>
    <?php endif; ?>
    <figure>
      <?php print $picture; ?>
      <figcaption><?php print $author; ?></figcaption>
    </figure>

    <span class="date"><time><?php print $created; ?></time></span>
    <span class="changed">(<?php print t('changed'); ?> <time><?php print $changed; ?></time>)</span>
  </footer>



  <div class="content"<?php print $content_attributes; ?>>
    <?php
    hide($content['links']);
    print render($content);
    
    if ($signature): ?>
      <aside class="user-signature">
        <?php print $signature; ?>
      </aside>
    <?php endif; ?>
  </div>

  <?php print render($content['links']) ?>
</article> 

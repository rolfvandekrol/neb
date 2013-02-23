<?php

//test to see if we have any class...
if($classes){
  $class = " class=\"$classes\" ";
}

if (count($items) > 1): 
  if (!$classes): ?><div<?php print $class; ?><?php print $attributes; ?>><?php endif ?>

  <div class="image-fields"<?php print $content_attributes; ?>>
    <?php if (!$label_hidden): ?><h3<?php print $title_attributes; ?>><?php print $label ?></h3><?php endif; 

    foreach ($items as $delta => $item): ?>
      <figure class="<?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $item_attributes[$delta]; ?>>
        <?php print render($item); ?>
        <?php if ($item['#item']['title']): ?><figcaption><?php print $item['#item']['title']; ?></figcaption><?php endif; ?>
      </figure>
    <?php endforeach; ?>
  </div>

  <?php if (!$classes): ?></div><?php endif; 

else 
  foreach ($items as $delta => $item): 
    if ($item['#item']['title']): ?>

      <figure <?php print $class; ?>>
        <?php print render($item); ?>
        <figcaption><?php print $item['#item']['title']; ?></figcaption>
      </figure>
    <?php else ?>
      <div<?php print $class; ?><?php print $attributes; ?>><?php print render($item); ?></div>
    <?php endif; 
  
  endforeach; 
endif; ?>

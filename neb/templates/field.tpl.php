<div <?php if($classes) {?>class="<?php print $classes; ?>"<?php } ?><?php print $attributes; ?>>
  <?php if (!$label_hidden): ?><label<?php print $title_attributes; ?>><?php print $label ?></label><?php endif; 

  if(count($items) > 1): ?>
    <div class="field-items"<?php print $content_attributes; ?>>
      <?php foreach ($items as $delta => $item): ?>
        <div class="field-item <?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $item_attributes[$delta]; ?>><?php print render($item); ?></div>
      <?php endforeach; ?>
    </div>
  <?php else:
    foreach ($items as $delta => $item): print render($item); endforeach; 
  endif; ?>
</div>

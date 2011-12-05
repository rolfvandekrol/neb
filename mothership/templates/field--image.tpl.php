<!-- field--image.tpl -->
<div <?php if($classes) {?>class="<?php print $classes; ?>"<?php } ?><?php print $attributes; ?>>
  <?php print $mothership_poorthemers_helper;  ?>  
  

  <?php if (!$label_hidden) : ?>
    <label<?php print $title_attributes; ?>><?php print $label ?></label>
  <?php endif; ?>

  <?php if(count($items) > 1 ){ ?>
    <div class="field-items"<?php print $content_attributes; ?>>
      <?php foreach ($items as $delta => $item) : ?>

        <figure class="field-item <?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $item_attributes[$delta]; ?>>
            <?php print render($item); ?>
           <figcaption><?php print $item['#item']['title']; ?></figcaption>          
        </figure>
      <?php endforeach; ?>
    </div>
  <?php }else{ ?>
      <?php foreach ($items as $delta => $item) : ?>
        <figure>
          <?php print render($item); ?>
           <figcaption><?php print $item['#item']['title']; ?></figcaption>
         </figure>
      <?php endforeach; ?>      
  <?php } ?>
</div>

<!-- field--image.tpl -->
<?php
//test to see if we have any class...
if($classes){
  $class = " class=\"$classes\" ";
}
?>
  <?php print $mothership_poorthemers_helper;  ?>

  <?php if(count($items) > 1 ){ ?>

    <?php if(!$classes){ ?>
    <div<?php print $class; ?><?php print $attributes; ?>>
    <?php } ?>

    <div class="image-fields"<?php print $content_attributes; ?>>

    <?php if (!$label_hidden) : ?>
      <h3<?php print $title_attributes; ?>><?php print $label ?></h3>
    <?php endif; ?>

      <?php foreach ($items as $delta => $item) : ?>

        <figure class="<?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $item_attributes[$delta]; ?>>
          <?php print render($item); ?>
          <?php if($item['#item']['title']){ ?>
           <figcaption><?php print $item['#item']['title']; ?></figcaption>
          <?php } ?>
        </figure>
      <?php endforeach; ?>
    </div>
    <?php if(!$classes){ ?>
     </div>
    <?php } ?>

  <?php }else{ ?>

      <?php foreach ($items as $delta => $item) : ?>

        <?php if($item['#item']['title']){ ?>
        <figure <?php print $class; ?>>
          <?php print render($item); ?>
          <figcaption>
			     <?php print $item['#item']['title']; ?>
		      </figcaption>
         </figure>
         <?php }else{ ?>
          <div<?php print $class; ?><?php print $attributes; ?>>
          <?php print render($item); ?>
          </div>
         <?php } ?>
      <?php endforeach; ?>

  <?php } ?>


<article class="<?php print $classes;?> clearfix">

  <?php if (isset($title_suffix['contextual_links'])): ?>
  <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

  <?php if ($header): ?>
    <header <?php if($header_classes){ ?>class="<?php print $header_classes; ?>"<?php } ?>>
      <?php print $header; ?>
    </header>
  <?php endif; ?>

  <?php if ($hgroup): ?>
    <hgroup <?php if($hgroup_classes){ ?>class="<?php print $hgroup_classes; ?>"<?php } ?>>
      <?php print $hgroup; ?>
    </hgroup>
  <?php endif; ?>

  <?php if ($top): ?>
    <div  <?php if($$top_classes){ ?>class="<?php print $$top_classes; ?>"<?php } ?>>
      <?php print $top; ?>
    </div>
  <?php endif; ?>

  <?php if ($main): ?>
    <div <?php if($main_classes){ ?>class="<?php print $main_classes; ?>"<?php } ?>>
      <?php print $main; ?>
    </div>
  <?php endif; ?>


  <?php if ($bottom): ?>
    <div <?php if($bottom_classes){ ?>class="<?php print $bottom_classes; ?>"<?php } ?>>
      <?php print $bottom; ?>
    </div>
  <?php endif; ?>

  <?php if ($footer): ?>
    <footer <?php if($footer_classes){ ?>class="<?php print $footer_classes; ?>"<?php } ?>>
      <?php print $footer; ?>
    </footer>
  <?php endif; ?>
</article>

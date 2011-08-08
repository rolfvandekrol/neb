<?php

/**
 * @file
 * Display Suite 2 column stacked template.
 */
?>
<div class="<?php print $classes;?> clearfix">

  <?php if (isset($title_suffix['contextual_links'])): ?>
  <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

  <?php if ($header): ?>
    <header <?php if($header_classes){ ?>class="<?php print $header_classes; ?>"<?php } ?>>
      <?php print $header; ?>
    </header>
  <?php endif; ?>

  <?php if ($top): ?>
    <div  <?php if($$top_classes){ ?>class="<?php print $$top_classes; ?>"<?php } ?>>
      <?php print $top; ?>
    </div>
  <?php endif; ?>
<div class="clearfix">
  <?php if ($left): ?>
    <div <?php if($left_classes){ ?>class="<?php print $left_classes; ?>"<?php } ?>>
      <?php print $left; ?>
    </div>
  <?php endif; ?>

  <?php if ($right): ?>
    <div <?php if($right_classes){ ?>class="<?php print $right_classes; ?>"<?php } ?>>
      <?php print $right; ?>
    </div>
  <?php endif; ?>
</div>

  <?php if ($bottom): ?>
    <div class="clearfix <?php print $bottom_classes; ?>">
      <?php print $bottom; ?>
    </div>
  <?php endif; ?>

  <?php if ($footer): ?>
    <footer <?php if($footer_classes){ ?>class="<?php print $footer_classes; ?>"<?php } ?>>
      <?php print $footer; ?>
    </footer>
  <?php endif; ?>
</div>

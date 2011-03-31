
<div class="<?php print $classes;?> clearfix">

  <?php if (isset($title_suffix['contextual_links'])): ?>
  <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

  <div class="group-header <?php // print $header_classes; ?>">
    <?php print $header; ?>
  </div>

  <div class="group-left <?php //print $left_classes; ?>">
    <?php print $left; ?>
  </div>

  <div class="group-middle <?php // print $middle_classes; ?>">
    <?php print $middle; ?>
  </div>

  <div class="group-right <?php // print $right_classes; ?>">
    <?php print $right; ?>
  </div>

  <div class="group-footer <?php // print $footer_classes; ?>">
    <?php print $footer; ?>
  </div>
</div>
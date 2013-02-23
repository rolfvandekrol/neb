<!--views-view-->
<div class="<?php print $classes; ?>">
  <?php print render($title_prefix);

  if ($title): print $title; endif; 

  print render($title_suffix); 

  if ($header): ?><div class="view-header"><?php print $header; ?></div><?php endif; 

  if ($exposed): ?><div class="view-filters"><?php print $exposed; ?></div><?php endif; 

  if ($attachment_before): ?><div class="attachment attachment-before"><?php print $attachment_before; ?></div><?php endif; 
  
  if ($rows): print $rows;
  elseif ($empty): ?><div class="view-empty"><?php print $empty; ?></div><?php endif; 

  if ($pager): print $pager; endif; 

  if ($attachment_after): ?><div class="attachment attachment-after"><?php print $attachment_after; ?></div><?php endif; 

  if ($more): print $more; endif; 

  if ($footer): ?><div class="view-footer"><?php print $footer; ?></div><?php endif; 

  if ($feed_icon): ?><div class="feed-icon"><?php print $feed_icon; ?></div><?php endif; ?>
</div>
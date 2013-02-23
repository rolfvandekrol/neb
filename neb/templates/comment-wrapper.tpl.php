<aside id="comments" class="<?php print $classes; ?>"<?php print $attributes; ?>>

<?php if ($node->type != 'forum'): ?>
  <h2><?php print t('Comments'); ?></h2>
<?php endif; 

print render($content['comments']); 

if ($content['comment_form']): ?>
  <h3><?php print t('Add new comment'); ?></h3>
  <?php print render($content['comment_form']); 
endif; ?>

</aside>

<?php
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */

/*
  The $classes are defined in template_preprocess_views_view_list() 
*/
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>

    <div
      <?php if($classes[$id]){   ?>
        class="<?php print $classes[$id]; ?>"
      <?php } ?>
    >

    <?php print $row; ?>
  </div>
<?php endforeach; ?>

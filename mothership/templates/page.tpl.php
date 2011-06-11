<?php
//dsm(get_defined_vars());
//dsm($theme_hook_suggestions);
// template naming
//page--[CONTENT TYPE].tpl.php

$site_name_element = "h1";
?>
<?php print $mothership_poorthemers_helper; ?>
<div id="container">

  <div id="header">
    <<?php print $site_name_element; ?> id="site-name">
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
        <?php print $site_name; ?>
      </a>
    </<?php print $site_name_element; ?>>

    <?php print render($page['header']); ?>
  </div><!--/header-->

  <div id="page">
    <?php print $breadcrumb; ?>

    <?php if ($action_links): ?>
      <ul class="action-links"><?php print render($action_links); ?></ul>
    <?php endif; ?>

    <?php if ($tabs): ?>
      <div class="tabs"><?php print render($tabs); ?></div>
    <?php endif; ?>


    <?php print render($page['sidebar_first']); ?>
    <?php print render($page['sidebar_second']); ?>

    <div id="main">
      <?php //title ?>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1 id="page-title"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php //title ?>


      <div id="drupal-messages">
        <?php print render($page['help']); ?>
        <?php print render($page['highlighted']); ?>
        <?php print $messages; ?>
      </div>

      <?php print render($page['content']); ?>
    </div><!--/main-->

  </div><!--/page-->

  <div id="footer">
    <?php print render($page['footer']); ?>
  </div><!--/footer-->

</div><!--/container-->

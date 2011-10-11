<?php
//dsm(get_defined_vars());
//dsm($theme_hook_suggestions);
// template naming
//page--[CONTENT TYPE].tpl.php

$site_name_element = "h1";
?>
<!--page.tpl.php-->
<?php print $mothership_poorthemers_helper; ?>


<header>
  <<?php print $site_name_element; ?> id="site-name">
    <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
      <?php print $site_name; ?>
    </a>
  </<?php print $site_name_element; ?>>

  <?php print render($page['header']); ?>
</header>

<div class="page">
  <?php print $breadcrumb; ?>

  <?php if ($action_links): ?>
    <ul class="action-links"><?php print render($action_links); ?></ul>
  <?php endif; ?>

  <?php if ($tabs): ?>
    <nav class="tabs"><?php print render($tabs); ?></nav>
  <?php endif; ?>


  <?php print render($page['sidebar_first']); ?>
  <?php print render($page['sidebar_second']); ?>

  <div role="main">
    <?php //title ?>
    <?php print render($title_prefix); ?>
    <?php if ($title): ?>
      <h1 id="page-title"><?php print $title; ?></h1>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php //title ?>

    <?php if($page['help'] OR $page['highlighted'] OR $messages){ ?><div class="drupal-messages"><?php } ?>
      <?php print render($page['help']); ?>
      <?php print render($page['highlighted']); ?>
      <?php print $messages; ?>
    <?php if($page['help'] OR $page['highlighted'] OR $messages){ ?></div><?php } ?>

    <?php print render($page['content']); ?>
  </div><!--/main-->

</div><!--/page-->

<footer>
  <?php print render($page['footer']); ?>
</footer>
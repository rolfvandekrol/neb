<?php
//kpr(get_defined_vars());
//kpr($theme_hook_suggestions);
//template naming
//page--[CONTENT TYPE].tpl.php
?>
<!--page.tpl.php-->
<?php print $mothership_poorthemers_helper; ?>

<header class="cf">

  <?php if ($logo): ?>
    <figure>
    <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
      <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
    </a>
    </figure>
  <?php endif; ?>
  <hgroup>
    <h1><?php print $site_name; ?></h1>
    <?php if ($site_slogan): ?>
      <h2><?php print $site_slogan; ?></h2>
    <?php endif; ?>
  </hgroup>

  <?php if ($page['header']): ?>
    <div class="header">
      <?php print render($page['header']); ?>
    </div>
  <?php endif; ?>

  <?php if ($page['header_menu']): ?>
    <div class="header-menu">
      <?php print render($page['header_menu']); ?>
    </div>
  <?php endif; ?>

</header>

<div class="page cf">
  <?php if ($page['sidebar_first']): ?>
    <div class="sidebar-one">
    <?php print render($page['sidebar_first']); ?>
    </div>
  <?php endif; ?>

  <div role="main" class="main">
    <?php print render($title_prefix); ?>
    <?php if ($title): ?>
      <h1><?php print $title; ?></h1>
    <?php endif; ?>
    <?php print render($title_suffix); ?>

    <?php print $breadcrumb; ?>

    <?php if ($action_links): ?>
      <ul class="action-links"><?php print render($action_links); ?></ul>
    <?php endif; ?>

    <?php if ($tabs): ?>
      <nav class="tabs"><?php print render($tabs); ?></nav>
    <?php endif; ?>

    <?php if($page['highlighted'] OR $messages){ ?>
      <div class="drupal-messages">
      <?php print render($page['highlighted']); ?>
      <?php print $messages; ?>
      </div>
    <?php } ?>


    <?php print render($page['content_pre']); ?>

    <?php print render($page['content']); ?>

    <?php print render($page['content_post']); ?>

  </div><!--/main-->

  <?php if ($page['sidebar_second']): ?>
    <div class="sidebar-two">
      <?php print render($page['sidebar_second']); ?>
    </div>
  <?php endif; ?>
</div><!--/page-->

<footer>
  <?php print render($page['footer']); ?>
</footer>




<?php
//dsm(get_defined_vars());
//dsm($theme_hook_suggestions);
// template naming
//page--[CONTENT TYPE].tpl.php
?>
<!--page.tpl.php-->
<?php print $mothership_poorthemers_helper; ?>

<div class="page">

  <div class="topbar">
    <div class="">

    </div>
    <div class="search">
      search
    </div>
    <div class="useraccount">
      login stuff
    </div>
  </div>



  <header>
    <?php print render($page['header']); ?>
    <?php print render($page['header_second']); ?>
  </header>

  <?php print $breadcrumb; ?>

  <?php if ($action_links): ?>
    <ul class="action-links"><?php print render($action_links); ?></ul>
  <?php endif; ?>

  <?php if ($tabs): ?>
    <nav class="tabs"><?php print render($tabs); ?></nav>
  <?php endif; ?>

  <?php if ($page['sidebar_first']): ?>
    <div class="sidebar-first">
    <?php print render($page['sidebar_first']); ?>
    </div>
  <?php endif; ?>

  <div role="main" class="main">
    <?php //title ?>
    <?php print render($title_prefix); ?>
    <?php if ($title): ?>
      <h1><?php print $title; ?></h1>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php //title ?>

    <?php if($page['help'] OR $page['highlighted'] OR $messages){ ?>
      <div class="drupal-messages">
      <?php print render($page['help']); ?>
      <?php print render($page['highlighted']); ?>
      <?php print $messages; ?>
      </div>
    <?php } ?>

    <?php print render($page['content']); ?>

  </div><!--/main-->

  <?php if ($page['sidebar_second']): ?>
    <div class="sidebar-second">
      <?php print render($page['sidebar_second']); ?>
    </div>
  <?php endif; ?>

  <footer>
    <?php print render($page['footer']); ?>
  </footer>

</div><!--/page-->


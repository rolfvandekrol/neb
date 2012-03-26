<?php
//kpr(get_defined_vars());
//kpr($theme_hook_suggestions);
//template naming
//page--[CONTENT TYPE].tpl.php
?>
<!--page.tpl.php-->
<?php print $mothership_poorthemers_helper; ?>

<header role="banner">
  <div class="cf">
  <?php if ($logo): ?>
    <figure class="logo">
    <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
      <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
    </a>
    </figure>
  <?php endif; ?>

  <?php if ($page['header']): ?>
    <div class="header">
      <?php print render($page['header']); ?>
    </div>
  <?php endif; ?>

  <?php if ($page['menu']): ?>
    <div class="header_menu">
      <?php print render($page['menu']); ?>
    </div>
  <?php endif; ?>

  </div>
</header>

<div class="page cf">

  <?php print render($page['featured']); ?>

  <?php if ($page['sidebar_first']): ?>
  <div class="sidebar sidebarfirst">
    <?php print render($page['sidebar_first']); ?>
  </div>
  <?php endif; ?>

  <div role="main">
    <?php print render($page['content_pre']); ?>
    <?php print render($page['content']); ?>
    <?php print render($page['content_post']); ?>
  </div><!--/main-->

  <?php if ($page['sidebar_second']): ?>
  <div class="sidebar sidebarsecond">
    <?php print render($page['sidebar_second']); ?>
  </div>
  <?php endif; ?>

  <?php if ($page['half_first'] OR $page['half_second']): ?>
  <div class="twohalf">
    <?php print render($page['half_first']); ?>
    <?php print render($page['half_second']); ?>
  </div>
  <?php endif; ?>

  <?php if ($page['triptych_first'] OR $page['triptych_middle'] OR $page['triptych_last']): ?>
  <div class="triptych">
    <?php print render($page['triptych_first']); ?>
    <?php print render($page['triptych_middle']); ?>
    <?php print render($page['triptych_last']); ?>
  </div>
  <?php endif; ?>
</div><!--/page-->

<footer role="contentinfo">
  <div>
    <div><?php print render($page['footer_1column']); ?></div>
    <div><?php print render($page['footer_2column']); ?></div>
    <div><?php print render($page['footer_3column']); ?></div>
    <div><?php print render($page['footer_4column']); ?></div

    <?php if($page['footer']): ?>
    <aside>
      <?php print render($page['footer']); ?>
    </aside>
    <?php endif; ?>

  </div>
</footer>

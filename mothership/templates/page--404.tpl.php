<?php
//kpr(get_defined_vars());
//kpr($theme_hook_suggestions);
//template naming
//page--[CONTENT TYPE].tpl.php
?>
<!--page.tpl.php-->
<?php print $mothership_poorthemers_helper; ?>

<header class="cf" role="banner">

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
 
</header>
 

<div class="page cf">

  <article>
  
   <h1>Epic Fail! 404</h1>
  
    <p>
      This wasnt the nodes you were looking for
    </p>
    <script>
      var GOOG_FIXURL_LANG = (navigator.language || '').slice(0,2),
      GOOG_FIXURL_SITE = location.host;
    </script>
    <script src="http://linkhelp.clients.google.com/tbproxy/lh/wm/fixurl.js"></script>
  
  </article>

</div>

<footer role="contentinfo">
  <?php print render($page['footer']); ?>
</footer>

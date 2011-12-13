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
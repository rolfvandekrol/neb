<?php
//dsm(get_defined_vars());
//dsm($theme_hook_suggestions);

// template naming
//page--[CONTENT TYPE].tpl.php

$site_name_element = "h1";
?>
<?php print $mothership_poorthemers_helper; ?>
<div id="container" class="gc-978">
  <div id="container-inner">


    <div id="header">
      <div id="header-inner">

        <<?php print $site_name_element; ?> id="site-name">
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
            <?php print $site_name; ?>
          </a>
        </<?php print $site_name_element; ?>>

        <?php print render($page['header']); ?>

      </div>
    </div><!--/header-->

    <div id="drupal-messages">
      <?php print render($page['help']); ?>
      <?php print render($page['highlighted']); ?>
      <?php print $messages; ?>
    </div>

    <div id="page">
      <div id="page-inner">
        
        <?php print $breadcrumb; ?>

        <div id="pagebody">
          <div id="pagebody-inner">

            <?php print render($page['sidebar_first']); ?>

            <?php print render($page['sidebar_second']); ?>

            <div id="main">
              <?php if ($action_links): ?>
                <ul class="action-links"><?php print render($action_links); ?></ul>
              <?php endif; ?>
              
              
              <?php //title ?>
              <?php print render($title_prefix); ?>
              <?php if ($title): ?>
                <h1 class="title" id="page-title"><?php print $title; ?></h1>
              <?php endif; ?>
              <?php print render($title_suffix); ?>
              <?php //title ?>

              <?php if ($tabs): ?>
                <div class="tabs"><?php print render($tabs); ?></div>
              <?php endif; ?>

              <?php print render($page['content']); ?>

              <?php print render($page['sidebar_first']); ?>

              <?php print render($page['sidebar_second']); ?>

            </div>

        </div></div><!-- /pagebody-->


        <div id="pagefooter">
          <div id="pagefooter-inner">
            <?php print render($page['footer']); ?>
        </div></div> <!--/pagefooter-->


      </div>
    </div><!--/page-->

    </div><!--/container-inner-->

    <div id="footer">

    </div>

</div><!--/container-->

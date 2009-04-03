<?php
/*
documentation:
  http://api.drupal.org/api/file/modules/system/page.tpl.php
-------------------------------------
page vars dsm(get_defined_vars())
-------------------------------------
<?php print $head_title; ?>
?php print $head; ?>
<?php print $styles; ?>
<?php print $scripts; ?>
<?php print $body_classes; //can be modified in template.php moshpit_preprocess_page  + http://drupal.org./node/171906 ?>
<?php print $base_path; ?>
<?php print $breadcrumb; // themename_breadcrumb in template.php?> 
<?php print $help ?>
<?php print $messages ?>
<?php print $tabs; ?>
<?php print $title; ?>

$feed_icons

$is_front
site_name
site_slogan

<?php print $closure; ?>

-------------------------------------
regions
-------------------------------------
<?php print $content; ?>
<?php print $footer_message; ?>

<?php if ($header) { ?>
  <?php print $header; ?>
<?php } ?>


<?php if ($left) { ?>
  <?php print $left; ?>
<?php } ?>

<?php if ($right) { ?>
  <?php print $right; ?>
<?php } ?>


<?php if ($footer) { ?>
  <?php print $footer; ?>
<?php } ?>


-------------------------------------
USER DATA
-------------------------------------
<?php if($user->uid){ ?>
<?php 
  //user picture
  $userimage ='<img src="/'.$user->picture.'">';                      
  print l($userimage, 'user/'.$user->uid, $options= array('html'=>TRUE));  
?>

<?php print l($user->name, 'user/'.$user->uid.'/edit');  ?>
<?php print $user->mail ;?>
(<?php print l(t('edit'), 'user/'.$user->uid.'/edit');  ?>
<?php print l(t('log out'), 'logout');  ?>)
<?php print $user->profile_bio;?>

<?php 
//ROLES
  foreach ($user->roles as $key => $value) {
    if($key!="2"){//no reason to show the basic authenticated role
      print $user->roles[$key].' ('.$key.')<br/>';  
    }
  }
?>
  
<?php 
//Organic Groups
foreach ($user->og_groups as $key => $value) {
  print l($user->og_groups[$key]['title'], 'node/'.$user->og_groups[$key]['nid']).'<br/>';
}
?>

<?php } //user account ?>

*/
?>
<?php // dsm(get_defined_vars()) ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">
<!--
  moshpit base theme
  http://drupal.org/projects/moshpit
	Geek Röyale http://geekroyale.com
	Sex Drupal & Rock n Roll
-->
<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
</head>
<body class="<?php print $body_classes; ?>">

<div id="container" class="clearfix">
  <div id="container-inner">

    <div id="page">
      <div id="page-inner" class="clearfix">

        <div id="pageheader" class="grid-full">
          <div id="pageheader-inner">

            <<?php print $site_name_element; ?> id="site-name" class="grid12-3">
              <a href="<?php print $base_path; ?>" title="<?php print t('Home'); ?>" rel="home">
                <?php print $site_name; ?>
              </a>
            </<?php print $site_name_element; ?>>

          	<?php if ($header) { ?>
          	  <?php print $header; ?>
          	<?php } ?>

          </div>
        </div>

    		<div id="navigation" class="grid-full">
    			<div id="navigation-inner">
            <?php if ($primary_links){ ?>
              <?php print theme('links', $primary_links); ?>
            <?php } ?>
        	  <?php
        	  //get a menu & print the sucka
            //    $menu = menu_navigation_links("menu-top");
            //    print theme('links', $menu, array('class' =>'links', 'id' => 'utilities'));
            ?>
          </div>
        </div>

        <?php if ($breadcrumb){ ?>
      		<div id="path" class="grid-full">
            <div id="path-inner">
              <?php print $breadcrumb; ?> 
            </div>
          </div>
        <?php } ?>
        
        <div id="pagebody" class="grid-full clearfix">
          <div id="pagebody-inner">

            <?php if ($left) { ?>
              <div id="sitebar-left" class="grid12-2">
                <?php print $left; ?>
              </div>
            <?php } ?>



          	<div id="content" class="grid12-8">
              <div id="content-inner">

            		<?php if ($help OR $messages OR $tabs) { ?>
            			<div id="drupal-messages">
            			  <div id="drupal-messages-inner">
                  	  <?php print $help ?>
                  	  <?php print $messages ?>
                    </div>
            			</div>
            		<?php } ?>

                <?php if ($tabs){ ?>
                  <div class="tabs"><?php print $tabs; ?></div>
                <?php }; ?>

                <?php if ($content_top) { ?>
                  <?php print $content_top; ?>
                <?php } ?>

                <?php if ($title AND (arg(0)=="node" AND is_numeric(arg(1)) AND arg(2)!="")) { /*TODO: moved out to the template.php*/ ?>
                  <h1 class="title"><?php print $title; ?></h1>
                <?php } ?>
                
                <?php print $content; ?>

                <?php if ($content_bottom) { ?>
                  <?php print $content_bottom; ?>
                <?php } ?>
             
              </div>
          	</div>



            <?php if ($right) { ?>
              <div id="sitebar-right" class="grid12-2">
                <?php print $right; ?>
              </div>
            <?php } ?>



          </div>
        </div>

        <div id="pagefooter" class="grid-full">
          <div id="pageFooter-inner">

          	<?php if ($footer_message) { ?>
          	  <?php print $footer_message; ?>
          	<?php } ?>
  
            <?php print $footer; ?>
  
            <?php
             //   $menu = menu_navigation_links("menu-footermenu");
             //   print theme('links', $menu, array('class' =>'links', 'id' => 'footerNavigation'));
            ?>
      
          </div>
        </div>

      </div>
    </div>
  
  </div>
</div>


<?php print $scripts; ?>
<?php print $closure; ?>
</body>
</html>
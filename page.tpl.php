<?php
/*
documentation:
  http://api.drupal.org/api/file/modules/system/page.tpl.php
-------------------------------------
page vars dsm(get_defined_vars())
-------------------------------------
<?php print $base_path; ?>
<?php print $is_front ?>
*/
?>
<?php // dsm(get_defined_vars()) ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">
<!--
  mothership theme
  http://drupal.org/projects/moshpit
	Geek Röyale http://geekroyale.com
	Sex Drupal & Rock n Roll baby!
-->
<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>
<body class="<?php print $body_classes; //can be modified in template.php mothership_preprocess_page  + http://drupal.org./node/171906 ?>">

<pre>
--------------------------------
user
--------------------------------
</pre>
  <?php if($user->uid){ ?>
  <?php 
    //user picture
    if($user->picture){
      $userimage ='<img src="/'.$user->picture.'">';                      
      print l($userimage, 'user/'.$user->uid, $options= array('html'=>TRUE));  
    }  
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

  <?php } //user account ?>

<pre>
--------------------------------
header
--------------------------------
</pre>

  <<?php print $site_name_element; // defined in template.php  mothership_preprocess_page ?> id="site-name">
    <a href="<?php print $base_path; ?>" title="<?php print t('Home'); ?>" rel="home">
      <?php print $site_name; ?>
    </a>
  </<?php print $site_name_element; ?>>


  <?php print $site_slogan ?>
  <?php print $mission ?>

  <?php if ($primary_links){ ?>
    <?php print theme('links', $primary_links); ?>
  <?php } ?>
  <?php
  //get a menu & print the sucka
  //    $menu = menu_navigation_links("menu-top");
  //    print theme('links', $menu, array('class' =>'links', 'id' => 'utilities'));
  ?>

  <?php if ($breadcrumb){ ?>
    <?php print $breadcrumb; // themename_breadcrumb in template.php?> 
  <?php } ?>


	<?php if ($help OR $messages OR $tabs) { ?>
  	  <?php print $help ?>
  	  <?php print $messages ?>
	<?php } ?>

  <?php if ($tabs){ ?>
    <?php print $tabs; ?>
  <?php }; ?>



<pre>
--------------------------------
regions + content
--------------------------------
</pre>
<?php if ($title AND (arg(0)=="node" AND is_numeric(arg(1)) AND arg(2)!="")) { /*TODO: moved out to the template.php*/ ?>
  <h1><?php print $title; ?></h1>
<?php } ?>


  <?php print $content; ?>

  <?php if ($header) { ?>
    <?php print $header; ?>
  <?php } ?>


  <?php if ($left) { ?>
      <?php print $left; ?>
  <?php } ?>


  <?php if ($right) { ?>
    <?php print $right; ?>
  <?php } ?>

  <?php if ($footer_message) { ?>
    <?php print $footer_message; ?>
  <?php } ?>

  <?php print $footer; ?>

  <?php print $feed_icons ?>

<?php print $closure; ?>
</body>
</html>
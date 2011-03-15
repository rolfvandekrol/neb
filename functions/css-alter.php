<?php
/* Nukes the css from drupal core */
function mothership_css_alter(&$css) {

  //Rename css files & use motherships own versions
  if(module_exists('aggregator')){
    $css = drupal_add_css(drupal_get_path('theme', 'mothership') . '/css-drupalcore/aggregator.theme.css', array('group' => CSS_SYSTEM));
  } 

  if(module_exists('block')){
    $css = drupal_add_css(drupal_get_path('theme', 'mothership') . '/css-drupalcore/block.admin.css', array('group' => CSS_SYSTEM));
  } 

  if(module_exists('book')){
    $css = drupal_add_css(drupal_get_path('theme', 'mothership') . '/css-drupalcore/book.theme.css', array('group' => CSS_SYSTEM));
    $css = drupal_add_css(drupal_get_path('theme', 'mothership') . '/css-drupalcore/book.admin.css', array('group' => CSS_SYSTEM));
  } 

  if(module_exists('book')){
    $css = drupal_add_css(drupal_get_path('theme', 'mothership') . '/css-drupalcore/comment.theme.css', array('group' => CSS_SYSTEM));    
  }  
  $nuke = array(
     'modules/aggregator/aggregator.css' => FALSE,
     'modules/block/block.css' => FALSE,
     'modules/book/book.css' => FALSE,
     'modules/comment/comment.css' => FALSE,

     'modules/forum/forum.css' => FALSE,
     'modules/help/help.css' => FALSE,
     'modules/node/node.css' => FALSE,
     'modules/image/image.css' => FALSE,    
     'modules/openid/openid.css' => FALSE,
     'modules/locale/locale.css' => FALSE,    
     'modules/poll/poll.css' => FALSE,
     'modules/profile/profile.css' => FALSE,
     'modules/search/search.css' => FALSE,
     'modules/statistics/statistics.css' => FALSE,
     'modules/syslog/syslog.css' => FALSE,
     'modules/menu/menu.css' => FALSE,
     'modules/taxonomy/taxonomy.css' => FALSE,
     'modules/tracker/tracker.css' => FALSE,
     'modules/update/update.css' => FALSE,
     'modules/user/user.css' => FALSE,
     'misc/vertical-tabs.css' => FALSE,    
   );

   $css = array_diff_key($css, $nuke);




  switch (theme_get_setting('nuke_css')) {
    case 'mothership_css_nuke_theme':
      //clean out .theme.css
      foreach ($css as $file => $value) {
        if (strpos($file, '.theme.css') !== FALSE) {
          unset($css[$file]);
        }
      }
      break;

      case 'mothership_css_nuke_admin':
        //clean out .theme.css
        foreach ($css as $file => $value) {
          if (strpos($file, '.admin.css') !== FALSE) {
            unset($css[$file]);
          }
        }
        break;


      case 'mothership_css_nuke_theme_admin':
        //clean out .theme.css
        foreach ($css as $file => $value) {
          if (strpos($file, '.theme.css') !== FALSE) {
            unset($css[$file]);
          }
        }
        //clean out .admin.css
        foreach ($css as $file => $value) {
          if (strpos($file, '.admin.css') !== FALSE) {
            unset($css[$file]);
          }
        }

        break;

    case 'mothership_css_nuke_module':
      //clean out all modules 
      foreach ($css as $file => $value) {
        if (strpos($file, 'modules/') !== FALSE) {
          unset($css[$file]);
        }
      }
      //clean out /misc
      foreach ($css as $file => $value) {
        if (strpos($file, 'misc/') !== FALSE) {
          unset($css[$file]);
        }
      }

      break;

    case 'mothership_css_nuke_epic':
      /*Kills all css files that comes with drupal everything!*/
      $css = " ";
      break;
    
    default:
      # code...
      break;
  }

//krumo($css);
}


/*
Nukes the js from drupal core
*/
function mothership_js_alter(&$js) {
  if (theme_get_setting('mothership_nuke_js')){
    foreach ($js as $file => $value) {
      if (strpos($file, 'modules/') !== FALSE) {
        unset($js[$file]);
      }
    }
    foreach ($js as $file => $value) {
      if (strpos($file, 'misc/') !== FALSE) {
        unset($js[$file]);
      }
    }
  }
}




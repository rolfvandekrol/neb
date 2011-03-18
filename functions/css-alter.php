<?php
/* Nukes the css from drupal core */
function mothership_css_alter(&$css) {

  if(theme_get_setting('mothership_nuke_css') != "mothership_css_nuke_none" ){
      //
      //Lets start by clearing up the css file names so the follows the BAT 
      //

      $mothership_path = drupal_get_path('theme', 'mothership');

      if(module_exists('aggregator')){
        $css = drupal_add_css($mothership_path . '/css-drupalcore/aggregator.theme.css', array('group' => CSS_SYSTEM));
      } 

      if(module_exists('block')){
        $css = drupal_add_css($mothership_path . '/css-drupalcore/block.admin.css', array('group' => CSS_SYSTEM));
      } 

      if(module_exists('book')){
        $css = drupal_add_css($mothership_path . '/css-drupalcore/book.theme.css', array('group' => CSS_SYSTEM));
        $css = drupal_add_css($mothership_path . '/css-drupalcore/book.admin.css', array('group' => CSS_SYSTEM));
      } 

      if(module_exists('comment')){
        $css = drupal_add_css($mothership_path . '/css-drupalcore/comment.theme.css', array('group' => CSS_SYSTEM));  
      } 

      if(module_exists('contextual')){
        $css = drupal_add_css($mothership_path . '/css-drupalcore/contextual.base.css', array('group' => CSS_SYSTEM));
        $css = drupal_add_css($mothership_path . '/css-drupalcore/contextual.theme.css', array('group' => CSS_SYSTEM));
      } 

      if(module_exists('field')){
        $css = drupal_add_css($mothership_path . '/css-drupalcore/field.theme.css', array('group' => CSS_SYSTEM));  
        $css = drupal_add_css($mothership_path . '/css-drupalcore/field_ui.admin.css', array('group' => CSS_SYSTEM));    
      }
      /* TODO file
      if(module_exists('file')){

      }
      */ 
      if(module_exists('forum')){
        $css = drupal_add_css($mothership_path . '/css-drupalcore/forum.theme.css', array('group' => CSS_SYSTEM));    
      }

      if(module_exists('help')){
        $css = drupal_add_css($mothership_path . '/css-drupalcore/help.theme.css', array('group' => CSS_SYSTEM));      
      }

      if(module_exists('image')){
        $css = drupal_add_css($mothership_path . '/css-drupalcore/image.theme.css', array('group' => CSS_SYSTEM));        
      } 

      if(module_exists('local')){
         $css = drupal_add_css($mothership_path . '/css-drupalcore/local.theme.css', array('group' => CSS_SYSTEM));          
      } 

      if(module_exists('menu')){
        $css = drupal_add_css($mothership_path . '/css-drupalcore/menu.admin.css', array('group' => CSS_SYSTEM));            
      } 

      if(module_exists('node')){
        $css = drupal_add_css($mothership_path . '/css-drupalcore/node.theme.css', array('group' => CSS_SYSTEM));      
      }   

      if(module_exists('openid')){
        $css = drupal_add_css($mothership_path . '/css-drupalcore/openid.base.css', array('group' => CSS_SYSTEM));      
        $css = drupal_add_css($mothership_path . '/css-drupalcore/openid.theme.css', array('group' => CSS_SYSTEM));      
      }   

      /* TODO overlay
      if(module_exists('overlay')){

      }
      */

      if(module_exists('poll')){
        $css = drupal_add_css($mothership_path . '/css-drupalcore/poll.admin.css', array('group' => CSS_SYSTEM));      
        $css = drupal_add_css($mothership_path . '/css-drupalcore/poll.theme.css', array('group' => CSS_SYSTEM));      
      } 

      if(module_exists('poll')){ 
        $css = drupal_add_css($mothership_path . '/css-drupalcore/profile.theme.css', array('group' => CSS_SYSTEM));      
      } 

      if(module_exists('search')){ 
        $css = drupal_add_css($mothership_path . '/css-drupalcore/search.theme.css', array('group' => CSS_SYSTEM));      
      } 

    
      if(module_exists('shortcut')){ 
        $css = drupal_add_css($mothership_path . '/css-drupalcore/shortcut.theme.css', array('group' => CSS_SYSTEM));      
      } 
      if(module_exists('toolbar')){ 
        $css = drupal_add_css($mothership_path . '/css-drupalcore/toolbar.theme.css', array('group' => CSS_SYSTEM));      
      } 

      if(module_exists('tracker')){ 
        $css = drupal_add_css($mothership_path . '/css-drupalcore/tracker.theme.css', array('group' => CSS_SYSTEM));      
      } 

      if(module_exists('update')){ 
        $css = drupal_add_css($mothership_path . '/css-drupalcore/update.theme.css', array('group' => CSS_SYSTEM));      
      }

      /* TODO vertical-tabs

      */
      
      /* TODO all system files

      */

     //nuke the original css files that we now have in the theme
     $nuke = array(
       'modules/aggregator/aggregator.css' => FALSE,
       'modules/block/block.css' => FALSE,
       'modules/book/book.css' => FALSE,
       'modules/comment/comment.css' => FALSE,
       'modules/contextual/contextual.css' => FALSE,   
       'modules/forum/forum.css' => FALSE,
       'modules/forum/field.css' => FALSE,
       'modules/forum/field_ui.css' => FALSE,   
       'modules/help/help.css' => FALSE,
       'modules/image/image.css' => FALSE,  
       'modules/image/local.css' => FALSE,     
       'modules/image/menu.css' => FALSE,     
       'modules/node/node.css' => FALSE,
       'modules/openid/openid.css' => FALSE,  
       'modules/poll/poll.css' => FALSE,
       'modules/profile/profile.css' => FALSE,
       'modules/search/search.css' => FALSE,
       'modules/shortcut/shortcut.css' => FALSE,   
       'modules/syslog/syslog.css' => FALSE,
       'modules/menu/menu.css' => FALSE,
      'modules/toolbar/toolbar.css' => FALSE,
       'modules/tracker/tracker.css' => FALSE,
       'modules/update/update.css' => FALSE,
       'modules/user/user.css' => FALSE,
    //   'misc/vertical-tabs.css' => FALSE,  
      );


      $css = array_diff_key($css, $nuke);
    
  }

 switch (theme_get_setting('mothership_nuke_css')) {
  case 'mothership_css_nuke_theme_full':
   //clean out .theme.css
   foreach ($css as $file => $value) {
    if (strpos($file, '.theme.css') !== FALSE) {
     unset($css[$file]);
    }
   }
   break;

  case 'mothership_css_nuke_theme':
   //clean out .theme.css
   foreach ($css as $file => $value) {
    if (strpos($file, '.theme.css') !== FALSE) {
     unset($css[$file]);
    }
   }
   //add the context & toolbars & shortcuts
    $css = drupal_add_css($mothership_path . '/css-drupalcore/contextual.theme.css', array('group' => CSS_SYSTEM));     
    $css = drupal_add_css($mothership_path . '/css-drupalcore/shortcut.theme.css', array('group' => CSS_SYSTEM));   
    $css = drupal_add_css($mothership_path . '/css-drupalcore/toolbar.theme.css', array('group' => CSS_SYSTEM));                       
   
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
   /* 
   Nukes all css files that comes with drupal, themes, contrib whatever everything baby! 
   So you have to add to add you css the old fashioned way
   */
   $css = " ";
   break;
  
  default:
   # code...
   break;
 }
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




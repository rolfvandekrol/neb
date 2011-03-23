<?php
/* Nukes the css from drupal core */
function mothership_css_alter(&$css) {
  if(theme_get_setting('mothership_nuke_css') != "mothership_css_nuke_none" ){
    //Lets start by clearing up the css file names so the follows the BAT definitions 
    //
    $mothership_csscore_path = drupal_get_path('theme', 'mothership') . '/css-drupalcore/';
    $mothership_cssmodules_path = drupal_get_path('theme', 'mothership') . '/css-modules/';

    if(module_exists('aggregator')){
      $css = drupal_add_css($mothership_csscore_path . 'aggregator.theme.css', array('group' => CSS_SYSTEM));
    } 

    if(module_exists('block')){
      $css = drupal_add_css($mothership_csscore_path . 'block.admin.css', array('group' => CSS_SYSTEM));
    } 

    if(module_exists('book')){
      $css = drupal_add_css($mothership_csscore_path . 'book.theme.css', array('group' => CSS_SYSTEM));
      $css = drupal_add_css($mothership_csscore_path . 'book.admin.css', array('group' => CSS_SYSTEM));
    } 

    if(module_exists('comment')){
      $css = drupal_add_css($mothership_csscore_path . 'comment.theme.css', array('group' => CSS_SYSTEM));  
    } 

    if(module_exists('contextual')){
      $css = drupal_add_css($mothership_csscore_path . 'contextual.base.css', array('group' => CSS_SYSTEM));
      $css = drupal_add_css($mothership_csscore_path . 'contextual.theme.css', array('group' => CSS_SYSTEM));
    } 

    if(module_exists('field')){
      $css = drupal_add_css($mothership_csscore_path . 'field.theme.css', array('group' => CSS_SYSTEM));  
      $css = drupal_add_css($mothership_csscore_path . 'field_ui.admin.css', array('group' => CSS_SYSTEM));    
    }

    if(module_exists('file')){
      $css = drupal_add_css($mothership_csscore_path . 'file.theme.css', array('group' => CSS_SYSTEM));  
    }
 
    if(module_exists('filter')){
      $css = drupal_add_css($mothership_csscore_path . 'filter.theme.css', array('group' => CSS_SYSTEM));    
    }

    if(module_exists('forum')){
      $css = drupal_add_css($mothership_csscore_path . 'forum.theme.css', array('group' => CSS_SYSTEM));    
    }

    if(module_exists('help')){
      $css = drupal_add_css($mothership_csscore_path . 'help.theme.css', array('group' => CSS_SYSTEM));      
    }

    if(module_exists('image')){
      $css = drupal_add_css($mothership_csscore_path . 'image.theme.css', array('group' => CSS_SYSTEM));        
    } 

    if(module_exists('local')){
       $css = drupal_add_css($mothership_csscore_path . 'local.theme.css', array('group' => CSS_SYSTEM));          
    } 

    if(module_exists('menu')){
      $css = drupal_add_css($mothership_csscore_path . 'menu.admin.css', array('group' => CSS_SYSTEM));            
    } 

    if(module_exists('node')){
      $css = drupal_add_css($mothership_csscore_path . 'node.theme.css', array('group' => CSS_SYSTEM));      
    }   

    if(module_exists('openid')){
      $css = drupal_add_css($mothership_csscore_path . 'openid.base.css', array('group' => CSS_SYSTEM));      
      $css = drupal_add_css($mothership_csscore_path . 'openid.theme.css', array('group' => CSS_SYSTEM));      
    }   
    /* TODO overlay
    if(module_exists('overlay')){

    }
    */
    if(module_exists('poll')){
      $css = drupal_add_css($mothership_csscore_path . 'poll.admin.css', array('group' => CSS_SYSTEM));      
      $css = drupal_add_css($mothership_csscore_path . 'poll.theme.css', array('group' => CSS_SYSTEM));      
    } 

    if(module_exists('poll')){ 
      $css = drupal_add_css($mothership_csscore_path . 'profile.theme.css', array('group' => CSS_SYSTEM));      
    } 

    if(module_exists('search')){ 
      $css = drupal_add_css($mothership_csscore_path . 'search.theme.css', array('group' => CSS_SYSTEM));      
    } 

    if(module_exists('shortcut')){ 
      $css = drupal_add_css($mothership_csscore_path . 'shortcut.theme.css', array('group' => CSS_SYSTEM));      
    } 
    if(module_exists('toolbar')){ 
      $css = drupal_add_css($mothership_csscore_path . 'toolbar.theme.css', array('group' => CSS_SYSTEM));      
    } 

    if(module_exists('tracker')){ 
      $css = drupal_add_css($mothership_csscore_path . 'tracker.theme.css', array('group' => CSS_SYSTEM));      
    } 

    if(module_exists('update')){ 
      $css = drupal_add_css($mothership_csscore_path . 'update.theme.css', array('group' => CSS_SYSTEM));      
    }

    /* TODO vertical-tabs

    */
  
    /* TODO all system files

    */

    /* TODO menu

    */
    
    /* TODO taxonomy
    
    */

    //modules
    if(module_exists('views')){ 
      $css = drupal_add_css($mothership_cssmodules_path . 'views.base.css', array('group' => CSS_SYSTEM));      
      $css = drupal_add_css($mothership_cssmodules_path . 'views.theme.css', array('group' => CSS_SYSTEM));      
    }


   //nuke the original css files
   $nuke = array(
     'modules/aggregator/aggregator.css' => FALSE,
     'modules/block/block.css' => FALSE,
     'modules/book/book.css' => FALSE,
     'modules/comment/comment.css' => FALSE,
     'modules/contextual/contextual.css' => FALSE,   
     'modules/forum/forum.css' => FALSE,
     'modules/field/theme/field.css' => FALSE,
     'modules/file/file.css' => FALSE,   
     'modules/filter/filter.css' => FALSE,
     'modules/field/field_ui.css' => FALSE,   
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
     'modules/system/system.menus.css' => FALSE,     
      //'misc/vertical-tabs.css' => FALSE, 
      //modules/overlay/overlay-parent.css
      //modules/system/system.menus.css
      //modules/system/system.messages.css
      
      //modules
      drupal_get_path('module', 'views') . '/css/views.css' => FALSE,
      drupal_get_path('module', 'ctools') . '/css/ctools.css' => FALSE,
    );


    $css = array_diff_key($css, $nuke);
//    kpr($css);
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
      if (
        //first check those css files we dont wanna remove
        strpos($file, 'toolbar.theme.css') == FALSE AND 
        strpos($file, 'shortcut.theme.css') == FALSE AND 
        strpos($file, 'contextual.theme.css') == FALSE 
      ) {
        if (strpos($file, '.theme.css') !== FALSE ) {
          unset($css[$file]);
        }
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




<?php

/**
 * include template overwrites
 */
include_once './' . drupal_get_path('theme', 'mothership') . '/functions/css.php';
include_once './' . drupal_get_path('theme', 'mothership') . '/functions/js.php';
include_once './' . drupal_get_path('theme', 'mothership') . '/functions/icons.php';
include_once './' . drupal_get_path('theme', 'mothership') . '/functions/form.php';
include_once './' . drupal_get_path('theme', 'mothership') . '/functions/table.php';
include_once './' . drupal_get_path('theme', 'mothership') . '/functions/views.php';
include_once './' . drupal_get_path('theme', 'mothership') . '/functions/menu.php';

// Auto-rebuild the theme registry during theme development.
if (theme_get_setting('mothership_rebuild_registry')) {
  system_rebuild_theme_data();
}

function mothership_preprocess(&$vars, $hook) {
  //http://api.drupal.org/api/drupal/includes--theme.inc/function/template_preprocess_html/7
  //kpr($vars['classes_array']);

/*
  print "<br><pre>";
  print_r($hook);
  print "</pre>";
*/

  //Faveicon
  global $theme;
  $path = drupal_get_path('theme', $theme);
  $appletouchicon =  '<link rel="apple-touch-icon" href="' . $path . '/apple-touch-icon.png">' . "\n";
  $appletouchicon .= '  <link rel="apple-touch-icon" sizes="72x72" href="' . $path . '/apple-touch-icon-ipad.png">' . "\n";
  $appletouchicon .= '  <link rel="apple-touch-icon" sizes="114x114" href="' . $path . '/apple-touch-icon-iphone4.png">';


  //---POOR THEMERS HELPER
  if(theme_get_setting('mothership_poorthemers_helper')){
    $vars['mothership_poorthemers_helper'] = "<!--";
    //theme hook suggestions
    $vars['mothership_poorthemers_helper'] .= "\n theme hook suggestions:";
    $vars['mothership_poorthemers_helper'] .= "\n hook:" . $hook ." \n ";
    foreach ($vars['theme_hook_suggestions'] as $key => $value){
        $value = str_replace('_','-',$value);
        $vars['mothership_poorthemers_helper'] .= " * " . $value . ".tpl.php \n" ;
    }

    $vars['mothership_poorthemers_helper'] .= "-->";
  }else{
    $vars['mothership_poorthemers_helper'] ="";
  }
  //---/POOR THEMERS HELPER



  if ($hook == "html") {
  // =======================================| HTML |========================================

    //custom 403/404
    $headers = drupal_get_http_header();

    if(theme_get_setting('mothership_404')){
      if($headers['status'] == '404 Not Found'){
        $vars['theme_hook_suggestions'][] = 'html__404';
      }
    }

    /*
    if(theme_get_setting('mothership_403')){
      if($headers['status'] == '403 Forbidden'){
        $vars['theme_hook_suggestions'][] = 'html__403';
      }
    }
    */

    /*
      Adds reset css files that the sub themes might wanna use.
      reset.css - eric meyer ftw
      reset-html5.css - html5doctor.com/html-5-reset-stylesheet/
      defaults.css cleans some of the defaults from drupal
      mothership.css - adds css for use with icons & other markup fixes
    */
    if (theme_get_setting('mothership_css_reset')) {
      drupal_add_css(drupal_get_path('theme', 'mothership') . '/css/reset.css', array('group' => CSS_THEME, 'every_page' => TRUE, 'weight' => -20));
    }
    if (theme_get_setting('mothership_css_reset_html5')) {
      drupal_add_css(drupal_get_path('theme', 'mothership') . '/css/reset-html5.css', array('group' => CSS_THEME, 'every_page' => TRUE, 'weight' => -20));
    }
    if (theme_get_setting('mothership_css_normalize')) {
      drupal_add_css(drupal_get_path('theme', 'mothership') . '/css/normalize.css', array('group' => CSS_THEME, 'every_page' => TRUE, 'weight' => -20));
    }

    if (theme_get_setting('mothership_css_default')) {
      drupal_add_css(drupal_get_path('theme', 'mothership') . '/css/mothership-default.css', array('group' => CSS_THEME, 'every_page' => TRUE, 'weight' => -15));
    }
    if (theme_get_setting('mothership_css_layout')) {
      drupal_add_css(drupal_get_path('theme', 'mothership') . '/css/mothership-layout.css', array('group' => CSS_THEME, 'every_page' => TRUE, 'weight' => -14));
    }
    if (theme_get_setting('mothership_css_mothershipstyles')) {
      drupal_add_css(drupal_get_path('theme', 'mothership') . '/css/mothership.css', array('group' => CSS_THEME, 'every_page' => TRUE, 'weight' => -10));
    }

    //LIBS
    //We dont wanna add modules just to put in a goddamn js file so were adding em here instead

    //modernizr love CDN style for the lazy ones
    if (theme_get_setting('mothership_modernizr')) {
      drupal_add_js('http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.0.6/modernizr.min.js', 'external');
    }

    //selectivizr
    $vars['selectivizr'] = '';
    if(theme_get_setting('mothership_selectivizr')) {
      $vars['selectivizr'] .= '<!--[if (gte IE 6)&(lte IE 8)]>' . "\n";;
      $vars['selectivizr'] .= '<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>' . "\n";;
      $vars['selectivizr'] .= '<![endif]-->' . "\n";;

    }


    //html5 fix
    $vars['html5iefix'] = '';
    if(theme_get_setting('mothership_html5')) {
      $vars['html5iefix'] .= '<!--[if lt IE 9]>';
      $vars['html5iefix'] .= '<script src="' . drupal_get_path('theme', 'mothership') . '/js/html5.js"></script>';
      $vars['html5iefix'] .= '<![endif]-->';
    }

    $vars['appletouchicon'] = $appletouchicon;
//    <!-- For Nokia -->
//    <link rel="shortcut icon" href="img/l/apple-touch-icon.png">


    //----- C S S CLASSES  -----------------------------------------------------------------------------------------------
    //Remove & add cleasses body
    if (theme_get_setting('mothership_classes_body_html')) {
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('html')));
    }

    if (theme_get_setting('mothership_classes_body_front')) {
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('not-front')));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('front')));
    }

    if (theme_get_setting('mothership_classes_body_loggedin')) {
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('logged-in')));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('not-logged-in')));
    }

    if (theme_get_setting('mothership_classes_body_layout')) {
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('two-sidebars')));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('one-sidebar sidebar-first')));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('one-sidebar sidebar-second')));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('no-sidebars')));
    }

    if (theme_get_setting('mothership_classes_body_toolbar')) {
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('toolbar')));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('toolbar-drawer')));
    }

    if (theme_get_setting('mothership_classes_body_pagenode')) {
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('page-node')));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('page-node-')));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('page-node-1')));
    }

    if (theme_get_setting('mothership_classes_body_path')) {
      $path_all = drupal_get_path_alias($_GET['q']);
      $vars['classes_array'][] = drupal_html_class('path-' . $path_all);
    }

    if (theme_get_setting('mothership_classes_body_path_first')) {
      $path = explode('/', $_SERVER['REQUEST_URI']);
      if($path['1']){
        $vars['classes_array'][] = drupal_html_class('pathone-' . $path['1']);
      }
    }

    if (theme_get_setting('mothership_test')) {
        $vars['classes_array'][] = "test";
    }

    //freeform css class killing
    $remove_class_body = explode(", ", theme_get_setting('mothership_classes_body_freeform'));
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],$remove_class_body));

  }
  elseif ( $hook == "page" ) {
    // =======================================| PAGE |========================================

    //Test for expected modules
    if (theme_get_setting('mothership_expectedmodules')) {
      //test to see if blockify is installed
      if(!module_exists('blockify')){
        print_r('Tema use the blockify module - so you can move the logo, title, taps where you wants to & makes the page.tpl easier to work with: <a href="http://drupal.org/project/blockify">Download</a>');
      }
    }


    //template suggestion: page--nodetype.tpl.php
    if ( isset($vars['node']) ){
      $vars['theme_hook_suggestions'][] = 'page__' . $vars['node']->type;
    }

    //custom 404/404
    $headers = drupal_get_http_header();

    if (isset($headers['status'])) {
      if($headers['status'] == '404 Not Found'){
        $vars['theme_hook_suggestions'][] = 'page__404';
      }

    }


    // Remove the block template wrapper from the main content block.
    if (!empty($vars['page']['content']['system_main']) AND
        theme_get_setting('mothership_content_block_wrapper') AND
        is_array($vars['page']['content']['system_main']['#theme_wrappers'])
    ) {
      $vars['page']['content']['system_main']['#theme_wrappers'] = array_diff($vars['page']['content']['system_main']['#theme_wrappers'], array('block'));
    }


    //unset regions in the frontpage
//    if (drupal_is_front_page() AND theme_get_setting('mothership_frontpage_regions')) {
    //  unset($vars['page']['sidebar_first'], $vars['page']['sidebar_second'], $vars['page']['content']);
  //  }

    //remove the content not found on the frontpage
    if(theme_get_setting('mothership_frontpage_default_message')){
      unset($vars['page']['content']['system_main']['default_message']);
    }



  }elseif ( $hook == "region" ) {
    // =======================================| region |========================================

    if (theme_get_setting('mothership_classes_region')) {
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('region')));
    }


  }elseif ( $hook == "block" ) {

    // =======================================| block |========================================
    //block-subject should be called title so it actually makes sence...
    //  $vars['title'] = $block->subject;
    $vars['id_block'] = "";
    if (theme_get_setting('mothership_classes_block')) {
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('block')));
    }

    if (theme_get_setting('mothership_classes_block_contextual')) {
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('contextual-links-region')));
    }

    if (!theme_get_setting('mothership_classes_block_id')) {
      $vars['id_block'] = ' id="' . $vars['block_html_id'] . '"';
    }

    if (theme_get_setting('mothership_classes_block_id_as_class')) {
      $vars['classes_array'][] = $vars['block_html_id'];
    }

    //freeform css class killing
    $remove_class_block = explode(", ", theme_get_setting('mothership_classes_block_freeform'));
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],$remove_class_block));


    //adds title class to the block ... OMG!
    $vars['title_attributes_array']['class'][] = 'title';
    $vars['content_attributes_array']['class'][] = 'block-content';

    //add a theme suggestion to block--menu.tpl so we dont have create a ton of blocks with <nav>
    if(
      ($vars['elements']['#block']->module == "system" AND $vars['elements']['#block']->delta == "navigation") OR
      ($vars['elements']['#block']->module == "system" AND $vars['elements']['#block']->delta == "main-menu") OR
      ($vars['elements']['#block']->module == "system" AND $vars['elements']['#block']->delta == "user-menu") OR
      ($vars['elements']['#block']->module == "admin" AND $vars['elements']['#block']->delta == "menu") OR
      $vars['elements']['#block']->module == "menu_block"
    ){
      $vars['theme_hook_suggestions'][] = 'block__menu';
    }
/*
    print "<pre>";
    print_r($vars['elements']['#block']->module);
    print "<br>";
    print_r($vars['elements']['#block']->delta);
    print_r($vars['theme_hook_suggestions']);
    print "</pre>";
*/
  } elseif ( $hook == "node" ) {
    // =======================================| NODE |========================================

    $vars['id_node'] ="";

    if (theme_get_setting('mothership_classes_node')) {
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('node')));
    }

    if (theme_get_setting('mothership_classes_node_state')) {
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('node-sticky')));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('node-unpublished')));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('node-promoted')));
    }

    if (isset($vars['preview'])) {
      $vars['classes_array'][] = 'node-preview';
    }

    //freeform css class killing
    $remove_class_node = explode(", ", theme_get_setting('mothership_classes_node_freeform'));
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],$remove_class_node));

    // css id for the node
    if (theme_get_setting('mothership_classes_node_id')) {
      $vars['id_node'] =  'node-'. $vars['nid'];
    }

    /*
    remove class from the ul that holds the links
    <ul class="inline links">
    this is generated in the node_build_content() function in the node.module
    */
    if (theme_get_setting('mothership_classes_node_links_inline')) {
      $vars['content']['links']['#attributes']['class'] = array_values(array_diff($vars['content']['links']['#attributes']['class'],array('inline')));
    }

    if (theme_get_setting('mothership_classes_node_links_links')) {
      $vars['content']['links']['#attributes']['class'] = array_values(array_diff($vars['content']['links']['#attributes']['class'],array('links')));
    }
    // TODO: add a field to push in whatever class names we want to
    // $vars['content']['links']['#attributes']['class'][] = "hardrock hallelulia";

    //  remove the class attribute it its empty
    if(!$vars['content']['links']['#attributes']['class']){
      unset($vars['content']['links']['#attributes']['class']);
    }


  } elseif ( $hook == "comment" ) {
    // =======================================| COMMENT |========================================
      $vars['classes_array'][] = 'wooho';

      if ($vars['elements']['#comment']->new){
        $vars['classes_array'][] = ' comment-unpublished';
      }

      //remove inline class from the ul links
      if (theme_get_setting('mothership_classes_node_links_inline')) {
        $vars['content']['links']['#attributes']['class'] = array_values(array_diff($vars['content']['links']['#attributes']['class'],array('inline')));
      }



  }elseif ( $hook == "field" ) {
    // =======================================| FIELD |========================================
    if (theme_get_setting('mothership_classes_field_field')) {
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field')));
    }

    //freeform css class killing
    $remove_class_field = explode(", ", theme_get_setting('mothership_classes_field_freeform'));
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],$remove_class_field));

    //type
    if (theme_get_setting('mothership_classes_field_type')) {
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-type-text')));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-type-text-with-summary')));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-type-ds')));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-type-image')));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-type-email')));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-type-taxonomy-term-reference')));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-type-link-field')));
    }

    //label
    if (theme_get_setting('mothership_classes_field_label')) {
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-label-hidden')));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-label-above')));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-label-inline')));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('clearfix')));

    }




  }elseif ( $hook == "maintenance_page" ) {

    // =======================================| maintenance page |========================================

    $vars['path'] = $path;
    $vars['appletouchicon'] = $appletouchicon;
    $vars['selectivizr'] = $selectivizr;

    $vars['theme_hook_suggestions'][] = 'static__maintenance';


  }
}




/*
Remove the standard classes from a field
TODO remove all classes
TODO remove the "field-name-" prefix from a styles name
*/
/*
function mothership_preprocess_field(&$vars, $hook) {

  if (theme_get_setting('mothership_classes_field_field')) {
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field')));
  }

  //freeform css class killing
  $remove_class_field = explode(", ", theme_get_setting('mothership_classes_field_freeform'));
  $vars['classes_array'] = array_values(array_diff($vars['classes_array'],$remove_class_field));

  //type
  if (theme_get_setting('mothership_classes_field_type')) {
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-type-text')));
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-type-text-with-summary')));
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-type-ds')));
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-type-image')));
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-type-email')));
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-type-taxonomy-term-reference')));
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-type-link-field')));
  }

  //label
  if (theme_get_setting('mothership_classes_field_label')) {
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-label-hidden')));
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-label-above')));
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field-label-inline')));
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('clearfix')));

  }


}
*/

function mothership_class_killer(&$vars){
  $remove_class_node = explode(", ", theme_get_setting('mothership_classes_node_freeform'));
  $vars['classes_array'] = array_values(array_diff($vars['classes_array'],$remove_class_node));
  $vars['classes'] = "";

//  kpr($vars['classes_array']);
 // return $vars;
}




/**
 * Implements hook_theme_registry_alter().
 */
function mothership_theme_registry_alter(&$theme_registry) {
//  kpr($theme_registry);
  //enough of this bull lets kill em classes
  $theme_registry['node']['preprocess functions'][] = 'mothership_class_killer';

/*
  // Kill the next/previous forum topic navigation links.
  foreach ($theme_registry['forum_topic_navigation']['preprocess functions'] as $key => $value) {
    if ($value = 'template_preprocess_forum_topic_navigation') {
      unset($theme_registry['forum_topic_navigation']['preprocess functions'][$key]);
    }
  }
*/
}


<?php
/**
 * include template overwrites
 */
include_once './' . drupal_get_path('theme', 'mothership') . '/functions/css-alter.php';
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

  //    dsm($vars['classes_array']);


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
      drupal_add_css(drupal_get_path('theme', 'mothership') . '/css/default.css', array('group' => CSS_THEME, 'every_page' => TRUE, 'weight' => -15));
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

    //add selectivizr support
    if (theme_get_setting('mothership_selectivizr')) {    
      $vars['selectivizr'] = '<!--[if (gte IE 6)&(lte IE 8)]>';
      $vars['selectivizr'] .= '<script type="text/javascript" src="/sites/all/libraries/selectivizr/selectivizr.js"></script>';
 //     $vars['selectivizr'] .= '<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>';
      $vars['selectivizr'] .= '<![endif]-->';
    }else{
      $vars['selectivizr'] = '';
    }

    //TODO: do we wanna add external libs directly in the theme settings
    //if a user wanna add some external css file 
    //well then lets rock n roll
    /*
    if (theme_get_setting('mothership_css_external')) {
      drupal_add_css('http://foobar.css', array('type' => 'external'));
    }
    
    if (theme_get_setting('mothership_js_external')) {
      drupal_add_js('http://foobar.js', 'external');
    }
    */

    //home screen icon for ipads n stuff
    global $theme;
    $path = drupal_get_path('theme', $theme);
    $vars['appletouchicon'] = '<link rel="apple-touch-icon" href="' . $path . '/apple-touch-icon.png">' . "\n";
	  $vars['appletouchicon'] .= '<link rel="apple-touch-icon" sizes="72x72" href="' . $path . '/apple-touch-icon-ipad.png">' . "\n";
	  $vars['appletouchicon'] .= '<link rel="apple-touch-icon" sizes="114x114" href="' . $path . '/apple-touch-icon-iphone4.png">';


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
    // Add HTML tag name for title tag. so it can shift from a h1 to a div if its the frontpage
    $vars['site_name_element'] = $vars['is_front'] ? 'h1' : 'div';

    //template suggestion: page--nodetype.tpl.php
    if ( isset($vars['node']) ){
      $vars['theme_hook_suggestions'][] = 'page__' . $vars['node']->type;
    }

    // Remove the block template wrapper from the main content block.
    if (!empty($vars['page']['content']['system_main']) AND theme_get_setting('mothership_content_block_wrapper')) {
      $vars['page']['content']['system_main']['#theme_wrappers'] = array_diff($vars['page']['content']['system_main']['#theme_wrappers'], array('block'));
    }


    //unset regions in the frontpage
    if (drupal_is_front_page() AND theme_get_setting('mothership_frontpage_regions')) {
      unset($vars['page']['sidebar_first'], $vars['page']['sidebar_second'], $vars['page']['content']);
    }

    //remove the content not found yadi yadi on the frontpage
    if(theme_get_setting('mothership_frontpage_default_message')){
      unset($vars['page']['content']['system_main']['default_message']);
    }



  }elseif ( $hook == "region" ) {
    // =======================================| region |========================================

    if (theme_get_setting('mothership_classes_region')) {      
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('region')));        
    }

      
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
  
  //  kpr($vars['classes_array']);
    
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

      if (theme_get_setting('mothership_classes_block_contexual_only')) {            
        $vars['classes_array'] ="";
        $vars['classes_array'][] = "contextual-links-region";
      }

      //freeform css class killing
      $remove_class_block = explode(", ", theme_get_setting('mothership_classes_block_freeform'));
      $vars['classes_array'] = array_values(array_diff($vars['classes_array'],$remove_class_block));


    //  if (theme_get_setting('mothership_classes_block_contentdiv')) {            
    //    $vars['classes_array'][] = 'block-content';        
    //  }


      //adds title class to the block ... OMG!
      $vars['title_attributes_array']['class'][] = 'title';
      $vars['content_attributes_array']['class'][] = 'block-content';        
      

//      mothership_classes_block_contentdiv

   //   $vars['title'] = $block->subject;

    }


}

function mothership_preprocess_html(&$vars) {
  //add regions to header & footer so we can actually use these placeholders for something
  $vars['page_header'] = drupal_render($vars['page']['page_header']);  
  $vars['page_footer'] = drupal_render($vars['page']['page_footer']);    

//  kpr($vars);

}
/*
function mothership_preprocess_page(&$vars, $hook) {
  //  Enough with the default message "  No front page content has been created yet. Add new content"
  if(theme_get_setting('mothership_frontpage_default_message')){
    unset($vars['page']['content']['system_main']['default_message']);
  }
}
*/

function mothership_preprocess_node(&$vars,$hook) {
  //  krumo($vars['content']);
}

function mothership_preprocess_block(&$vars, $hook) {
  //  krumo($vars['content']);
}



/*
Remove the standard classes from a field
TODO remove all classes
TODO remove the "field-name-" prefix from a styles name
*/
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
  }

 
}


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


<?php
/* =====================================
  mothership
  template.php
* ------------------------------------- */



/* =====================================
  include template overwrites
* ------------------------------------- */
    include_once './' . drupal_get_path('theme', 'mothership') . '/template/template.functions.php';
    include_once './' . drupal_get_path('theme', 'mothership') . '/template/template.form.php';
    include_once './' . drupal_get_path('theme', 'mothership') . '/template/template.cck.php';
    include_once './' . drupal_get_path('theme', 'mothership') . '/template/template.table.php';
    include_once './' . drupal_get_path('theme', 'mothership') . '/template/template.alternatives.php';
/* =====================================
  preprocess
* ------------------------------------- */
function mothership_preprocess_page(&$vars, $hook) {
  // Define the content width
  //  $vars['column_left_classes'] = $vars['right'] ? 'grid-8' : 'grid-12';
  // Add HTML tag name for title tag.
  $vars['site_name_element'] = $vars['is_front'] ? 'h1' : 'div';

  // Classes for body element. Allows advanced theming based on context
  // (home page, node of certain type, etc.)
  $body_classes = array($vars['body_classes']);
  if (!$vars['is_front']) {
    // Add unique classes for each page and website section
    $path = drupal_get_path_alias($_GET['q']);
    list($section, ) = explode('/', $path, 2);
    $body_classes[] = mothership_id_safe('page-' . $path);
    $body_classes[] = mothership_id_safe('section-' . $section);
    if (arg(0) == 'node') {
      if (arg(1) == 'add') {
        if ($section == 'node') {
          array_pop($body_classes); // Remove 'section-node'
        }
        $body_classes[] = 'section-node-add'; // Add 'section-node-add'
      }
      elseif (is_numeric(arg(1)) && (arg(2) == 'edit' || arg(2) == 'delete')) {
        if ($section == 'node') {
          array_pop($body_classes); // Remove 'section-node'
        }
        $body_classes[] = 'section-node-' . arg(2); // Add 'section-node-edit' or 'section-node-delete'
      }
    }
  }

  $vars['body_classes'] = implode(' ', $body_classes); // Concatenate with spaces
  
}

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* 
function mothership_preprocess_node(&$vars, $hook) {
 
  // Split out node-specific preprocessors, too.
  $function = 'mothership_preprocess_node_' . $vars['node']->type;
  if (function_exists($function)) {
    $function($vars, $hook);
  }
 
}
*/
function mothership_preprocess_node(&$vars, $hook) {
  // Special classes for nodes
  $classes =array();

  if ($vars['sticky']) {
    $classes[] = 'sticky';
  }
  if (!$vars['status']) {
    $classes[] = 'node-unpublished';
    $vars['unpublished'] = TRUE;
  }
  else {
    $vars['unpublished'] = FALSE;
  }
  //teaser or node
  if ($vars['teaser']) {
    $classes[] = 'node-teaser';
  }else{
    $classes[] = 'node';
  }
  // Class for node type: "node-page", "node-story"
  $classes[] = 'node-' . $vars['type'];
  
  $vars['classes'] = implode(' ', $classes);

  //Add regions to a node? 
  //TODO take this out and add is a part of the documentation
  if ($vars['page'] == TRUE) {
    $vars['node_region_one'] = theme('blocks', 'node_region_one');
    $vars['node_region_two'] = theme('blocks', 'node_region_two');
  }
  
  // quick and easy view of the templates..
 //  dsm($vars['template_files']) ;
}

function mothership_preprocess_block(&$vars, $hook) {
  $block = $vars['block'];
  // classes for blocks.
  $classes = array('block');
  $classes[] = 'block-' . $block->module;
  $classes[] = $vars['zebra'];

  $vars['edit_links_array'] = array();
  $vars['edit_links'] = '';
  if (user_access('administer blocks')) {
    include_once './' . drupal_get_path('theme', 'mothership') . '/template/template.block-editing.php';
    zen_mothership_preprocess_block_editing($vars, $hook);
    $classes[] = 'with-block-editing';
  }
  // Render block classes.
  $vars['classes'] = implode(' ', $classes);
}

/* =====================================
  views
* ------------------------------------- */
function mothership_preprocess_views_view_list(&$vars){
  mothership_preprocess_views_view_unformatted($vars);  
}

  function mothership_preprocess_views_view_unformatted(&$vars) {
    $view     = $vars['view'];
    $rows     = $vars['rows'];

    $vars['classes'] = array();
    // Set up striping values.
    // foreach ($rows as $id => $row) {
    //  $vars['classes'][$id] = 'views-row-' . ($id + 1);
    //    $vars['classes'][$id] .= ' views-row-' . ($id % 2 ? 'even' : 'odd');
    //  if ($id == 0) {
    //    $vars['classes'][$id] .= ' first';
    //  }
   // }
   // $vars['classes'][$id] .= ' last';
  }


/* =====================================
  Breadcrumb
* ------------------------------------- */
function mothership_preprocess(&$variables, $hook) {
    //Make active page title in breadcrumbs 
    if(!empty($variables['breadcrumb'])) $variables['breadcrumb'] = '<ul class="breadcrumb">'.$variables['breadcrumb'].'<li>: '.$variables['title'].'</li></ul>';
}

/*changes the home title to the sitename*/
function mothership_breadcrumb($breadcrumb) {
  GLOBAL $base_path;
  if (strip_tags($breadcrumb[0]) == "Home") {
    $breadcrumb[0] ='<a href="'.$base_path.'">'.variable_get(site_name,'').'</a>';
  }

  if (!empty($breadcrumb)) {
    return '<li>'. implode('/</li><li>', $breadcrumb) .'</li>';
  }
}

/* =====================================
  Clean up
* ------------------------------------- */
//filter tips http://drupal.org/node/215653
//TODO this should be moved into a module
/*
function mothership_filter_tips($tips, $long = FALSE, $extra = '') {
  return '';
}
function mothership_filter_tips_more_info () {
  return '';
}
*/
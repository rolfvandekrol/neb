<?php 
/**
 * Return the theme settings' default values from the .info and save them into the database.
 *
 * @param $theme
 *   The name of theme.
 */
 
function mothership_theme_get_default_settings($theme) {

  $themes = list_themes();

  // Get the default values from the .info file.
  $defaults = !empty($themes[$theme]->info['settings']) ? $themes[$theme]->info['settings'] : array();

  if (!empty($defaults)) {
    // Get the theme settings saved in the database.
    $settings = theme_get_settings($theme);
    // Don't save the toggle_node_info_ variables.
    if (module_exists('node')) {
      foreach (node_get_types() as $type => $name) {
        unset($settings['toggle_node_info_' . $type]);
      }
    }
    // Save default theme settings.
    variable_set(
      str_replace('/', '_', 'theme_' . $theme . '_settings'),
      array_merge($defaults, $settings)
    );
    // If the active theme has been loaded, force refresh of Drupal internals.
    if (!empty($GLOBALS['theme_key'])) {
      theme_get_setting('', TRUE);
    }
  }

  // Return the default settings.
  return $defaults;
}


/* =====================================
  SETTINGS
* ------------------------------------- */
/**
* Implementation of THEMEHOOK_settings() function.
*/


//function phptemplate_settings($saved_settings){
function mothership_settings($saved_settings, $subtheme_defaults = array()){

  // Get the default values from the .info file.
  $defaults = mothership_theme_get_default_settings('mothership');

  // Allow a subtheme to override the default values.
  $defaults = array_merge($defaults, $subtheme_defaults); //zen ftw

  // Merge the saved variables and their default values.
  $settings = array_merge($defaults, $saved_settings);

  // Merge the saved variables and their default values.
  $settings = array_merge($defaults, $saved_settings);
  GLOBAL $vars;

  // -- cleanup -------------------------------------
  $form['cleanup'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('"Tipl Phiphs" CSS Cleanup'),
    '#collapsible' => TRUE, 
    '#collapsed' => FALSE,
  );
  
  // -- body ------------------------------------- 
  $form['cleanup']['body'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('body (page.tpl)'),
    '#collapsible' => TRUE, 
    '#collapsed' => FALSE,    
  );

  $form['cleanup']['body']['mothership_cleanup_body_path'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Add path based class'),
    '#default_value' => $settings['mothership_cleanup_body_path'],
  );

  $form['cleanup']['body']['mothership_cleanup_body_actions'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Add action based classes: edit, delete'),
    '#default_value' => $settings['mothership_cleanup_body_actions'],
  );
  
  // -- node -------------------------------------
  $form['cleanup']['node'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('node.tpl'),
    '#collapsible' => TRUE, 
    '#collapsed' => FALSE,    
  );

  $form['cleanup']['node']['mothership_cleanup_node_node'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add node '),
    '#default_value' => $settings['mothership_cleanup_node_node'],
  );

  $form['cleanup']['node']['mothership_cleanup_node_sticky'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add sticky'),
    '#default_value' => $settings['mothership_cleanup_node_sticky'],
  );

  $form['cleanup']['node']['mothership_cleanup_node_published'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add node-unpublished'),
    '#default_value' => $settings['mothership_cleanup_node_published'],
  );

  $form['cleanup']['node']['mothership_cleanup_node_promoted'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add promoted'),
    '#default_value' => $settings['mothership_cleanup_node_promoted'],
  );
  
  $form['cleanup']['node']['mothership_cleanup_node_content_type'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('node: content type '),
    '#default_value' => $settings['mothership_cleanup_node_content_type'],
  );

  $form['cleanup']['node']['mothership_cleanup_node_teaser'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('node: teaser '),
    '#default_value' => $settings['mothership_cleanup_node_teaser'],
  );

  $form['cleanup']['node']['mothership_cleanup_node_id'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('id - generate a #node-nid '),
    '#default_value' => $settings['mothership_cleanup_node_id'],
  );


  // -- block ------------------------------------- 
  $form['cleanup']['block'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('block.tpl'),
    '#collapsible' => TRUE, 
    '#collapsed' => FALSE,    
  );
  

  $form['cleanup']['block']['mothership_cleanup_block_block'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add block'),
    '#default_value' => $settings['mothership_cleanup_block_block'],
  );

  $form['cleanup']['block']['mothership_cleanup_block_module'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add module name'),
    '#default_value' => $settings['mothership_cleanup_block_module'],
  );

  $form['cleanup']['block']['mothership_cleanup_block_region_zebra'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add odd / even  in the region region-odd / region-even'),
    '#default_value' => $settings['mothership_cleanup_block_region_zebra'],
  );

  $form['cleanup']['block']['mothership_cleanup_block_region_count'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add  region region-count-x'),
    '#default_value' => $settings['mothership_cleanup_block_region_count'],
  );

  $form['cleanup']['block']['mothership_cleanup_block_loggedin'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add block-logged-in'),
    '#default_value' => $settings['mothership_cleanup_block_loggedin'],
  );

  $form['cleanup']['block']['mothership_cleanup_block_front'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add block-front'),
    '#default_value' => $settings['mothership_cleanup_block_front'],
  );

  $form['cleanup']['block']['mothership_cleanup_block_zebra'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add odd / even for all blocks'),
    '#default_value' => $settings['mothership_cleanup_block_zebra'],
  );

  $form['cleanup']['block']['mothership_cleanup_block_count'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add  count for all blocks count-x'),
    '#default_value' => $settings['mothership_cleanup_block_count'],
  );

  $form['cleanup']['block']['mothership_cleanup_block_id'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('id - generate a id for the block '),
    '#default_value' => $settings['mothership_cleanup_block_id'],
  );


  // -- comments ------------------------------------- */
  $form['cleanup']['comment'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('comments'),
    '#collapsible' => TRUE, 
    '#collapsed' => FALSE,    
  );

  $form['cleanup']['comment']['mothership_cleanup_comment_comment'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add comment'),
    '#default_value' => $settings['mothership_cleanup_comment_comment'],
  );

  $form['cleanup']['comment']['mothership_cleanup_comment_new'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add new'),
    '#default_value' => $settings['mothership_cleanup_comment_new'],
  );

  $form['cleanup']['comment']['mothership_cleanup_comment_status'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add status'),
    '#default_value' => $settings['mothership_cleanup_comment_status'],
  );

  $form['cleanup']['comment']['mothership_cleanup_comment_first'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add first'),
    '#default_value' => $settings['mothership_cleanup_comment_first'],
  );

  $form['cleanup']['comment']['mothership_cleanup_comment_last'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add last'),
    '#default_value' => $settings['mothership_cleanup_comment_last'],
  );

  $form['cleanup']['comment']['mothership_cleanup_comment_zebra'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add odd even'),
    '#default_value' => $settings['mothership_cleanup_comment_zebra'],
  );

  $form['cleanup']['comment']['mothership_cleanup_comment_front'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add front'),
    '#default_value' => $settings['mothership_cleanup_comment_front'],
  );

  $form['cleanup']['comment']['mothership_cleanup_comment_comment'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add comment'),
    '#default_value' => $settings['mothership_cleanup_comment_comment'],
  );

  $form['cleanup']['comment']['mothership_cleanup_comment_loggedin'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add logged-in'),
    '#default_value' => $settings['mothership_cleanup_comment_loggedin'],
  );

  $form['cleanup']['comment']['mothership_cleanup_comment_user'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add user-'),
    '#default_value' => $settings['mothership_cleanup_comment_user'],
  );


  // -- views ------------------------------------- */
  
  $form['views'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Views'),
    '#collapsible' => TRUE, 
    '#collapsed' => FALSE,    
  );
  
  $form['views']['mothership_cleanup_views_first_last'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add first & last classes from views list'),
    '#default_value' => $settings['mothership_cleanup_views_first_last'],
  );

  $form['views']['mothership_cleanup_views_zebra'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add odd / even class '),
    '#default_value' => $settings['mothership_cleanup_views_zebra'],
  );

  $form['views']['mothership_cleanup_views_format_title'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Change views title fields markup'),
    '#description'   => t('Detection is based on the label text "Title". .. this is a hack I know! - better solution for this?'),
    '#default_value' => $settings['mothership_cleanup_views_format_title'],
  );

  $form['views']['mothership_cleanup_views_format_title_header'] = array(
    '#type'          => 'select',
    '#title'         => t('Title format markup'),
    '#default_value' => $settings['mothership_cleanup_views_format_title_header'],
    '#options'       => array(
                          'h1' => 'h1',
                          'h2' => 'h2',
                          'h3' => 'h3',
                          'h4' => 'h4',
                          'h5' => 'h5',
                          'h6' => 'h6',
                        ),
  );

  if(!$settings['mothership_cleanup_views_format_title']){
    $form['views']['mothership_cleanup_views_format_title_header']['#disabled'] = TRUE;    
  }


  // -- menu ------------------------------------- */
  $form['menu'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Menu'),
    '#collapsible' => TRUE, 
    '#collapsed' => FALSE,    
  );

  $form['menu']['mothership_cleanup_menu_baseclass'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('menus  ul gets a class=menu'),
    '#default_value' => $settings['mothership_cleanup_menu_baseclass'],
  );

  $form['menu']['mothership_cleanup_menu_baseclass'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add a baseclass to the menus '),
    '#default_value' => $settings['mothership_cleanup_menu_baseclass'],
  );

  $form['menu']['mothership_cleanup_menu_leafs'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add  leaf  & expanded class to the li'),
    '#default_value' => $settings['mothership_cleanup_menu_leafs'],
  );

  $form['menu']['mothership_cleanup_menu_classes_active'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add a active class for the li'),
    '#default_value' => $settings['mothership_cleanup_menu_classes_active'],
  );

  $form['menu']['mothership_cleanup_menu_classes_first_last'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('adds a first & last class in the li'),
    '#default_value' => $settings['mothership_cleanup_menu_classes_first_last'],
  );

  $form['menu']['mothership_cleanup_links_baseclass'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add a baseclasses to links -primary & secundary '),
    '#default_value' => $settings['mothership_cleanup_links_baseclass'],
  );

  $form['menu']['mothership_cleanup_links_classes_active'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add a active class for the li'),
    '#default_value' => $settings['mothership_cleanup_links_classes_active'],
  );

  $form['menu']['mothership_cleanup_links_classes_first_last'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('adds a first & last class in the li'),
    '#default_value' => $settings['mothership_cleanup_links_classes_first_last'],
  );


  // -- misc ------------------------------------- */

  $form['misc'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('misc stuff'),
    '#collapsible' => TRUE, 
    '#collapsed' => FALSE,    
  );


  $form['misc']['mothership_item_list_first_last'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove first & last classes from item lists'),
    '#default_value' => $settings['mothership_item_list_first_last'],
  );

  // -- features ------------------------------------- */

  $form['misc']['features'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Sneaky Features'),
    '#collapsible' => TRUE, 
    '#collapsed' => FALSE,    
  );

  $form['misc']['features']['mothership_cleanup_node_regions'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add regions to nodes '),
    '#default_value' => $settings['mothership_cleanup_node_regions'],
  );



  // Return form
  return $form;
  
}

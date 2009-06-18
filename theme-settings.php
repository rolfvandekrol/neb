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
function mothership_settings($saved_settings, $subtheme_defaults = array(), $theme){
  dsm($theme);
  // Get the default values from the .info file.
  $defaults = mothership_theme_get_default_settings('mothership');

  // Allow a subtheme to override the default values.
  $defaults = array_merge($defaults, $subtheme_defaults); //zen stuff

  // Merge the saved variables and their default values.
  $settings = array_merge($defaults, $saved_settings);


  // Merge the saved variables and their default values.
  $settings = array_merge($defaults, $saved_settings);
  GLOBAL $vars;
  dsm($vars);
  
  // -- cleanup -------------------------------------
  $form['cleanup'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('CSS Cleanup'),
    '#collapsible' => TRUE, 
    '#collapsed' => FALSE,
  );
  
  // -- body ------------------------------------- 
  $form['cleanup']['body'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('body classes'),
    '#collapsible' => TRUE, 
    '#collapsed' => FALSE,    
  );

  $form['cleanup']['body']['mothership_class_body_path'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Add path based class'),
    '#default_value' => $settings['mothership_class_body_path'],
  );

  $form['cleanup']['body']['mothership_class_body_actions'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Add action based classes: edit, delete'),
    '#default_value' => $settings['mothership_class_body_actions'],
  );
  
  // -- node -------------------------------------
  $form['cleanup']['node'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('node classes'),
    '#collapsible' => TRUE, 
    '#collapsed' => FALSE,    
  );

  $form['cleanup']['node']['mothership_class_node_sticky'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add sticky'),
    '#default_value' => $settings['mothership_class_node_sticky'],
  );

  $form['cleanup']['node']['mothership_class_node_published'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add node-unpublished'),
    '#default_value' => $settings['mothership_class_node_published'],
  );

  $form['cleanup']['node']['mothership_class_node_promoted'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add promoted'),
    '#default_value' => $settings['mothership_class_node_promoted'],
  );
  
  $form['cleanup']['node']['mothership_class_node_content_type'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('node: content type '),
    '#default_value' => $settings['mothership_class_node_content_type'],
  );

  $form['cleanup']['node']['mothership_class_node_teaser'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('node: teaser '),
    '#default_value' => $settings['mothership_class_node_teaser'],
  );

  $form['cleanup']['node']['mothership_class_node_node'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('node: node indicator '),
    '#default_value' => $settings['mothership_class_node_node'],
  );

  // -- block ------------------------------------- 
  $form['cleanup']['block'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('block classes'),
    '#collapsible' => TRUE, 
    '#collapsed' => FALSE,    
  );
  

  $form['cleanup']['block']['mothership_class_block_block'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add block'),
    '#default_value' => $settings['mothership_class_block_block'],
  );

  $form['cleanup']['block']['mothership_class_block_module'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add module name'),
    '#default_value' => $settings['mothership_class_block_module'],
  );

  $form['cleanup']['block']['mothership_class_block_region_zebra'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add odd / even  in the region region-odd / region-even'),
    '#default_value' => $settings['mothership_class_block_region_zebra'],
  );

  $form['cleanup']['block']['mothership_class_block_region_count'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add  region region-count-x'),
    '#default_value' => $settings['mothership_class_block_region_count'],
  );

  $form['cleanup']['block']['mothership_class_block_loggedin'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add block-logged-in'),
    '#default_value' => $settings['mothership_class_block_loggedin'],
  );

  $form['cleanup']['block']['mothership_class_block_front'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add block-front'),
    '#default_value' => $settings['mothership_class_block_front'],
  );

  $form['cleanup']['block']['mothership_class_block_zebra'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add odd / even for all blocks'),
    '#default_value' => $settings['mothership_class_block_zebra'],
  );

  $form['cleanup']['block']['mothership_class_block_count'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add  count for all blocks count-x'),
    '#default_value' => $settings['mothership_class_block_count'],
  );


  // -- comments ------------------------------------- */
  $form['cleanup']['comment'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('comments'),
    '#collapsible' => TRUE, 
    '#collapsed' => FALSE,    
  );

  $form['cleanup']['comment']['mothership_class_comment_comment'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add comment'),
    '#default_value' => $settings['mothership_class_comment_comment'],
  );

  $form['cleanup']['comment']['mothership_class_comment_new'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add new'),
    '#default_value' => $settings['mothership_class_comment_new'],
  );

  $form['cleanup']['comment']['mothership_class_comment_status'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add status'),
    '#default_value' => $settings['mothership_class_comment_status'],
  );

  $form['cleanup']['comment']['mothership_class_comment_first'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add first'),
    '#default_value' => $settings['mothership_class_comment_first'],
  );

  $form['cleanup']['comment']['mothership_class_comment_last'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add last'),
    '#default_value' => $settings['mothership_class_comment_last'],
  );

  $form['cleanup']['comment']['mothership_class_comment_zebra'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add odd even'),
    '#default_value' => $settings['mothership_class_comment_zebra'],
  );

  $form['cleanup']['comment']['mothership_class_comment_front'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add front'),
    '#default_value' => $settings['mothership_class_comment_front'],
  );

  $form['cleanup']['comment']['mothership_class_comment_comment'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add comment'),
    '#default_value' => $settings['mothership_class_comment_comment'],
  );

  $form['cleanup']['comment']['mothership_class_comment_loggedin'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add logged-in'),
    '#default_value' => $settings['mothership_class_comment_loggedin'],
  );

  $form['cleanup']['comment']['mothership_class_comment_user'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add user-'),
    '#default_value' => $settings['mothership_class_comment_user'],
  );

  
  



  // -- item list ------------------------------------- */
  $form['cleanup']['mothership_item_list_first_last'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove first & last classes from item lists'),
    '#default_value' => $settings['mothership_item_list_first_last'],
  );


  // -- views ------------------------------------- */
  
  $form['views'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('views cleanup'),
  );
  
  $form['views']['mothership_cleanup_views_list'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove first & last classes from views item list'),
    '#default_value' => $settings['mothership_cleanup_views_list'],
  );
  
  // -- features ------------------------------------- */

  $form['features'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Sneaky Features'),
  );

  $form['features']['mothership_class_node_regions'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add regions to nodes '),
    '#default_value' => $settings['mothership_class_node_regions'],
  );




  // Return form
  return $form;
  
}

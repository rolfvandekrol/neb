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


function mothership_settings($saved_settings){
  // Get the default values from the .info file.
  $defaults = mothership_theme_get_default_settings('mothership');

  // Merge the saved variables and their default values.
  $settings = array_merge($defaults, $saved_settings);
  dsm($settings);
  
  // -- cleanup ------------------------------------- */
  $form['cleanup'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('CSS Cleanup'),
    '#collapsible' => TRUE, 
    '#collapsed' => FALSE,
  );
  
  // -- body ------------------------------------- */
  $form['cleanup']['body'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('body classes'),
    '#collapsible' => TRUE, 
    '#collapsed' => FALSE,    
  );

  $form['cleanup']['body']['mothership_class_body_remove'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove Drupals default body classes'),
    '#default_value' => $settings['mothership_class_body_remove'],
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
  
  
  // -- node ------------------------------------- */
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

  // -- block ------------------------------------- */
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

  $form['cleanup']['block']['mothership_class_block_zebra'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add odd / even'),
    '#default_value' => $settings['mothership_class_block_zebra'],
  );



  // -- comments ------------------------------------- */
  $form['cleanup']['comment'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('comment classes'),
    '#collapsible' => TRUE, 
    '#collapsed' => FALSE,    
  );


  // -- item list ------------------------------------- */
  $form['cleanup']['mothership_cleanup_itemlist'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove first & last classes from item list'),
    '#default_value' => $settings['mothership_cleanup_item_list'],
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

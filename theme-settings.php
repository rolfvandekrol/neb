<?php
function mothership_form_system_theme_settings_alter(&$form, $form_state) {

  $form['development'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Theme Development'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );


  $form['development']['mothership_poorthemers_helper'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('the Poor Themers Helper'),
    '#default_value' => theme_get_setting('mothership_poorthemers_helper'),
    '#description'   => t('Adds a comments in block, node, regions etc with the suggested theme hooks'),
  );


  $form['development']['mothership_rebuild_registry'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Rebuild theme registry on every page.'),
    '#default_value' => theme_get_setting('mothership_rebuild_registry'),
    '#description'   => t('During theme development, it can be very useful to continuously <a href="!link">rebuild the theme registry</a>. WARNING: this is a huge performance penalty and must be turned off on production websites.', array('!link' => 'http://drupal.org/node/173880#theme-registry')),
  );


  //CSS Files 
  $form['css'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('.css files'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['css']['mothership_css_reset'] = array(
     '#type'          => 'checkbox',
     '#title'         => t('Add reset.css'),
     '#default_value' => theme_get_setting('mothership_css_reset')
   );

   $form['css']['mothership_css_reset_drupal'] = array(
      '#type'          => 'checkbox',
      '#title'         => t('Add reset-drupal.css'),
      '#default_value' => theme_get_setting('mothership_css_reset_drupal')
    );

  $form['css']['mothership_css_mothershipstyles'] = array(
     '#type'          => 'checkbox',
     '#title'         => t('Add mothership.css styles for markup changes'),
     '#default_value' => theme_get_setting('mothership_css_mothershipstyles')
   );


  $form['css']['nuke'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Dude! Nuke em - css files'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );


  $form['css']['nuke']['mothership_nuke_css'] = array(
    '#type'          => 'radios',
    '#title'         => t('NUKE css files') ,
    '#options'       => array(
                          'mothership_css_nuke_none'  => t('Peace! the .css isnt touched.'),
                          'mothership_css_nuke_theme' => t('<strong>.theme.css</strong> Nukes "modulename".theme.css files, but keeps "various" drupal css files'),
                          'mothership_css_nuke_theme_full' => t('<strong>.theme.css all</strong> Nukes "modulename".theme.css files'),
                          'mothership_css_nuke_admin' => t('<strong>.admin.css</strong> Nukes all "modulename".admin.css files'),
                          'mothership_css_nuke_theme_admin' => t('<strong>.theme.css & .admin.css</strong> Nukes all .theme.css + .theme.css'),
                          'mothership_css_nuke_module'  => t('<strong>Module css nuking</strong>Nukes ALL the css files provided by modules, but keeps the themes css files'),
                          'mothership_css_nuke_epic'  => t('<strong>Epic nuke</strong> none shall pass! Removes every css file that comes from modules & thmemes'),
                        ),
    '#default_value' => theme_get_setting('mothership_nuke_css'),
  );



  $form['classes'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('CSS Classes'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  //BODY
  $form['classes']['body'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('body classes (html.tpl.php)'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['classes']['body']['mothership_classes_body_html'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove the html class (.html)'),
    '#default_value' => theme_get_setting('mothership_classes_body_html')
  );

  $form['classes']['body']['mothership_classes_body_front'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove Frontpage Status (.front / .not-front)'),
    '#default_value' => theme_get_setting('mothership_classes_body_front')
  );

  $form['classes']['body']['mothership_classes_body_loggedin'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove logged in status (.logged-in / )'),
    '#default_value' => theme_get_setting('mothership_classes_body_loggedin')
  );

  $form['classes']['body']['mothership_classes_body_layout'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove layout classes (.one-sidebar | .sidebar-first | .sidebar-last)'),
    '#default_value' => theme_get_setting('mothership_classes_body_layout')
  );

  $form['classes']['body']['mothership_classes_body_toolbar'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove Toolbar (.toolbar | .toolbar-drawer )'),
    '#default_value' => theme_get_setting('mothership_classes_body_toolbar')
  );

  $form['classes']['body']['mothership_classes_body_pagenode'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove page-node (page-node | page-node- | page-node-x)'),
    '#default_value' => theme_get_setting('mothership_classes_body_pagenode')
  );

  $form['classes']['body']['mothership_classes_body_path'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Add the full path (.path-[URL])'),
    '#default_value' => theme_get_setting('mothership_classes_body_path')
  );

  $form['classes']['body']['mothership_classes_body_path_first'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Add the first parth of the path (.path-[first])'),
    '#default_value' => theme_get_setting('mothership_classes_body_path_first')
  );

  //region
  $form['classes']['region'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Region classes (region.tpl.php)'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['classes']['region']['mothership_classes_region'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove the region class from the a region'),
    '#default_value' => theme_get_setting('mothership_classes_region')
  );

  //block
  $form['classes']['block'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('block classes (block.tpl.php)'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  
  $form['classes']['block']['mothership_classes_block'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove .block'),
    '#default_value' => theme_get_setting('mothership_classes_block')
  );

  $form['classes']['block']['mothership_classes_block_id'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove the block-id (#block-$id)'),
    '#default_value' => theme_get_setting('mothership_classes_block_id')
  );

  $form['classes']['block']['mothership_classes_block_contexual_only'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('zap everything only keep the .contextual-links-region'),
    '#default_value' => theme_get_setting('mothership_classes_block_contexual_only')
  );


  //NODE
  $form['classes']['node'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('node classes (node.tpl.php)'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  $form['classes']['node']['mothership_classes_node'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove .node'),
    '#default_value' => theme_get_setting('mothership_classes_node')
  );


  $form['classes']['node']['mothership_classes_node_state'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove the node publishing classes (.node-sticky | .node-unpublished | .node-promoted)'),
    '#default_value' => theme_get_setting('mothership_classes_node_state')
  );

  $form['classes']['node']['mothership_classes_node_id'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Add the node-id as an id (#node-$id)'),
    '#default_value' => theme_get_setting('mothership_classes_node_id')
  );


  //field
  $form['classes']['field'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Field classes (field.tpl.php)'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['classes']['field']['mothership_classes_field_field'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove the field class '),
    '#default_value' => theme_get_setting('mothership_classes_field_field')
  );


  $form['classes']['field']['mothership_classes_field_type'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove the field type class '),
    '#default_value' => theme_get_setting('mothership_classes_field_type')
  );
  
  $form['classes']['field']['mothership_classes_field_label'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove the label status class '),
    '#default_value' => theme_get_setting('mothership_classes_field_label')
  );
    


  $form['helpers'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Helpers'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );


  //libaries stuff
  $form['helpers']['mothership_modernizr'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Add modernizr love'),
    '#default_value' => theme_get_setting('mothership_modernizr'),
    '#description'   => t('download .. and add to mothership/lib/'),
  );

  $form['helpers']['mothership_selectivizr'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Add selectivizr love'),
    '#default_value' => theme_get_setting('mothership_selectivizr'),
    '#description'   => t('download .. and add to mothership/lib/'),
  );
  


}

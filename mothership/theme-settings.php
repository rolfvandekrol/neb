<?php
function mothership_form_system_theme_settings_alter(&$form, $form_state) {

  $form['development'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Theme Development'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['development']['mothership_poorthemers_helper'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('the Poor Themers Helper - Experimental!'),
    '#default_value' => theme_get_setting('mothership_poorthemers_helper'),
    '#description'   => t('Add a comment tag in block, node, regions with the suggested theme hooks'),
  );

  $form['development']['mothership_rebuild_registry'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Rebuild theme registry on every page.'),
    '#default_value' => theme_get_setting('mothership_rebuild_registry'),
    '#description'   => t('During theme development, it can be very useful to continuously <a href="!link">rebuild the theme registry</a>. WARNING: this is a huge performance penalty and must be turned off on production websites.', array('!link' => 'http://drupal.org/node/173880#theme-registry')),
  );

  $form['development']['mothership_test'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Add a test class to &lt;body&gt;'),
    '#default_value' => theme_get_setting('mothership_test'),
  );

  $form['html5'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('HTML 5 '),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );


  $form['html5']['mothership_html5'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('HTML5'),
    '#default_value' => theme_get_setting('mothership_html5'),
    '#description'   => t(''),
  );

  $form['html5']['mothership_html5'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('HTML5 for extra awesomeness <doctype!> ;)'),
    '#default_value' => theme_get_setting('mothership_html5'),
    '#description'   => t('Change the header to be html5, remove the anonymous div from form'),
  );

  $form['html5']['mothership_viewport'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('add Viewport'),
    '#default_value' => theme_get_setting('mothership_html5'),
    '#description'   => t('meta name="viewport" content="width=device-width, initial-scale=1.0"'),
  );


  //CSS Files 
  $form['css'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('css files'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
      '#description'   => t('If you choose to change the css files, then Mothership splits up the drupalcore css files, into base, admin & theme files. So its easy to remove css definitions your theme dosnt need, all the files are in mothership/css-drupalcore'),    
  );

  $form['css']['nuke'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('CSS Files Nuking - BAT style'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );


  $form['css']['nuke']['mothership_nuke_css'] = array(
    '#type'          => 'radios',
    '#options'       => array(
                          'mothership_css_nuke_none'  => t('<strong>Peace!</strong> <br> the CSS isnt touched, just as Drupal wants it to be'),
                          'mothership_css_nuke_theme' => t('<strong>.theme.css (selected)</strong> <br> Nukes all .theme.css files, but keeps these files: <br>toolbar.theme.css,shortcut.theme.css, contextual.theme.css'),
                          'mothership_css_nuke_theme_full' => t('<strong>.theme.css </strong> <br>Nukes all .theme.css files'),
                          'mothership_css_nuke_admin' => t('<strong>.admin.css</strong> <br>Nukes all .admin.css files'),
                          'mothership_css_nuke_theme_admin' => t('<strong>.theme.css & .admin.css</strong> <br>Nukes all .theme.css + .theme.css'),
                          'mothership_css_nuke_module'  => t('<strong>the Nuke</strong> <br>Nukes ALL css files provided by any module, but keeps all .theme.css files'),
                          'mothership_css_nuke_epic'  => t('<strong>Epic nuke</strong><br> None shall pass! Removes every css file that comes from modules & themes'),
                        ),
    '#default_value' => theme_get_setting('mothership_nuke_css'),
  );

  $form['css']['add'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('css defaults & reset'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  
  $form['css']['add']['mothership_css_reset'] = array(
     '#type'          => 'checkbox',
     '#title'         => t('Add reset.css Resets the browser eric meyer style'),
     '#default_value' => theme_get_setting('mothership_css_reset')
   );

   $form['css']['add']['mothership_css_reset_html5'] = array(
      '#type'          => 'checkbox',
      '#title'         => t('Add html5 reset css (html5doctor) '),
      '#default_value' => theme_get_setting('mothership_css_reset_html5')
    );


   $form['css']['add']['mothership_css_default'] = array(
      '#type'          => 'checkbox',
      '#title'         => t('Add default.css clean defaults for basic elements'),
      '#default_value' => theme_get_setting('mothership_css_default')
    );

  $form['css']['add']['mothership_css_mothershipstyles'] = array(
     '#type'          => 'checkbox',
     '#title'         => t('Add mothership.css. Base styles for the markup changes that mothership provides'),
     '#default_value' => theme_get_setting('mothership_css_mothershipstyles')
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
    '#description'   => t('Modifies the classes Drupal puts into  &lt;body class="html logged-in front sidebar toolbar page-node"&gt;'),
  );

  $form['classes']['body']['mothership_classes_body_html'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove .html'),
    '#default_value' => theme_get_setting('mothership_classes_body_html')
  );

  $form['classes']['body']['mothership_classes_body_loggedin'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove .logged-in if a user is logged in'),
    '#default_value' => theme_get_setting('mothership_classes_body_loggedin')
  );

  $form['classes']['body']['mothership_classes_body_front'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove Frontpage Status (.front / .not-front)'),
    '#default_value' => theme_get_setting('mothership_classes_body_front')
  );

  $form['classes']['body']['mothership_classes_body_layout'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove the layout classes (.one-sidebar | .sidebar-first | .sidebar-last)'),
    '#default_value' => theme_get_setting('mothership_classes_body_layout')
  );

  $form['classes']['body']['mothership_classes_body_toolbar'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove Toolbar (.toolbar & .toolbar-drawer )'),
    '#default_value' => theme_get_setting('mothership_classes_body_toolbar')
  );

  $form['classes']['body']['mothership_classes_body_pagenode'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove .page-node & variants'),
    '#default_value' => theme_get_setting('mothership_classes_body_pagenode')
  );

  $form['classes']['body']['mothership_classes_body_path'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Adds a .path-$path class'),
    '#default_value' => theme_get_setting('mothership_classes_body_path')
  );

  $form['classes']['body']['mothership_classes_body_path_first'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Adds .pathone-$path'),
    '#default_value' => theme_get_setting('mothership_classes_body_path_first'),
    '#description'   => t('This will add the first path of the url. If you path looks like sitename.com/foo/bar then it will add .pathone-foo'),
  );

  //region
  $form['classes']['region'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Region classes (region.tpl.php)'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#description'   => t('Modify the div & style &lt;div class="region"&gt; & &lt;div&gt ')    
  );

  $form['classes']['region']['mothership_classes_region'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove .region'),
    '#default_value' => theme_get_setting('mothership_classes_region')
  );

  $form['classes']['region']['mothership_region_wrapper'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove the wrapper div in region.tpl'),
    '#default_value' => theme_get_setting('mothership_region_wrapper')
  );


  //block
  $form['classes']['block'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('block classes (block.tpl.php)'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#description'   => t('Modify the div wrappers style &lt;div id="#block-id" class="block  contextual-links-region block-id"&gt; ')
  );
  
  $form['classes']['block']['mothership_classes_block'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove .block'),
    '#default_value' => theme_get_setting('mothership_classes_block'),
    '#description'   => t('Dont remove this if you using context!')
  );

  $form['classes']['block']['mothership_classes_block_id'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove #block-$id'),
    '#default_value' => theme_get_setting('mothership_classes_block_id')
  );

  $form['classes']['block']['mothership_classes_block_id_as_class'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Add the #block-$id as a class)'),
    '#default_value' => theme_get_setting('mothership_classes_block_id_as_class')
  );

  $form['classes']['block']['mothership_classes_block_contexual_only'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('zap everything only keep the .contextual-links-region'),
    '#default_value' => theme_get_setting('mothership_classes_block_contexual_only')
  );

  $form['classes']['block']['mothership_classes_block_contentdiv'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove the &lt;div class=&quot;content&quot;&gt; from the block.tpl.php - Keeps it in a custom text block (block-block)'),
    '#default_value' => theme_get_setting('mothership_classes_block_contentdiv')
  );

  //NODE
  $form['classes']['node'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('node classes (node.tpl.php)'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#description'   => t('Modify the div wrapper & style &lt;div id="#node-id" class="node  node-[status] "&gt; ')    
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

  //Views
  $form['classes']['view'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('view classes (views-view.tpl.php)'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  $form['classes']['view']['mothership_classes_view'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove .view'),
    '#default_value' => theme_get_setting('mothership_classes_view')
  );
  $form['classes']['view']['mothership_classes_view_name'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove .$viewname'),
    '#default_value' => theme_get_setting('mothership_classes_view_name')
  );
  $form['classes']['view']['mothership_classes_view_view_id'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove .view-id-$viewname & .view-display-id-$viewname'),
    '#default_value' => theme_get_setting('mothership_classes_view_view_id')
  );
  
  
  $form['classes']['view']['mothership_classes_view_row'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove .view-row'),
    '#default_value' => theme_get_setting('mothership_classes_view_row')
  );
  $form['classes']['view']['mothership_classes_view_row_count'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove .view-row-$count'),
    '#default_value' => theme_get_setting('mothership_classes_view_row_count')
  );
  $form['classes']['view']['mothership_classes_view_row_first_last'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove .view-row-first & .view-row-last'),
    '#default_value' => theme_get_setting('mothership_classes_view_row_first_last')
  );
  $form['classes']['view']['mothership_classes_view_row_rename'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Rename .view-row-$count,  .view-row-first & .view-row-last to : count-$count, .first & .last'),
    '#default_value' => theme_get_setting('mothership_classes_view_row_rename')
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
    '#title'         => t('Remove the input field type class: .form-radio, form-checkbox '),
    '#default_value' => theme_get_setting('mothership_classes_field_type')
  );
  
  $form['classes']['field']['mothership_classes_field_label'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove the label status class '),
    '#default_value' => theme_get_setting('mothership_classes_field_label')
  );

 //Form    
  $form['classes']['form'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Forms'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
    
  $form['classes']['form']['mothership_classes_form_wrapper_formitem'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove the .form-item wrapper class '),
    '#default_value' => theme_get_setting('mothership_classes_form_wrapper_formitem')
  );

  $form['classes']['form']['mothership_classes_form_wrapper_formtype'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove the .form-type-[type] wrapper class'),
    '#default_value' => theme_get_setting('mothership_classes_form_wrapper_formtype')
  );

  $form['classes']['form']['mothership_classes_form_wrapper_formname'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove the .form-type-[name]-x wrapper class'),
    '#default_value' => theme_get_setting('mothership_classes_form_wrapper_formname')
  );

  $form['classes']['form']['mothership_classes_form_label'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove the class .option from label use .form-type-checkbox label{} instead'),
    '#default_value' => theme_get_setting('mothership_classes_form_label')
  );

  $form['classes']['form']['mothership_classes_form_input'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('input fields Remove the class from it class="form-[type] use input[type="radio"] instead for the css" '),
    '#default_value' => theme_get_setting('mothership_classes_form_input')
  );

  $form['classes']['form']['mothership_classes_form_description'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('change the &lt;div class=&quot;description&quot;&gt; to a smaller &lt;small&gt; '),
    '#default_value' => theme_get_setting('mothership_classes_form_description')
  );

  $form['classes']['form']['mothership_form_required'] = array(
    '#type'          => 'checkbox',
    '#title'         => t(' Field required. remove the * and add a class field-required to the label instead'),
    '#default_value' => theme_get_setting('mothership_form_required')
  );

  $form['classes']['form']['mothership_form_labelwrap'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Wrap checkboxes & radios into the label tag &lt;label&gt;foo &lt;item&gt;&lt;/label&gt;'),
    '#default_value' => theme_get_setting('mothership_form_labelwrap')
  );

  




  $form['Libraries'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('External Libraries'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#description'   => t('These are libraries you need to download, because of the different licenses. Add them to sites/all/libraries/'),
  );

  //libaries stuff
  $form['Libraries']['mothership_modernizr'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Add modernizr love'),
    '#default_value' => theme_get_setting('mothership_modernizr'),
    '#description'   => t('<a href="!link">Download modernizr</a>', array('!link' => 'http://modernizr.com')),
  );

  $form['Libraries']['mothership_selectivizr'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Add selectivizr love'),
    '#default_value' => theme_get_setting('mothership_selectivizr'),
    '#description'   => t('<a href="!link">Download selectivizr</a>', array('!link' => 'http://selectivizr.com')),
  );

  $form['mothership_frontpage_default_message'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Remove the frontpage "No front page content has been created yet.Add new content" default message'),
    '#default_value' => theme_get_setting('mothership_frontpage_default_message'),
    '#description'   => t(''),
  );


}

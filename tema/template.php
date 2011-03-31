<?php
/**
 * Implements hook_css_alter().
 */


function tema_preprocess_html(&$vars, $hook) {
  //get some fancy fonts 
  drupal_add_css('http://fonts.googleapis.com/css?family=Covered+By+Your+Grace', array('group' => CSS_THEME, 'every_page' => TRUE));
  drupal_add_css('http://fonts.googleapis.com/css?family=Cabin+Sketch:bold', array('group' => CSS_THEME, 'every_page' => TRUE));
  drupal_add_css('http://fonts.googleapis.com/css?family=Chewy', array('group' => CSS_THEME, 'every_page' => TRUE));
  
  //Test to see if we have the modules we needs,
  if(!module_exists('blockify')){
   // drupal_set_message('Tema use the blockify module - so you can move the logo, title, taps where you wants to & makes the page.tpl easier to work with: <a href="http://drupal.org/project/blockify">Download</a>', 'error');
    print_r('Tema use the blockify module - so you can move the logo, title, taps where you wants to & makes the page.tpl easier to work with: <a href="http://drupal.org/project/blockify">Download</a>');
  }else{
    //needs to add messages to the page cause we aint 
  }
  
  
}

function tema_preprocess_page(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');

  // To remove a class from $classes_array, use array_diff().
  //$vars['classes_array'] = array_diff($vars['classes_array'], array('class-to-remove'));
}

function tema_preprocess_node(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}


function tema_preprocess_comment(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}


function tema_preprocess_block(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}

<?php 


function mothership_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') {
    // HTML5 placeholder attribute
    $form['search_block_form']['#attributes']['placeholder'] = t('Search');
//    $form['search_block_form']['#type'] = "search";
  }
}


/**
  * hook_file
  * @param $variables
  * set the size for a file upload to 20 instead of the default 60
*/
function mothership_file($variables) {
  $element = $variables['element'];
//  $element['#size'] = '30';  
  $element['#attributes']['type'] = 'file';
//  element_set_attributes($element, array('id', 'name', 'size'));
  element_set_attributes($element, array('id', 'name'));
  _form_set_class($element, array('form-file'));

  return '<input' . drupal_attributes($element['#attributes']) . ' />';
}


function mothership_password($variables) {
  $element = $variables['element'];
  $element['#size'] = '30';  
  $element['#attributes']['type'] = 'password';
  element_set_attributes($element, array('id', 'name', 'size', 'maxlength'));
//  element_set_attributes($element, array('id', 'name',  'maxlength'));
  _form_set_class($element, array('form-text'));

  return '<input' . drupal_attributes($element['#attributes']) . ' />';
}




function mothership_textfield($variables) {
  $element = $variables['element'];
  $element['#size'] = '30';  
  
  $element['#attributes']['type'] = 'text';
  element_set_attributes($element, array('id', 'name', 'value', 'size', 'maxlength'));
//  element_set_attributes($element, array('id', 'name', 'value', '', 'maxlength'));  
  _form_set_class($element, array('form-text'));

  $extra = '';
  if ($element['#autocomplete_path'] && drupal_valid_path($element['#autocomplete_path'])) {
    drupal_add_library('system', 'drupal.autocomplete');
    $element['#attributes']['class'][] = 'form-autocomplete';

    $attributes = array();
    $attributes['type'] = 'hidden';
    $attributes['id'] = $element['#attributes']['id'] . '-autocomplete';
    $attributes['value'] = url($element['#autocomplete_path'], array('absolute' => TRUE));
    $attributes['disabled'] = 'disabled';
    $attributes['class'][] = 'autocomplete';
    $extra = '<input' . drupal_attributes($attributes) . ' />';
  }

  $output = '<input' . drupal_attributes($element['#attributes']) . ' />';

  return $output . $extra;
}


function mothership_text_format_wrapper($variables) {
  $element = $variables['element'];
  $output = '<div class="text-format-wrapper">';
  $output .= $element['#children'];
  if (!empty($element['#description'])) {
    $output .= '<div class="description">' . $element['#description'] . '</div>';
  }
  $output .= "</div>\n";

  return $output;
}
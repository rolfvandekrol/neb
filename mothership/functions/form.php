<?php

/*
changes to the form elements
original can be found in /includes/form.inc
*/

/* removes the <div> wrapper inside the form */
function mothership_form($variables) {
  $element = $variables['element'];
  if (isset($element['#action'])) {
    $element['#attributes']['action'] = drupal_strip_dangerous_protocols($element['#action']);
  }
  element_set_attributes($element, array('method', 'id'));
  if (empty($element['#attributes']['accept-charset'])) {
    $element['#attributes']['accept-charset'] = "UTF-8";
  }

  return '<form' . drupal_attributes($element['#attributes']) . '>' . $element['#children'] . '</form>';
}

/*
changes the classes from the div wrapper around each field
change the div class="description" to <small>
*/
function mothership_form_element($variables) {
  $element = &$variables['element'];
  // This is also used in the installer, pre-database setup.
  $t = get_t();

  // This function is invoked as theme wrapper, but the rendered form element
  // may not necessarily have been processed by form_builder().
  $element += array(
    '#title_display' => 'before',
  );

  // Add element #id for #type 'item'.
  if (isset($element['#markup']) && !empty($element['#id'])) {
    $attributes['id'] = $element['#id'];
  }
  // Add element's #type and #name as class to aid with JS/CSS selectors.

  $attributes['class'] = array();
  if(! theme_get_setting('mothership_classes_form_wrapper_formitem')){
    $attributes['class'] = array('form-item');
  }
  //date selects need the form-item for the show/hide end date
  if ($element['#type'] == 'date_select' AND theme_get_setting('mothership_classes_form_wrapper_formitem') ){
    $attributes['class'] = array('form-item');
  }

  if (!empty($element['#type'])) {
    if(!theme_get_setting('mothership_classes_form_wrapper_formtype')){
      $attributes['class'][] = 'form-type-' . strtr($element['#type'], '_', '-');
    }
  }
  if (!empty($element['#name'])) {
    if(!theme_get_setting('mothership_classes_form_wrapper_formname')){
      $attributes['class'][] = 'form-item-' . strtr($element['#name'], array(' ' => '-', '_' => '-', '[' => '-', ']' => ''));
    }
  }
  // Add a class for disabled elements to facilitate cross-browser styling.
  if (!empty($element['#attributes']['disabled'])) {
    $attributes['class'][] = 'form-disabled';
  }

  //freeform css class killing \m/
  if($attributes['class']){
    $remove_class_form = explode(", ", theme_get_setting('mothership_classes_form_freeform'));
    $attributes['class'] = array_values(array_diff($attributes['class'],$remove_class_form));
  }

  if($attributes['class']){
    $output =  '<div' . drupal_attributes($attributes) . '>' . "\n";
  }else{
    $output =  "\n" . '<div>' . "\n";
  }


  // If #title is not set, we don't display any label or required marker.
  if (!isset($element['#title'])) {
    $element['#title_display'] = 'none';
  }
  $prefix = isset($element['#field_prefix']) ? '<span class="field-prefix">' . $element['#field_prefix'] . '</span> ' : '';
  $suffix = isset($element['#field_suffix']) ? ' <span class="field-suffix">' . $element['#field_suffix'] . '</span>' : '';

  switch ($element['#title_display']) {
    case 'before':
    case 'invisible':
      $output .= ' ' . theme('form_element_label', $variables);
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
      break;

    case 'after':
      $output .= ' ' . $prefix . $element['#children'] . $suffix;
      $output .= ' ' . theme('form_element_label', $variables) . "\n";
      break;

    case 'none':
    case 'attribute':
      // Output no label and no required marker, only the children.
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
      break;
  }

  if (!empty($element['#description'])) {

    /*
    changes the description <div class="description"> to <small>
    */
    if(!theme_get_setting('mothership_classes_form_description')){
      $output .= "\n" . '<div class="description">' . $element['#description'] . "</div>\n";
    }else{
      $output .= "\n" . '<small>' . $element['#description'] . "</small>\n";
    }


  }

  $output .= "</div>\n";

  return $output;
}


/*
Remove the class="option" from the label
remove the * from a required element and add it in  class instead
if required its added as a class to the label dont add a * to the markup we can take care of business in the css
Removed the for="#id"  for  html5 if its an item,  radios, checkboxes or managed file cause they arent needed there
*/
function mothership_form_element_label($variables) {
  $element = $variables['element'];

  // This is also used in the installer, pre-database setup.
  $t = get_t();

  // If title and required marker are both empty, output no label.
  if (empty($element['#title']) && empty($element['#required'])) {
    return '';
  }

  $attributes = array();

  // If the element is required, a required marker is appended to the label.
  // We dont cause we belive in the power of css and less crap in the markup so we add it in a class instead.
  if(!theme_get_setting('mothership_form_required')){
    $required = !empty($element['#required']) ? theme('form_required_marker', array('element' => $element)) : '';
  }else{
    if(!empty($element['#required'])){
//       $attributes['class'] = 'form-field-required';
       $attributes['class'] = 'required';
    }
  }

  $title = filter_xss_admin($element['#title']);

  // Style the label as class option to display inline with the element.
  if ($element['#title_display'] == 'after') {
    if(!theme_get_setting('mothership_classes_form_label')){
      $attributes['class'] = 'option';
    }
  }
  // Show label only to screen readers to avoid disruption in visual flows.
  elseif ($element['#title_display'] == 'invisible') {
    $attributes['class'] = 'element-invisible';
  }

  //FOR attribute
  // in html5 we need an element for the for id items & check TODO: clean this up
  if (!empty($element['#id'])){
    // not every element in drupal comes with an #id that we can use for the for="#id"
    // AND
    if(
      //if its html5 & is not an item, checkboxradios or manged file
      theme_get_setting('mothership_html5') AND
      $element['#type'] != "item" &&
      $element['#type'] != "checkboxes" &&
      $element['#type'] != "radios" &&
      $element['#type'] != "managed_file")
    {
        $attributes['for'] = $element['#id'];
    }else{
      $attributes['for'] = $element['#id'];
    }
  }

  // The leading whitespace helps visually separate fields from inline labels.
  if($attributes){
    if(!theme_get_setting('mothership_form_required')){
      return ' <label' . drupal_attributes($attributes) . '>' . $t('!title !required', array('!title' => $title, '!required' => $required)) . "</label>\n";
    }else{
      return ' <label' . drupal_attributes($attributes) . '>' . $t('!title', array('!title' => $title )) . "</label>\n";
    }
  }else{
    if(!theme_get_setting('mothership_form_required')){
      return ' <label>' . $t('!title !required', array('!title' => $title, '!required' => $required)) . "</label>\n";
    }else{
      return ' <label>' . $t('!title', array('!title' => $title )) . "</label>\n";
    }
  }

}

function mothership_checkbox($variables) {
  $element = $variables['element'];
  $t = get_t();
  $element['#attributes']['type'] = 'checkbox';
  element_set_attributes($element, array('id', 'name', '#return_value' => 'value'));

  // Unchecked checkbox has #value of integer 0.
  if (!empty($element['#checked'])) {
    $element['#attributes']['checked'] = 'checked';
  }
  if(!theme_get_setting('mothership_classes_form_input')){
    _form_set_class($element, array('form-checkbox'));
  }
  return '<input' . drupal_attributes($element['#attributes']) . ' />';
}

/*
* remove form-text class
* remove text type if its html5
* add placeholder in html5
*/
function mothership_textfield($variables) {
  $element = $variables['element'];
  $element['#size'] = '30';

  //is this element requred then lest add the required element into the input
  if(theme_get_setting('mothership_html5')){
    $required = !empty($element['#required']) ? ' required' : '';
  }else{
    $required ="";
  }

  //dont need to set type in html5 its default so lets remove it because we can
  //  $element['#attributes']['type'] = 'text';

  //html5 plceholder love
  //if (!empty($element['#description']) ) {
  //  $element['#attributes']['placeholder'] = $element['#description'];
  //}

  element_set_attributes($element, array('id', 'name', 'value', 'size', 'maxlength'));

  //remove the form-text class
  if(!theme_get_setting('mothership_classes_form_input')){
    _form_set_class($element, array('form-text'));
  }
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
    $extra = '<input' . drupal_attributes($attributes) . $required .' />';
  }

  $output = '<input' . drupal_attributes($element['#attributes']) . $required . ' />';

  return $output . $extra;
}

/*remove the form-radio class*/
function mothership_radio($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'radio';
  element_set_attributes($element, array('id', 'name', '#return_value' => 'value'));



  if (isset($element['#return_value']) && $element['#value'] !== FALSE && $element['#value'] == $element['#return_value']) {
    $element['#attributes']['checked'] = 'checked';
  }

  if(!theme_get_setting('mothership_classes_form_input')){
  _form_set_class($element, array('form-radio'));
  }
  return '<input' . drupal_attributes($element['#attributes']) . ' />';
}

function mothership_file($variables) {
  $element = $variables['element'];
//  $element['#size'] = '30';
  $element['#attributes']['type'] = 'file';
//  element_set_attributes($element, array('id', 'name', 'size'));
  element_set_attributes($element, array('id', 'name'));
  if(!theme_get_setting('mothership_classes_form_input')){
    _form_set_class($element, array('form-file'));
  }
  return '<input' . drupal_attributes($element['#attributes']) . ' />';
}

function mothership_password($variables) {
  $element = $variables['element'];
  $element['#size'] = '30';
  $element['#attributes']['type'] = 'password';
  element_set_attributes($element, array('id', 'name', 'size', 'maxlength'));
//  element_set_attributes($element, array('id', 'name',  'maxlength'));
  if(!theme_get_setting('mothership_classes_form_input')){
    _form_set_class($element, array('form-text'));
  }

  return '<input' . drupal_attributes($element['#attributes']) . ' />';
}

/*removed form-select*/
function mothership_select($variables) {
  $element = $variables['element'];
  element_set_attributes($element, array('id', 'name', 'size'));

  if(!theme_get_setting('mothership_classes_form_input')){
    _form_set_class($element, array('form-select'));
  }

  return '<select' . drupal_attributes($element['#attributes']) . '>' . form_select_options($element) . '</select>';
}

/*remove form-textarea*/
function mothership_textarea($variables) {
  $element = $variables['element'];
  element_set_attributes($element, array('id', 'name', 'cols', 'rows'));
  if(!theme_get_setting('mothership_classes_form_input')){
    _form_set_class($element, array('form-textarea'));
  }
  $wrapper_attributes = array(
    'class' => array('form-textarea-wrapper'),
  );

  // Add resizable behavior.
  if (!empty($element['#resizable'])) {
    drupal_add_library('system', 'drupal.textarea');
    $wrapper_attributes['class'][] = 'resizable';
  }

  $output = '<div' . drupal_attributes($wrapper_attributes) . '>';
  $output .= '<textarea' . drupal_attributes($element['#attributes']) . '>' . check_plain($element['#value']) . '</textarea>';
  $output .= '</div>';
  return $output;
}

/*
theme_textfield()
http://api.drupal.org/api/drupal/includes--form.inc/function/theme_textfield
set the size to 30 instead of 60
remove form-text class
*/
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


function mothership_button($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'submit';
  element_set_attributes($element, array('id', 'name', 'value'));

  if(!theme_get_setting('mothership_classes_form_input')){
    $element['#attributes']['class'][] = 'form-' . $element['#button_type'];
    if (!empty($element['#attributes']['disabled'])) {
      $element['#attributes']['class'][] = 'form-button-disabled';
    }
  }

  return '<input' . drupal_attributes($element['#attributes']) . ' />';
}

/*
remove form-wrapper
*/
function mothership_fieldset($variables) {
  $element = $variables['element'];
  element_set_attributes($element, array('id'));

  if(!theme_get_setting('mothership_classes_form_input')){
    _form_set_class($element, array('form-wrapper'));
  }

  $output = '<fieldset' . drupal_attributes($element['#attributes']) . '>';
  if (!empty($element['#title'])) {
    // Always wrap fieldset legends in a SPAN for CSS positioning.
    $output .= '<legend><span class="fieldset-legend">' . $element['#title'] . '</span></legend>';
  }
  $output .= '<div class="fieldset-wrapper">';
  if (!empty($element['#description'])) {
    $output .= '<div class="fieldset-description">' . $element['#description'] . '</div>';
  }
  $output .= $element['#children'];
  if (isset($element['#value'])) {
    $output .= $element['#value'];
  }
  $output .= '</div>';
  $output .= "</fieldset>\n";
  return $output;
}

function mothership_container($variables) {
  $element = $variables['element'];

  // Special handling for form elements.
  if (isset($element['#array_parents'])) {
    // Assign an html ID.
    if (!isset($element['#attributes']['id'])) {
      $element['#attributes']['id'] = $element['#id'];
    }
    // Add the 'form-wrapper' class.
//    $element['#attributes']['class'][] = 'form-wrapper';
  }

  return '<div' . drupal_attributes($element['#attributes']) . '>' . $element['#children'] . '</div>';
}

/*

*/
function mothership_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') {
    $form['search_block_form']['#attributes']['placeholder'] = t('Search');
  }
}

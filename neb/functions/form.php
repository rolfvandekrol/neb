<?php
/*
changes to the form elements
original can be found in /includes/form.inc
*/

/* removes the <div> wrapper inside the form */
function neb_form($variables) {

  $element = $variables['element'];
  if (isset($element['#action'])) {
    $element['#attributes']['action'] = drupal_strip_dangerous_protocols($element['#action']);
  }
  element_set_attributes($element, array('method', 'id'));
  if (empty($element['#attributes']['accept-charset'])) {
    $element['#attributes']['accept-charset'] = "UTF-8";
  }

	return '<form' . drupal_attributes($element['#attributes']) . ' role="form">' . $element['#children'] . '</form>';

}

/*

changes the classes from the div wrapper around each field
change the div class="description" to <small>
adds form-required
*/
function neb_form_element($variables) {

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

  //date selects need the form-item for the show/hide end date
	if(isset($element['#type'])){
	  if ($element['#type'] == 'date_select' OR $element['#type'] == 'date_text' OR $element['#type'] == 'date_popup' ){ //AND
	    $attributes['class'] = array('form-item');
	  }

	}

  // Add a class for disabled elements to facilitate cross-browser styling.
  if (!empty($element['#attributes']['disabled'])) {
    $attributes['class'][] = 'form-disabled';
  }

//if the form element is reguired add a form-required class
if( isset($element['#required']) ) {
  $attributes['class'][] = 'form-required';
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
    $output .= "\n" . '<small>' . $element['#description'] . "</small>\n";
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
function neb_form_element_label($variables) {
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
  if(!empty($element['#required'])){
    $attributes['class'] = 'required';
  }

  $title = filter_xss_admin($element['#title']);

  // Show label only to screen readers to avoid disruption in visual flows.
  elseif ($element['#title_display'] == 'invisible') {
    $attributes['class'] = 'element-invisible';
  }

  //FOR attribute
  // in html5 we need an element for the for id items & check TODO: clean this up
  if (!empty($element['#id'])){
    $attributes['for'] = $element['#id'];
  }

  // The leading whitespace helps visually separate fields from inline labels.
  if($attributes){
    return ' <label' . drupal_attributes($attributes) . '>' . $t('!title', array('!title' => $title )) . "</label>\n";
  }else{
    return ' <label>' . $t('!title', array('!title' => $title )) . "</label>\n";
  }
}

/*
* remove form-text class
* remove text type if its html5
* add placeholder in html5
*/
function neb_textfield($variables) {
  $element = $variables['element'];
  $element['#size'] = '30';

  //is this element requred then lest add the required element into the input
   $required = !empty($element['#required']) ? ' required' : '';

  element_set_attributes($element, array('id', 'name', 'value', 'size', 'maxlength'));

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

/* Link module  link fields removes the clearfix */
function neb_link_field($vars) {
  drupal_add_css(drupal_get_path('module', 'link') .'/link.css');

  $element = $vars['element'];
  // Prefix single value link fields with the name of the field.
  if (empty($element['#field']['multiple'])) {
    if (isset($element['url']) && !isset($element['title'])) {
      unset($element['url']['#title']);
    }
  }

  $output = '';
  if (!empty($element['attributes']['target'])) {
    $output .= '<div class="link-attributes">'. drupal_render($element['attributes']['target']) .'</div>';
  }
  if (!empty($element['attributes']['title'])) {
    $output .= '<div class="link-attributes">'. drupal_render($element['attributes']['title']) .'</div>';
  }
  return $output;
}


/*
module: elements
file: elements.theme.inc
*/
function neb_emailfield($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'email';
  element_set_attributes($element, array('id', 'name', 'value', 'size', 'maxlength', 'placeholder'));
  _form_set_class($element, array('form-text', 'form-email'));

  //is this element requred then lest add the required element into the input
  $required = !empty($element['#required']) ? ' required' : '';

  $extra = elements_add_autocomplete($element);
  $output = '<input' . drupal_attributes($element['#attributes']) . $required . ' />';

  return $output . $extra;
}

function neb_urlfield($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'url';
  element_set_attributes($element, array('id', 'name', 'value', 'size', 'maxlength', 'placeholder'));
  _form_set_class($element, array('form-text', 'form-url'));

  //is this element requred then lest add the required element into the input
  $required = !empty($element['#required']) ? ' required' : '';

  $extra = elements_add_autocomplete($element);
  $output = '<input' . drupal_attributes($element['#attributes']) . $required . ' />';

  return $output . $extra;
}



/*remove form-textarea*/
function neb_textarea($variables) {
  $element = $variables['element'];
  element_set_attributes($element, array('id', 'name', 'cols', 'rows'));

  $wrapper_attributes = array(
    'class' => array('form-textarea-wrapper'),
  );

  // Add resizable behavior.
  if (!empty($element['#resizable'])) {
    drupal_add_library('system', 'drupal.textarea');
    $wrapper_attributes['class'][] = 'resizable';
  }

	//is this element requred then lest add the required element into the input
   $required = !empty($element['#required']) ? ' required' : '';


  $output = '<div' . drupal_attributes($wrapper_attributes) . '>';
  $output .= '<textarea' . drupal_attributes($element['#attributes']) . $required .'>' . check_plain($element['#value']) . '</textarea>';
  $output .= '</div>';
  return $output;
}


function neb_checkbox($variables) {
  $element = $variables['element'];
  $t = get_t();
  $element['#attributes']['type'] = 'checkbox';
  element_set_attributes($element, array('id', 'name', '#return_value' => 'value'));

  // Unchecked checkbox has #value of integer 0.
  if (!empty($element['#checked'])) {
    $element['#attributes']['checked'] = 'checked';
  }
  return '<input' . drupal_attributes($element['#attributes']) . ' />';
}

/* remove the form-radio class */
function neb_radio($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'radio';
  element_set_attributes($element, array('id', 'name', '#return_value' => 'value'));

  if (isset($element['#return_value']) && $element['#value'] !== FALSE && $element['#value'] == $element['#return_value']) {
    $element['#attributes']['checked'] = 'checked';
  }

  return '<input' . drupal_attributes($element['#attributes']) . ' />';
}

function neb_file($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'file';
  element_set_attributes($element, array('id', 'name'));

  return '<input' . drupal_attributes($element['#attributes']) . ' />';
}


function neb_password($variables) {
  $element = $variables['element'];
  $element['#size'] = '30';
  $element['#attributes']['type'] = 'password';

  element_set_attributes($element, array('id', 'name', 'size', 'maxlength'));

  if($variables['element']['#id'] == "edit-pass-pass1"){
     return '<input' . drupal_attributes($element['#attributes']) . ' /><small>'. t('Enter a password').'</small>' ;
  }elseif($variables['element']['#id'] == "edit-pass-pass2"){
     return '<input' . drupal_attributes($element['#attributes']) . ' /><small>'. t('Repeat the password').'</small>' ;
  }else{
    return '<input' . drupal_attributes($element['#attributes']) . ' />' ;
  }

}

/* removed form-select */
function neb_select($variables) {
  $element = $variables['element'];
  element_set_attributes($element, array('id', 'name', 'size'));

  return '<select' . drupal_attributes($element['#attributes']) . '>' . form_select_options($element) . '</select>';
}


function neb_text_format_wrapper($variables) {
  $element = $variables['element'];
  $output = '<div class="text-format-wrapper">';
  $output .= $element['#children'];
  if (!empty($element['#description'])) {
    $output .= '<div class="description">' . $element['#description'] . '</div>';
  }
  $output .= "</div>\n";

  return $output;
}


function neb_button($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'submit';
  element_set_attributes($element, array('id', 'name', 'value'));

  return '<input' . drupal_attributes($element['#attributes']) . ' />';
}

/*
remove form-wrapper
*/
function neb_fieldset($variables) {
  $element = $variables['element'];
  element_set_attributes($element, array('id'));

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

function neb_container($variables) {
  $element = $variables['element'];

  // Special handling for form elements.
  if (isset($element['#array_parents'])) {
    // Assign an html ID.
    if (!isset($element['#attributes']['id'])) {
      $element['#attributes']['id'] = $element['#id'];
    }
  }

  return '<div' . drupal_attributes($element['#attributes']) . '>' . $element['#children'] . '</div>';
}

function neb_field_multiple_value_form($variables) {
  $element = $variables['element'];
	$output = '';

  if ($element['#cardinality'] > 1 || $element['#cardinality'] == FIELD_CARDINALITY_UNLIMITED) {
    $table_id = drupal_html_id($element['#field_name'] . '_values');
    $order_class = $element['#field_name'] . '-delta-order';
    $required = !empty($element['#required']) ? theme('form_required_marker', $variables) : '';

    $header = array(
      array(
        'data' => '<label>' . t('!title: !required', array('!title' => $element['#title'], '!required' => $required)) . "</label>",
        'colspan' => 2,
        'class' => array('field-label'),
      ),
      t('Order'),
    );
    $rows = array();

    // Sort items according to '_weight' (needed when the form comes back after
    // preview or failed validation)
    $items = array();
    foreach (element_children($element) as $key) {
      if ($key === 'add_more') {
        $add_more_button = &$element[$key];
      }
      else {
        $items[] = &$element[$key];
      }
    }
    usort($items, '_field_sort_items_value_helper');

    // Add the items as table rows.
    foreach ($items as $key => $item) {
      $item['_weight']['#attributes']['class'] = array($order_class);
      $delta_element = drupal_render($item['_weight']);
      $cells = array(
        array('data' => '', 'class' => array('field-multiple-drag')),
        drupal_render($item),
        array('data' => $delta_element, 'class' => array('delta-order')),
      );
      $rows[] = array(
        'data' => $cells,
        'class' => array('draggable'),
      );
    }
	/*
	adds form-item-multiple
	*/
    $output .= '<div class="form-item form-item-multiple">';
    $output .= theme('table', array('header' => $header, 'rows' => $rows, 'attributes' => array('id' => $table_id, 'class' => array('field-multiple-table'))));
    $output .= $element['#description'] ? '<div class="description">' . $element['#description'] . '</div>' : '';
	/*removes the clearfix*/
   // $output .= '<div class="clearfix">' . drupal_render($add_more_button) . '</div>';
    $output .=  drupal_render($add_more_button);

    $output .= '</div>';

    drupal_add_tabledrag($table_id, 'order', 'sibling', $order_class);
  }
  else {
    foreach (element_children($element) as $key) {
      $output .= drupal_render($element[$key]);
    }
  }

  return $output;
}



/*
more Placeholder sweetness
*/
function neb_form_alter(&$form, &$form_state, $form_id) {
/*
	print "<pre>";
	print_r($form_id);
	print_r($form);
	print "</pre>";
*/

	//seach
  if ($form_id == 'search_block_form') {
    $form['search_block_form']['#attributes']['placeholder'] = t('Search');
    $form['search_block_form']['#attributes']['type'] = 'search';
  }
	//login block
  if ($form_id == 'user_login_block') {
	  $form['name']['#attributes']['placeholder'] = $form['name']['#title'];
	  $form['pass']['#attributes']['placeholder'] = $form['pass']['#title'];
	}

	//login Register
	if($form_id == 'user_register_form'){
		$mail_placeholder = $form['account']['mail']['#title'];
		$form['account']['name']['#attributes']['placeholder'] = $form['account']['name']['#title'];
		$form['account']['mail']['#attributes']['placeholder'] = $mail_placeholder;
	}

	//login
	if($form_id == 'user_login'){
		$form['name']['#attributes']['placeholder'] = $form['name']['#title'];
		$form['pass']['#attributes']['placeholder'] = $form['pass']['#title'];
	}

	//login forgotten password
	if($form_id == 'user_pass'){
		$form['name']['#attributes']['placeholder'] = $form['name']['#title'];
	}
}


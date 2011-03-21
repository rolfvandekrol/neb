<?php 

/*
template_preprocess_views_view
options to remove css classes from the view
*/
function mothership_preprocess_views_view(&$vars){
  if (theme_get_setting('mothership_classes_view')) {  
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('view')));
  }
  if (theme_get_setting('mothership_classes_view_name')) {    
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('view-'.$vars['name'])));
  }
  if (theme_get_setting('mothership_classes_view_view_id')) {  
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('view-id-'.$vars['name'])));
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('view-display-id-'.$vars['display_id'])));
  }
}

/*removes the classes from the list*/
function mothership_preprocess_views_view_list(&$vars){
  //we need to go down to the unformatted preprocess to rip out the individual classes
  mothership_preprocess_views_view_unformatted($vars);
}

/*views list css classes */
function mothership_preprocess_views_view_unformatted(&$vars) {  
//renaming classes
  if(theme_get_setting('mothership_classes_view_row_rename')){
    $row_first = "first";
    $row_last  = "last";
    $row_count = "count-";
  }else{
    $row_first = "views-row-first";
    $row_last  = "views-row-last";
    $row_count = "views-row-";
  }

  $view = $vars['view'];
  $rows = $vars['rows'];


  $vars['classes_array'] = array();
  $vars['classes'] = array();
  // Set up striping values.
  $count = 0;
  $max = count($rows);
  foreach ($rows as $id => $row) {
    $count++;

    if (!theme_get_setting('mothership_classes_view_row')) {      
      $vars['classes'][$id][] = 'views-row';
    }
    if (!theme_get_setting('mothership_classes_view_row_count')) {      
      $vars['classes'][$id][] = $row_count . $count;
      if(theme_get_setting('mothership_classes_view_row_rename')){
        $vars['classes'][$id][] =  '' . ($count % 2 ? 'odd' : 'even');
      }else{
        $vars['classes'][$id][] = $row_count . ($count % 2 ? 'odd' : 'even');        
      }  
    }   
    if (!theme_get_setting('mothership_classes_view_row_first_last')) {           
      if ($count == 1) {
        $vars['classes'][$id][] = $row_first;
      }
      if ($count == $max) {
        $vars['classes'][$id][] = $row_last;
      }
    } 
  
     
    if ($row_class = $view->style_plugin->get_row_class($id)) {
      $vars['classes'][$id][] = $row_class;
    }

    // Flatten the classes to a string for each row for the template file.
    $vars['classes_array'][$id] = implode(' ', $vars['classes'][$id]);
  }

}

/*
function mothership_preprocess_views_view_field(&$vars) {
 // kpr($vars);
 $vars['output'] = $vars['field']->advanced_render($vars['row']);
}
*/

function mothership_preprocess_views_view_fields(&$vars) {
//  kpr($vars);
  
  $view = $vars['view'];

  // Loop through the fields for this view.
  $inline = FALSE;
  $vars['fields'] = array(); // ensure it's at least an empty array.
  foreach ($view->field as $id => $field) {
    // render this even if set to exclude so it can be used elsewhere.
    $field_output = $view->style_plugin->get_field($view->row_index, $id);
    $empty = $field_output !== 0 && empty($field_output);
    if (empty($field->options['exclude']) && (!$empty || (empty($field->options['hide_empty']) && empty($vars['options']['hide_empty'])))) {
      $object = new stdClass();
      $object->handler = &$view->field[$id];

      $object->element_type = $object->handler->element_type(TRUE);
      if ($object->element_type) {
        $class = '';
        if ($object->handler->options['element_default_classes']) {
          $class = 'field-content';
        }

        if ($classes = $object->handler->element_classes()) {
          if ($class) {
            $class .= ' ';
          }
          $class .=  $classes;
        }
        
        if($class){
          $css_class = 'class="' . $class . '"' ;          
        }else{
          $css_class = '';
        }

//        $field_output = '<' . $object->element_type . ' class="' . $class . '">WTF' . $field_output . '</' . $object->element_type . '>';
          $field_output = '<' . $object->element_type . ' ' . $css_class . '">' . $field_output . '</' . $object->element_type . '>';
      }

      // Protect ourself somewhat for backward compatibility. This will prevent
      // old templates from producing invalid HTML when no element type is selected.
      if (empty($object->element_type)) {
        $object->element_type = 'span';
      }

      $object->content = $field_output;
      if (isset($view->field[$id]->field_alias) && isset($vars['row']->{$view->field[$id]->field_alias})) {
        $object->raw = $vars['row']->{$view->field[$id]->field_alias};
      }
      else {
        $object->raw = NULL; // make sure it exists to reduce NOTICE
      }

      if (!empty($vars['options']['separator']) && $inline && $object->inline && $object->content) {
        $object->separator = filter_xss_admin($vars['options']['separator']);
      }

      $object->class = drupal_clean_css_identifier($id);
      $object->inline = !empty($vars['options']['inline'][$id]);
      $inline = $object->inline;
      $object->inline_html = $object->handler->element_wrapper_type(TRUE, TRUE);

      if ($object->inline_html === '') {
        $object->inline_html = $object->inline ? 'span' : 'div';
      }

      // Set up the wrapper HTML.
      $object->wrapper_prefix = '';
      $object->wrapper_suffix = '';

      if ($object->inline_html) {
        $class = '';
        if ($object->handler->options['element_default_classes']) {
          $class = "views-field views-field-" . $object->class;
        }

        if ($classes = $object->handler->element_wrapper_classes()) {
          if ($class) {
            $class .= ' ';
          }
          $class .= $classes;
        }

        $object->wrapper_prefix = '<' . $object->inline_html;

        if ($class) {
          $object->wrapper_prefix .= ' class="' . $class . '"';
        }
        $object->wrapper_prefix .= '>';
        $object->wrapper_suffix = '</' . $object->inline_html . '>';
      }

      // Set up the label for the value and the HTML to make it easier
      // on the template.
      $object->label = check_plain($view->field[$id]->label());
      $object->label_html = '';
      $object->element_label_type = $object->handler->element_label_type(TRUE);
      if ($object->element_label_type && $object->label) {
        $class = '';
        if ($object->handler->options['element_default_classes']) {
          $class = 'views-label-' . $object->class;
        }

        $element_label_class = $object->handler->element_label_classes();
        if ($element_label_class) {
          if ($class) {
            $class .= ' ';
          }

          $class .= $element_label_class;
        }
        //removet the class="" if it dosnt have any $class cause it looks ugly 
        if($class){
          $object->label_html = '<' . $object->element_label_type . ' class="' . $class . '">';          
        }else{
          $object->label_html = '<' . $object->element_label_type . '>';
        }

        $object->label_html .= $object->label;
        if ($object->handler->options['element_label_colon']) {
          $object->label_html .= ': ';
        }
        $object->label_html .= '</' . $object->element_label_type . '>';
      }

      $vars['fields'][$id] = $object;
    }
  }

}

function mothership_preprocess_views_view_table(&$vars){
//  die('mothership_preprocess_views_view_table');
//  kpr($vars['classes_array']);
}



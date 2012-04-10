<?php

function neb_preprocess_views_view(&$vars){
  $vars['classes_array'] = array_values(array_diff($vars['classes_array'],
    array('view', 
          'view-'.$vars['name'], 
          'view-id-'.$vars['name'], 
          'view-display-id-'.$vars['display_id']
    )
  ));
}

function neb_preprocess_views_view_list(&$vars){
  neb_preprocess_views_view_unformatted($vars);
}

function neb_preprocess_views_view_unformatted(&$vars) {
  $view = $vars['view'];
  $rows = $vars['rows'];

  $vars['classes_array'] = array();
  $vars['classes'] = array();
  // Set up striping values.
  $count = 0;
  $max = count($rows);
  foreach ($rows as $id => $row) {
    $count++;

    if ($row_class = $view->style_plugin->get_row_class($id)) {
      $vars['classes'][$id][] = $row_class;
    }

    if ( $vars['classes']  && $vars['classes'][$id] ){
      $vars['classes_array'][$id] = implode(' ', $vars['classes'][$id]);
    } else {
      $vars['classes_array'][$id] = '';
    }
  }
}

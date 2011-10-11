<?php

//TODO remove classes from the <a>

//kill of the <ul class="menu" around the menues
//we already have the menu-block-wrapper that adds a <nav tag
function mothership_menu_tree($variables) {
  if(theme_get_setting('mothership_classes_menu_wrapper')){
    return '<ul>' . $variables['tree'] . '</ul>';
  }else{
    return '<ul class="menu">' . $variables['tree'] . '</ul>';  
  }
}

/*
walk through each menu link and kill the classes we dont want
*/
function mothership_menu_link(array $variables) {
  //clean up the classes
  
//  $remove = array('first','last','leaf','collapsed','expanded','expandable');
  $remove = array();
  if(theme_get_setting('mothership_classes_menu_items_firstlast')){  
    $remove[] .= "first";
    $remove[] .= "last";
  }
  if(theme_get_setting('mothership_classes_menu_leaf')){  
    $remove[] = "leaf";
  }
  if(theme_get_setting('mothership_classes_menu_collapsed')){
    $remove[] .= "collapsed";
    $remove[] .= "expanded";
    $remove[] .= "expandable";
  }

  if(theme_get_setting('mothership_classes_menu_items_active')){  
    $remove[] .= "active-trail"; 
    $remove[] .= "active";
  }
  
  if($remove){
    $variables['element']['#attributes']['class'] = array_diff($variables['element']['#attributes']['class'],$remove);
  }
  
  
  //TODO: Remove thee menu-mlid-[NUMBER]
  

  //if we wanna remove the class for realz so nozing passes
  if(theme_get_setting('mothership_classes_menu_items')){
    unset($variables['element']['#attributes']['class']);
  }
//  dpr($variables['element']['#attributes']);

  $element = $variables['element'];

  if($variables['element']['#attributes'])
  
           
  $sub_menu = '';
  

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}



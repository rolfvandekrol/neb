<?php

function tema_preprocess_html(&$vars, $hook) {
  //Test to see if we have the modules we needs,
  if(!module_exists('blockify')){
   // drupal_set_message('Tema use the blockify module - so you can move the logo, title, taps where you wants to & makes the page.tpl easier to work with: <a href="http://drupal.org/project/blockify">Download</a>', 'error');
    print_r('Tema use the blockify module - so you can move the logo, title, taps where you wants to & makes the page.tpl easier to work with: <a href="http://drupal.org/project/blockify">Download</a>');
  }else{
    //needs to add messages to the page cause we aint
  }
}

/*
add classes to forms
*/
function tema_form_alter(&$form, &$form_state, $form_id) {
//  print $form_id;
  if( $form_id == "user_login"){
    $form['#attributes']['class'] = "tooltip";
  }elseif($form_id == "user_register_form"){
    $form['#attributes']['class'] = "tooltip";
  }elseif($form_id == "user_pass"){
    $form['#attributes']['class'] = "tooltip";
  }elseif($form_id == "user_login_block"){
  //  $form['#attributes']['class'] = "tooltip";    
  }
}






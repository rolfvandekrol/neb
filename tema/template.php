<?php

function tema_preprocess_html(&$vars, $hook) {
  //get some fancy fonts

  //Test to see if we have the modules we needs,
  if(!module_exists('blockify')){
   // drupal_set_message('Tema use the blockify module - so you can move the logo, title, taps where you wants to & makes the page.tpl easier to work with: <a href="http://drupal.org/project/blockify">Download</a>', 'error');
    print_r('Tema use the blockify module - so you can move the logo, title, taps where you wants to & makes the page.tpl easier to work with: <a href="http://drupal.org/project/blockify">Download</a>');
  }else{
    //needs to add messages to the page cause we aint
  }


}

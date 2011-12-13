<?php

/*
Nukes the js
*/
function mothership_js_alter(&$js) {
  //js from core modules
  if (theme_get_setting('mothership_js_nuke_module')){
    foreach ($js as $file => $value) {
      if (strpos($file, 'modules/') !== FALSE) {
        unset($js[$file]);
      }
    }
  }
  //js from contrib
  if (theme_get_setting('mothership_js_nuke_module_contrib')){
    foreach ($js as $file => $value) {
      if (strpos($file, '/modules/') !== FALSE) {
        unset($js[$file]);
      }
    }
  }

  if (theme_get_setting('mothership_js_nuke_misc')){
    foreach ($js as $file => $value) {
      if (strpos($file, 'misc/') !== FALSE) {
        unset($js[$file]);
      }
    }
  }


  //freeform css class killing :)
  $js_kill_list = explode("\n", theme_get_setting('mothership_js_freeform'));

  //grap the css and run through em
  if(theme_get_setting('mothership_js_freeform')){
    foreach ($js as $file => $value) {
      //grap the kill list and do that on each file
      foreach ($js_kill_list as $key => $jsfilemustdie) {
        if (strpos($file, $jsfilemustdie) !== FALSE) {
         unset($js[$file]);
        }
      }
    }
  }


}




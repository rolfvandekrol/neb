<?php
//http://drupalcode.org/viewvc/drupal/contributions/modules/ds/ds.api.php?revision=1.1.2.4&view=markup&pathrev=DRUPAL-7--1
// from around line 122

function ds_mothership_ds() {
  return array(
    'label' => t('Mothership Test Display'),
    'regions' => array(
      // The key of this region name is also the variable used in
      // the template to print the content of that region.
      'header' => t('header'),
      'left' => t('left'), 
      'middle' => t('Middle'), 
      'right' => t('right'), 
      'footer' => t('footer'), 
      'box1' => t('box 1'), 
      'box2' => t('box 2'),
      'box3' => t('box 3')                           
    ),
    // Add this if there is a default css file.
    //'css' => TRUE,
  );
}


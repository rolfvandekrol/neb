<?php
/**
 * include template overwrites
 */
include_once './' . drupal_get_path('theme', 'neb') . '/functions/icons.php';
include_once './' . drupal_get_path('theme', 'neb') . '/functions/form.php';
include_once './' . drupal_get_path('theme', 'neb') . '/functions/table.php';
include_once './' . drupal_get_path('theme', 'neb') . '/functions/views.php';
include_once './' . drupal_get_path('theme', 'neb') . '/functions/menu.php';
include_once './' . drupal_get_path('theme', 'neb') . '/functions/system.php';
include_once './' . drupal_get_path('theme', 'neb') . '/functions/date.php';
include_once './' . drupal_get_path('theme', 'neb') . '/functions/misc.php';
include_once './' . drupal_get_path('theme', 'neb') . '/functions/forum.php';

include_once './' . drupal_get_path('theme', 'neb') . '/functions/blockify.php';
include_once './' . drupal_get_path('theme', 'neb') . '/goodies/login.inc';

/*
  all the preprocess magic
*/
function neb_preprocess(&$vars, $hook) {
  global $theme;
  $path = drupal_get_path('theme', $theme);
  $appletouchicon =  '<link rel="apple-touch-icon" href="' . $path . '/apple-touch-icon.png">' . "\n";
  $appletouchicon .= '<link rel="apple-touch-icon" sizes="72x72" href="' . $path . '/apple-touch-icon-ipad.png">' . "\n";
  $appletouchicon .= '<link rel="apple-touch-icon" sizes="114x114" href="' . $path . '/apple-touch-icon-iphone4.png">';
  $appletouchicon .= '<link rel="apple-touch-icon" sizes="144x144" href="' . $path . '/apple-touch-icon-ipad-retina.png">';

  if ($hook == "html") {
    $vars['appletouchicon'] = $appletouchicon;
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('html', 'toolbar', 'toolbar-drawer')));
  } elseif ($hook == "page") {
    // page--nodetype.tpl.php
    if (isset($vars['node'])) { $vars['theme_hook_suggestions'][] = 'page__' . $vars['node']->type; }
    $headers = drupal_get_http_header();

    if (isset($headers['status']) && $headers['status'] == '404 Not Found') {
      $vars['theme_hook_suggestions'][] = 'page__404'; 
    }

    //remove the "theres no content default yadi yadi" from the frontpage
    unset($vars['page']['content']['system_main']['default_message']);

    // Remove the block template wrapper from the main content block.
    if (!empty($vars['page']['content']['system_main']) && $vars['page']['content']['system_main']['#theme_wrappers'] && is_array($vars['page']['content']['system_main']['#theme_wrappers'])) {
      $vars['page']['content']['system_main']['#theme_wrappers'] = array_diff($vars['page']['content']['system_main']['#theme_wrappers'], array('block'));
    }

    /*-
      USER ACCOUNT
      Removes the tabs from user  login, register & password
      fixes the titles to so no more "user account" all over
    */
    switch (current_path()) {
      case 'user':
        $vars['title'] = t('Login'); unset( $vars['tabs'] );
        break;
      case 'user/register':
        $vars['title'] = t('New account'); unset( $vars['tabs'] );
        break;
      case 'user/password':
        $vars['title'] = t('I forgot my password'); unset( $vars['tabs'] );
        break;

      default:
        break;
    }

  } elseif ($hook == "block") {
    $vars['id_block'] = ' id="' . $vars['block_html_id'] . '"';
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('block', 'contextual-links-region')));

    $vars['title_attributes_array']['class'][] = 'title';
    $vars['content_attributes_array']['class'][] = 'block-content';

    //add a theme suggestion to block--menu.tpl so we dont have create a ton of blocks with <nav>
    if (
      ($vars['elements']['#block']->module == "system" AND $vars['elements']['#block']->delta == "navigation") OR
      ($vars['elements']['#block']->module == "system" AND $vars['elements']['#block']->delta == "main-menu") OR
      ($vars['elements']['#block']->module == "system" AND $vars['elements']['#block']->delta == "user-menu") OR
      ($vars['elements']['#block']->module == "admin" AND $vars['elements']['#block']->delta == "menu") OR
       $vars['elements']['#block']->module == "menu_block"
    ) {
      $vars['theme_hook_suggestions'][] = 'block__menu';
    }

  } elseif ( $hook == "node" ) {
    $vars['theme_hook_suggestions'][] = 'node__' . $vars['type'] . '__' . $vars['view_mode'];

    //one unified node teaser template
    if($vars['view_mode'] == "teaser"){
      $vars['theme_hook_suggestions'][] = 'node__nodeteaser';
    }

    if($vars['view_mode'] == "teaser" AND $vars['promote']){
      $vars['theme_hook_suggestions'][] = 'node__nodeteaser__promote';
    }

    if($vars['view_mode'] == "teaser" AND $vars['sticky']){
      $vars['theme_hook_suggestions'][] = 'node__nodeteaser__sticky';
    }

    if($vars['view_mode'] == "teaser" AND $vars['is_front']){
      $vars['theme_hook_suggestions'][] = 'node__nodeteaser__front';
    }

    $vars['id_node'] ="";

    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('node')));
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('node-sticky'. 'node-unpublished', 'node-promoted')));

    if ($vars['promote']){ $vars['classes_array'][] = 'promote'; }
    if ($vars['sticky']){ $vars['classes_array'][] = 'sticky'; }
    if ($vars['status'] =="0"){ $vars['classes_array'][] = 'unpublished'; }
    if (isset($vars['preview'])) { $vars['classes_array'][] = 'node-preview'; }

    //  remove the class attribute it its empty
    if(isset($vars['content']['links']['#attributes']['class']) && isset($vars['content']['links']['#attributes']['class']) && !$vars['content']['links']['#attributes']['class']){
      unset($vars['content']['links']['#attributes']['class']);
    }
  } elseif ($hook == "comment") {
    if ($vars['elements']['#comment']->new) { $vars['classes_array'][] = 'new'; }

    if ($vars['status'] == "comment-unpublished") { $vars['classes_array'][] = ' unpublished'; }
  } elseif ($hook == "field") {
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('field')));
    $vars['classes_array'] = preg_grep('/^field-name-/', $vars['classes_array'], PREG_GREP_INVERT);
    $vars['classes_array'] = preg_grep('/^field-type-/', $vars['classes_array'], PREG_GREP_INVERT);
    $vars['classes_array'] = preg_grep('/^field-label-/', $vars['classes_array'], PREG_GREP_INVERT);
    $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('clearfix')));
  } elseif ($hook == "maintenance_page") {
    $vars['path'] = $path;
    $vars['appletouchicon'] = $appletouchicon;
    $vars['theme_hook_suggestions'][] = 'static__maintenance';
  }
}

/*
  // Purge needless XHTML stuff.
  nathan ftw! -> http://sonspring.com/journal/html5-in-drupal-7
*/
function neb_process_html_tag(&$vars) {
  $el = &$vars['element'];

  // Remove type="..." and CDATA prefix/suffix.
  unset($el['#attributes']['type'], $el['#value_prefix'], $el['#value_suffix']);

  // Remove media="all" but leave others unaffected.
  if (isset($el['#attributes']['media']) && $el['#attributes']['media'] === 'all') {
    unset($el['#attributes']['media']);
  }
}

function neb_css_alter(&$css) {
  $neb_csscore_path = drupal_get_path('theme', 'neb') . '/css-drupalcore/';
  $neb_cssmodules_path = drupal_get_path('theme', 'neb') . '/css-modules/';

  $css_remove = array();

  if (module_exists('book')) {
    $css = drupal_add_css($neb_csscore_path . 'book.admin.css', array('group' => CSS_SYSTEM));
    $css = drupal_add_css($neb_csscore_path . 'book.theme.css', array('group' => CSS_SYSTEM));
  }

  if (module_exists('contextual')) {
    $css = drupal_add_css($neb_csscore_path . 'contextual.base.css', array('group' => CSS_SYSTEM));
    $css = drupal_add_css($neb_csscore_path . 'contextual.theme.css', array('group' => CSS_SYSTEM));
  }

  if(module_exists('field')){
    $css = drupal_add_css($neb_csscore_path . 'field.theme.css', array('group' => CSS_SYSTEM));
    $css = drupal_add_css($neb_csscore_path . 'field_ui.admin.css', array('group' => CSS_SYSTEM));
  }

  if(module_exists('openid')){
    $css = drupal_add_css($neb_csscore_path . 'openid.base.css', array('group' => CSS_SYSTEM));
    $css = drupal_add_css($neb_csscore_path . 'openid.theme.css', array('group' => CSS_SYSTEM));
  }

  $css_remove['/^.*modules\/.*/'] = array(
    '/^.*\.base\.css$/',
    '/^.*(toolbar|shortcut|devel)\.css$/',
    '/^.*overlay-.*\.css$/',
    /* *.admin.css files and files for admin_menu ? */
  );

  foreach ($css as $file => $value) {
    if (_neb_css_alter_match_array($file, $css_remove)) {
      unset($css[$file]);
    }
  }

}

function _neb_css_alter_match_array($file, $patterns) {
  foreach ($patterns as $key => $value) {
    if (is_numeric($key)) {
      $result = _neb_css_alter_match($file, $value);
    } else {
      $result = _neb_css_alter_match($file, $key, $value);
    }

    if ($result) { 
      return TRUE; 
    }
  }

  return FALSE;
}


function _neb_css_alter_match($file, $pattern, $exceptions = NULL) {
  $match = preg_match($pattern, $file);

  if (!$match || !$exceptions) {
    return (bool) $match;
  }

  return !_neb_css_alter_match_array($file, $exceptions);
}

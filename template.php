<?php

/**
 * @file
 * Template.php - process theme data for your sub-theme.
 * 
 * Rename each function and instance of "footheme" to match
 * your subthemes name, e.g. if you name your theme "footheme" then the function
 * name will be "footheme_preprocess_hook". Tip - you can search/replace
 * on "footheme".
 */

/* 
 * Add javascript files needed for this sub-theme.
 */

drupal_add_js(libraries_get_path('jquery.cookie') . '/jquery.cookie.js', 'file');
drupal_add_js(drupal_get_path('theme', 'bdw2pointoh') . '/js/gmap_remember_zoom.js','file');



/**
 * Override or insert variables for the html template.
 */
/* -- Delete this line if you want to use this function
function bdw2pointoh_preprocess_html(&$vars) {
}
function bdw2pointoh_process_html(&$vars) {
}
// */


/**
 * Override or insert variables for the page templates.
 */
/* -- Delete this line if you want to use these functions
function bdw2pointoh_preprocess_page(&$vars) {
}
function bdw2pointoh_process_page(&$vars) {
}
// */


/**
 * Override or insert variables into the node templates.
 */
/* -- Delete this line if you want to use these functions
function bdw2pointoh_preprocess_node(&$vars) {
}
function bdw2pointoh_process_node(&$vars) {
}
// */


/**
 * Override or insert variables into the comment templates.
 */
/* -- Delete this line if you want to use these functions
function bdw2pointoh_preprocess_comment(&$vars) {
}
function bdw2pointoh_process_comment(&$vars) {
}
// */


/**
 * Override or insert variables into the block templates.
 */
/* -- Delete this line if you want to use these functions
function bdw2pointoh_preprocess_block(&$vars) {
}
function bdw2pointoh_process_block(&$vars) {
}
// */


/**
 * Override logintoboggan theme functions for the login block
 * specifically, remove references to registering
 */
function bdw2pointoh_lt_login_link($variables) {
  return t('Login');
}

/**
 * Implementation of HOOK_theme().
 */
function bdw2pointoh_theme($existing, $type, $theme, $path) {
  // Add your theme hooks like this:
  /*
  $hooks['hook_name_here'] = array( // Details go here );
  */
  $hooks['user_login'] = array(
    'render element' => 'form',
    'path' => drupal_get_path('theme', 'bdw2pointoh') . '/templates',
    'template' => 'user-login',
    'preprocess functions' => array(
      'bdw2pointoh_preprocess_user_login'
    ),
  );

  $hooks['user_pass'] = array(
    'render element' => 'form',
    'path' => drupal_get_path('theme', 'bdw2pointoh') . '/templates',
    'template' => 'user-pass',
    'preprocess functions' => array(
      'bdw2pointoh_preprocess_user_pass'
    ),
  );
  return $hooks;
}

function bdw2pointoh_preprocess_user_login(&$variables) {
   $variables['intro_text'] = t('Login to your BoondockersWelcome account');
}

function bdw2pointoh_preprocess_user_pass(&$variables) {
   $variables['intro_text'] = t('Forgotten your password? No problem. Enter your uesrname or email address below, and we\'ll send a one-time login link to the email addres you have listed in your account. From there you can reset your password to whatever you wish.');
}

/** Override theme_checklist_item from checklist module */
function bdw2pointoh_checklist_item($variables) {
  $link = $variables['link'];
  $item = $variables['item'];
  $list = $variables['list'];
  $account = $variables['account'];
  global $user;
  static $js_added = FALSE;
  $output = '<div class="checklist"><div id="checklistItem' . (!empty($list->instance_id) ? $list->instance_id : $list->clid) . '-' . $item->cliid . '" class="';

  // Only get links and so on if the item is enabled.
  if (($item->status == CHECKLIST_ENABLED) && !empty($list->instance_id)) {
    $item->link = $link;
    $options = (array) _checklist_item_callback_handler('display_options', $list, $item, $account);
  }
  else {
    $options = array();
  }

  $options += array(
    'div_class' => array(),
    'query' => array(),
    'show_admin' => FALSE, // This would show the link to an administrator if TRUE,
  );
  $options['div_class'][] = 'clMain';
  if (!$link || ($item->status != CHECKLIST_ENABLED)) $options['div_class'][] = 'clDisabled';
  $output .= implode(' ', $options['div_class']) . (!empty($item->checked_on) ? ' clChecked' : '') . '"></div>';

  if ((!$link && !$list->completed) || !isset($options['path']) || (($user->uid != $account->uid) && !$options['show_admin'])) {
    $output .= _checklist_clean($item->title);
  }
  else {
    $path = $options['path'];
    unset($options['path']);

    // Try to bring the user back to this page if possible.
    if (empty($options['query'])) {
      $options['query'] = drupal_get_destination();
    }
    $output .= l($item->title, $path, $options);
  }

  if (!empty($item->checked_by) && $item->checked_by != $account->uid) {
    $output .= '<span class="checked-by">' . t('Compled by !name', array('!name' => theme('username', array('account' => user_load($item->checked_by))))) . '</span>';
  }

  if ($item->description) {
    $output .= ' </div><div id="checklistDetail' . (!empty($list->instance_id) ? $list->instance_id : $list->clid) . '-' . $item->cliid . '" class="checklistDetails">' . _checklist_clean($item->description, $item->format);
  }

  return $output . '</div>';
}

/* Override theme_checklist_lists from checklist module */

function bdw2pointoh_checklist_lists($variables) {
  $lists = $variables['lists'];
  $account = $variables['account'];
  drupal_add_css(drupal_get_path('module', 'checklist') . '/resources/checklist.css');

  // Output the general description for checklists.
  if ($output = variable_get('checklist_page_description', '')) {
    $output = '<div id="checklist-page-description"><p>' . _checklist_clean($output['value'], $output['format']) . '</p></div>';
  }
  $output .= '<div class="checklists">';
  $incomplete = FALSE;
  foreach ($lists as $list) {
    if (!$list->completed) $incomplete = TRUE;
    $output .= theme('checklist_list', array('lists' => $list, 'account' => $account));
  }
  if ($incomplete && empty($_SESSION['checklist_required'])) {
    $output .= checklist_continue_link();
  }
  $output .= '</div>';
  return $output;
}



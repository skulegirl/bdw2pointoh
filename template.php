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


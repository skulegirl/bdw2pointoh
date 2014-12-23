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


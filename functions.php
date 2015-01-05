<?php
/**
 * Functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package Smores
 * @since Smores 1.0
 */

$smores_includes = array(
  'lib/classes/smores.php',            // Initial theme setup and constants
  'lib/vendor/jjgrainger/wp-custom-post-type-class/src/CPT.php',            // Initial theme setup and constants
  'lib/init.php',            // Initial theme setup and constants
  'lib/nav.php',             // Custom nav modifications
  'lib/scripts.php',         // Scripts and stylesheets
);

foreach ($smores_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(print('Error locating %s for inclusion'), E_USER_ERROR);
  }
  require_once $filepath;
}
unset($file, $filepath);

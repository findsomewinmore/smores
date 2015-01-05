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
 
//Utility Constants
define('SMORES_THEME_ROOT', get_stylesheet_directory());

//Utility Functions

/**
 * smores_files_in_dir
 *
 * Loops through a directory <$dir> and returns an array of files
 * in that directory
 *
 * @param (string) ($dir) path relative to wp-content
 * @param (array) ($ignores) files to ignore, default: init.php
 * @return (array) an array for files relative to wp-content
 */
function smores_files_in_dir($dir, $ignores = array('init.php')) {
  $smores_include_files = array();
  foreach(glob(SMORES_THEME_ROOT."/${dir}/*.php") as $filename){
    $paths = explode('/', $filename);
    $file = end($paths);
    foreach($ignores as $ignore){
      if($file !== $ignore)
        $smores_include_files[] = "${dir}/${file}";
    }
  }
  return $smores_include_files;
}

/**
 * smores_include_array
 *
 * Loops through a array <$array> and includes the files
 *
 * @param (array) ($array)
 * @return nothing
 */
function smores_include_array($includes_array) {
  foreach ($includes_array as $file) {
    if (!$filepath = locate_template($file)) {
      trigger_error(sprintf('Error locating %s for inclusion', $file), E_USER_ERROR);
    }
    require_once $filepath;
  }
  unset($file, $filepath);
}

//Start includes
$smores_includes = array(
  'lib/classes/smores.php',            // Initial theme setup and constants
  'lib/vendor/jjgrainger/wp-custom-post-type-class/src/CPT.php',            // Custom Post Type Class
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

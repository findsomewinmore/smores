<?php 
/**
 * General Smores class
 *
 * @package Smores
 * @since Smores 1.1
 */
class smores {

 public static $assets = array(
	  'css'       => '/assets/css/styles.min.css',
	  'js'        => '/assets/js/scripts.min.js',
	  'modernizr' => '/assets/js/vendor/modernizr.min.js',
	  'jquery'    => '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.js',
	  'jquery_fallback'   => '/assets/js/vendor/jquery.min.js',
	  'html5shiv' => '/assets/js/vendor/html5shiv.min.js',
	  'respond'   => '/assets/js/vendor/respond.min.js'
	);

  /**
  * Call this method to return the file path of an asset.
  * Ex: smores::get_asset('css');
  * @since Smores 1.1
  * @param string $asset, the key of within the assets array.
  * @return string, the value index $asset
  */
  public static function get_asset($asset){
    return self::$assets[$asset];
  }
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
  public static function files_in_dir($dir, $ignores = array('init.php')) {
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
  public static function include_array($includes_array) {
    foreach ($includes_array as $file) {
      if (!$filepath = locate_template($file)) {
        trigger_error(sprintf('Error locating %s for inclusion', $file), E_USER_ERROR);
      }
      require_once $filepath;
    }
    unset($file, $filepath);
  }
}

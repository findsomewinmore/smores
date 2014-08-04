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
}
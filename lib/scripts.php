<?php
/**
 * Scripts and stylesheets
 */
function fiwi_scripts() {
    $assets = array(
      'css'       => '/assets/css/styles.min.css',
      'js'        => '/assets/js/scripts.min.js',
      'modernizr' => '/assets/js/vendor/modernizr.min.js',
      'jquery'    => '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.js',
      'jquery_fallback'   => 'assets/js/vendor/jquery.min.js',
      'html5shiv' => 'assets/js/vendor/html5shiv.min.js',
      'respond'   => 'assets/js/vendor/respond.min.js'
    );

  //Add Main Stylesheet
  wp_enqueue_style('fiwi_css', get_template_directory_uri() . $assets['css'], false, null);

  /**
   * jQuery is loaded using the same method from HTML5 Boilerplate:
   * Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
   * It's kept in the header instead of footer to avoid conflicts with plugins.
   */
  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', $assets['jquery'], array(), null, true);
    add_filter('script_loader_src', 'fiwi_jquery_local_fallback', 10, 2);
  }

  wp_enqueue_script('modernizr', get_template_directory_uri() . $assets['modernizr'], array(), null, false);
  wp_enqueue_script('jquery');
  wp_enqueue_script('fiwi_js', get_template_directory_uri() . $assets['js'], array('jquery'), null, true);

}
add_action('wp_enqueue_scripts', 'fiwi_scripts', 100);

// http://wordpress.stackexchange.com/a/12450
function fiwi_jquery_local_fallback($src, $handle = null) {
  static $add_jquery_fallback = false;

  if ($add_jquery_fallback) {
    echo '<script>window.jQuery || document.write(\'<script src="'. get_template_directory_uri() . $assets['jquery_fallback'] .'?2.1.1"><\/script>\')</script>' . "\n";
    $add_jquery_fallback = false;
  }

  if ($handle === 'jquery') {
    $add_jquery_fallback = true;
  }

  return $src;
}
add_action('wp_head', 'fiwi_jquery_local_fallback');

//Add IE only scripts and stylesheets.
function fiwi_conditional_scripts () {
    echo '<!--[if lt IE 9]>';
    echo '<script src="'.get_template_directory_uri() . $assets['html5shiv'].'"></script>';
    echo '<script src="'.get_template_directory_uri() . $assets['respond'].'"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'fiwi_conditional_scripts');
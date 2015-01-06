<?php
/**
 * Scripts and stylesheets
 */
function smores_scripts() {

  //Add Main Stylesheet
  wp_enqueue_style('smores_css', get_template_directory_uri() . smores::get_asset('css'), false, null);

  /**
   * jQuery is loaded using the same method from HTML5 Boilerplate:
   * Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
   * It's kept in the header instead of footer to avoid conflicts with plugins.
   */
  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', smores::get_asset('jquery'), array(), null, true);
    add_filter('script_loader_src', 'smores_jquery_local_fallback', 10, 2);
  }

  wp_enqueue_script('modernizr', get_template_directory_uri() . smores::get_asset('modernizr'), array(), null, false);
  wp_enqueue_script('jquery');
  wp_enqueue_script('smores_js', get_template_directory_uri() . smores::get_asset('js'), array('jquery'), null, true);

}
add_action('wp_enqueue_scripts', 'smores_scripts', 100);

// http://wordpress.stackexchange.com/a/12450
function smores_jquery_local_fallback($src, $handle = null) {
  static $add_jquery_fallback = false;

  if ($add_jquery_fallback) {
    echo '<script>window.jQuery || document.write(\'<script src="'. get_template_directory_uri() . smores::get_asset('jquery_fallback') .'?2.1.1"><\/script>\')</script>' . "\n";
    $add_jquery_fallback = false;
  }

  if ($handle === 'jquery') {
    $add_jquery_fallback = true;
  }

  return $src;
}
add_action('wp_head', 'smores_jquery_local_fallback');

//Add IE only scripts and stylesheets.
function smores_conditional_scripts () {
    echo '<!--[if lt IE 9]>';
    echo '<script src="'.get_template_directory_uri() . smores::get_asset('html5shiv').'"></script>';
    echo '<script src="'.get_template_directory_uri() . smores::get_asset('respond').'"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'smores_conditional_scripts');

//Add Scripts
function smores_development_scripts() {
  if($_SERVER['REMOTE_ADDR'] == '::1' || $_SERVER['REMOTE_ADDR'] == 'externalIPHere') { ?>
    <script>
      setTimeout(function(){
        if($('script[src*=livereload]').length > 0) {
          $('html').addClass('development');
        }
      }, 2000);
    </script>
  <?php }
}
add_action('wp_footer', 'smores_development_scripts', 99);

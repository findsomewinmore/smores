<?php
/**
 * General Smores class
 *
 * @package Smores
 * @since Smores 1.1.0
 */

namespace Smores;

class Smores
{
    /**
     * Theme root
     */
    const THEME_ROOT = get_stylesheet_directory();

    /**
     * @since Smores 1.2.0
     * @var array $assets Static assets to be inserted into wp_head()
     */
    protected $assets;

    /**
     * The class constructor
     *
     * @since Smores 1.2.0
     *
     * @param array $assets   Static assets with names
     * @param array $includes Directories with files to be included
     *
     * @return void
     */
    public function __construct($includes = array(), $assets = array())
    {
        $this->assets = $assets;

        foreach ($this->includes as $directory) {
           self::include_array(self::files_in_dir($directory));
        }

        add_action('after_setup_theme', array($this, 'theme_setup'));
        add_action('widgets_init', array($this, 'widgets_init'));

        // Scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), 100);
        add_action('wp_head', array($this, 'jquery_local_fallback'));
        add_action('wp_footer', array($this, 'development_scripts'), 99);
    }

    /**
     * Adds development scripts
     *
     * @since 1.2.0
     *
     * @return void
     */
    protected function development_scripts()
    {
      if ($_SERVER['REMOTE_ADDR'] === '::1' || $_SERVER['REMOTE_ADDR'] === 'externalIPHere') { ?>
        <script>
          setTimeout(function () {
            if ($('script[src*=livereload]').length > 0) {
              $('html').addClass('development');
            }
          }, 2000);
        </script>
      <?php }
    }

    /**
     * Enqueues scripts and stylesheets
     *
     * @since Smores 1.2.0
     *
     * @return void
     */
    protected function enqueue_scripts()
    {
        //Add Main Stylesheet
        wp_enqueue_style('smores_css', get_template_directory_uri() . self::get_asset('css'), false, null);

        // jQuery is loaded using the same method from HTML5 Boilerplate:
        // Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
        // It's kept in the header instead of footer to avoid conflicts with plugins
        if (!is_admin()) {
            wp_deregister_script('jquery');
            wp_register_script('jquery', self::get_asset('jquery'), array(), null, true);
            add_filter('script_loader_src', array($this, 'jquery_local_fallback'), 10, 2);
        }

        wp_enqueue_script('modernizr', get_template_directory_uri() . self::get_asset('modernizr'), array(), null, false);
        wp_enqueue_script('jquery');
        wp_enqueue_script('smores_js', get_template_directory_uri() . self::get_asset('js'), array('jquery'), null, true);
    }

    /**
     * [files_in_dir description]
     *
     * @since 1.0.0
     *
     * @param string $dir     path relative to wp-content
     * @param array  $ignores files to ignore
     *
     * @return array An array for files relative to wp-content
     */
    public static function files_in_dir($dir, $ignores = array('init.php'))
    {
        $smores_include_files = array();

        foreach (glob(self::THEME_ROOT . "/${dir}/*.php") as $filename) {
            $paths = explode('/', $filename);
            $file  = end($paths);

            foreach ($ignores as $ignore) {
                if ($file !== $ignore) {
                    $smores_include_files[] = "{$dir}/{$file}";
                }
            }
        }

        return $smores_include_files;
    }

    /**
    * Call this method to return the file path of an asset.
    * Ex: self::get_asset('css');
    *
    * @since Smores 1.1.0
    *
    * @param string $asset The key of within the assets array.
    *
    * @return string The value index $asset
    */
    public static function get_asset($asset)
    {
        return self::$assets[$asset];
    }

    /**
     * [include_array description]
     *
     * @since 1.1.0
     *
     * @param  array $file_array [description]
     *
     * @return [type] [description]
     */
    public static function include_array($file_array = array())
    {
      foreach ($file_array as $file) {
          if (!$filepath = locate_template($file)) {
              trigger_error("Error locating {$file} for inclusion", E_USER_ERROR);
          }

          require_once $filepath;
      }

      unset($file, $filepath);
    }

    /**
     * Adds a local jQuery fallback
     *
     * @see http://wordpress.stackexchange.com/a/12450
     *
     * @since Smores 1.2.0
     *
     * @param string $src    Script loader source path.
     * @param string $handle Script handle.
     *
     * @return string Script loader source path.
     */
    protected function jquery_local_fallback($src, $handle = null)
    {
        static $add_jquery_fallback = false;

        if ($add_jquery_fallback) {
            echo '<script>window.jQuery || document.write(\'<script src="'. get_template_directory_uri() . self::get_asset('jquery_fallback') .'?2.1.1"><\/script>\')</script>' . "\n";

            $add_jquery_fallback = false;
        }

        if ($handle === 'jquery') {
            $add_jquery_fallback = true;
        }

        return $src;
    }

    /**
     * Initial setup
     *
     * @since Smores 1.2.0
     *
     * @return void
     */
    protected function theme_setup()
    {
        //Add menus
        add_theme_support('menus');

        // Add post thumbnails
        // http://codex.wordpress.org/Post_Thumbnails
        // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
        // http://codex.wordpress.org/Function_Reference/add_image_size
        add_theme_support('post-thumbnails');

        // Add HTML5 markup for captions
        // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
        add_theme_support('html5', array('caption'));

        //Add theme support for the <title> tag
        add_theme_support('title-tag');

        if (get_option('image_default_link_type') !== 'none') {
            update_option('image_default_link_type', 'none' );
        }
    }

    /**
     * Register sidebars
     *
     * @since Smores 1.2.0
     *
     * @return void
     */
    protected function smores_widgets_init() {
        register_sidebar(array(
            'name'          => 'Primary',
            'id'            => 'sidebar-primary',
            'before_widget' => '<section class="widget %1$s %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>',
        ));
    }
}

/*
 * This is a stegosaurus.
 *
 *
 *                                / `.   .' \
 *                        .---.  <    > <    >  .---.
 *                        |    \  \ - ~ ~ - /  /    |
 *                         ~-..-~             ~-..-~
 *                     \~~~\.'                    `./~~~/
 *           .-~~^-.    \__/                        \__/
 *         .'  O    \     /               /       \  \
 *        (_____,    `._.'               |         }  \/~~~/
 *         `----.          /       }     |        /    \__/
 *               `-.      |       /      |       /      `. ,~~|
 *                   ~-.__|      /_ - ~ ^|      /- _      `..-'   f: f:
 *                        |     /        |     /     ~-.     `-. _||_||_
 *                        |_____|        |_____|         ~ - . _ _ _ _ _>
 */

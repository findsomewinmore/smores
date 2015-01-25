<?php
/**
 * Smores initial setup
 */
function smores_setup() {
	
	// Add custom post types
	require_once('post-types/init.php');

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
  
  if(get_option('image_default_link_type') !== 'none') {
    update_option('image_default_link_type', 'none' );
  }
}
add_action('after_setup_theme', 'smores_setup');

/**
 * Register sidebars
 */
function smores_widgets_init() {
  // register_sidebar(array(
  //   'name'          => 'Primary',
  //   'id'            => 'sidebar-primary',
  //   'before_widget' => '<section class="widget %1$s %2$s">',
  //   'after_widget'  => '</section>',
  //   'before_title'  => '<h3>',
  //   'after_title'   => '</h3>',
  // ));
}
add_action('widgets_init', 'smores_widgets_init');

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

<?php
/**
 * FiWi initial setup
 */
function fiwi_setup() {

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
}
add_action('after_setup_theme', 'fiwi_setup');

/**
 * Register sidebars
 */
function fiwi_widgets_init() {
  // register_sidebar(array(
  //   'name'          => 'Primary',
  //   'id'            => 'sidebar-primary',
  //   'before_widget' => '<section class="widget %1$s %2$s">',
  //   'after_widget'  => '</section>',
  //   'before_title'  => '<h3>',
  //   'after_title'   => '</h3>',
  // ));
}
add_action('widgets_init', 'fiwi_widgets_init');
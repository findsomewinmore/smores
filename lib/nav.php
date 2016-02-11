<?php
/**
 * Add Foundation Topbar Walker
 *
 * Foundation Top Bar Usage Example
 * <div class="top-bar-container fixed contain-to-grid">
 *   <nav class="top-bar">
 *       <ul>
 *           <li class="name">
 *               <h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
 *           </li>
 *           <li class="toggle-topbar"><a href="#"></a></li>
 *       </ul>
 *       <section>
 *           <?php foundation_top_bar_l(); ?>
 *
 *           <?php foundation_top_bar_r(); ?>
 *       </section>
 *   </nav>
 * </div>
 */

/*
http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
*/
register_nav_menus(array(
    'top-bar-l' => 'Left Top Bar', // registers the menu in the WordPress admin menu editor
    'top-bar-r' => 'Right Top Bar'
));

/*
http://codex.wordpress.org/Function_Reference/wp_nav_menu
*/

// the right top bar
function foundation_top_bar_r() {
    echo '<section class="top-bar-section">';
    wp_nav_menu(array(
        'container'       => false, // remove nav container
        'container_class' => '', // class of container
        'menu'            => '', // menu name
        'menu_class'      => 'right', // adding custom nav class
        'theme_location'  => 'top-bar-menu', // where it's located in the theme
        'before'          => '', // before each link <a>
        'after'           => '', // after each link </a>
        'link_before'     => '', // before each link text
        'link_after'      => '', // after each link text
        'depth'           => 5, // limit the depth of the nav
        'fallback_cb'     => 'main_nav_top_bar_fb', // fallback function (see below)
        'walker'          => new TopBarWalker()
    ));
    echo '</section>';
} // end right top bar

// the right top bar
function foundation_top_bar_l() {
    echo '<section class="top-bar-section">';
    wp_nav_menu(array(
        'container' => false,                           // remove nav container
        'container_class' => '',                // class of container
        'menu' => '',                               // menu name
        'menu_class' => 'left',            // adding custom nav class
        'theme_location' => 'top-bar-menu',                // where it's located in the theme
        'before' => '',                                 // before each link <a>
        'after' => '',                                  // after each link </a>
        'link_before' => '',                            // before each link text
        'link_after' => '',                             // after each link text
        'depth' => 5,                                   // limit the depth of the nav
          'fallback_cb' => 'main_nav_top_bar_fb',         // fallback function (see below)
        'walker' => new Top_Bar_Walker()
    ));
    echo '</section>';
} // end right top bar



/*
http://codex.wordpress.org/Template_Tags/wp_list_pages
*/
function main_nav_top_bar_fb() {

    echo '<ul class="right">';
    wp_list_pages(array(
        'depth'        => 0,
        'child_of'     => 0,
        'exclude'      => '',
        'include'      => '',
        'title_li'     => '',
        'echo'         => 1,
        'authors'      => '',
        'sort_column'  => 'menu_order, post_title',
        'link_before'  => '',
        'link_after'   => '',
        'walker'       => new Top_Bar_Page_Walker(),
        'post_type'    => 'page',
        'post_status'  => 'publish'
    ));
    echo "</ul>";
}

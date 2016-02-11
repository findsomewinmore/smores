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

// Composer dependencies
require _DIR_ . '/lib/vendor/autoload.php';

use Smores\Smores;
use Smores\TopBarPageWalker;
use Smores\TopBarWalker;

// Instantiate Smores
// $smores = new Smores(
//     array( // Includes
//         'lib/admin',         // Add admin scripts
//         'lib/ajax',          // Add ajax scripts
//         'lib/classes',       // Add classes
//         'lib/custom-fields', // Add custom field scripts
//         'lib/forms',         // Add form scripts
//         'lib/images',        // Add images scripts
//         'lib/post-types',    // Add post type scripts
//         'lib/shortcodes',    // Add shortcode scripts
//         'lib/widgets',       // Add widget scripts
//     ),
//     array( // Assets
//         'css'             => '/assets/css/styles.min.css',
//         'js'              => '/assets/js/scripts.min.js',
//         'modernizr'       => '/assets/js/vendor/modernizr.min.js',
//         'jquery'          => '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.js',
//         'jquery_fallback' => '/assets/js/vendor/jquery.min.js',
//     ),
// );

/**
 * [smores_numeric_pagination description]
 *
 * @param  [type] $custom_query [description]
 * @param  string $classes      [description]
 * @return [type]               [description]
 */
function smores_numeric_pagination($custom_query = false, $classes = '')
{
    $query = null;

    if ($custom_query) {
        $query = $custom_query;
    } else {
        global $wp_query;

        $query = $wp_query;

        if (is_singular()) {
            return;
        }
    }

    /** Stop execution if there's only 1 page */
    if ($query->max_num_pages <= 1) {
        return;
    }

    $paged = (get_query_var('paged')) ? absint( get_query_var('paged')) : 1;
    $max   = $query->max_num_pages;

    /** Add current page to the array */
    if ($paged >= 1) {
        $links[] = $paged;
    }

    /** Add the pages around the current page to the array */
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo "<ul class=\"pagination {$classes}\" role=\"menubar\" aria-label=\"Pagination\">\n";

    /** Previous Post Link */
    if (get_previous_posts_link()) {
        printf("<li class=\"arrow show-for-medium-up previous-link\">%s</li>\n", get_previous_posts_link());
    } else {
        echo '<li class="arrow unavailable previous-link"><a href="#">&laquo; Previous Page</a></li>';
    }

    /** Link to first page, plus ellipses if necessary */
    if (!in_array(1, $links)) {
        $class = ($paged === 1) ? ' class="current"' : '';

        printf("<li%s><a href=\"%s\">%s</a></li>\n", $class, esc_url(get_pagenum_link(1)), '1');

        if (!in_array(2, $links)) {
            echo '<li>…</li>';
        }
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort($links);

    foreach ((array) $links as $link) {
        $class = ($paged === $link) ? ' class="current"' : '';

        printf("<li%s><a href=\"%s\">%s</a></li>\n", $class, esc_url(get_pagenum_link($link)), $link);
    }

    /** Link to last page, plus ellipses if necessary */
    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links)) {
            echo "<li>…</li>\n";
        }

        $class = ($paged === $max) ? ' class="current"' : '';

        printf("<li%s><a href=\"%s\">%s</a></li>\n", $class, esc_url(get_pagenum_link($max)), $max);
    }

    /** Next Post Link */
    if (get_next_posts_link()) {
        printf("<li class=\"arrow next-link\">%s</li>\n", get_next_posts_link());
    } else {
        echo '<li class="arrow unavailable show-for-medium-up next-link"><a href="#">Next Page &raquo;</a></li>';
    }

    echo "</ul>\n";
}

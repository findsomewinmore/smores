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
 
// the left top bar
function fiwi_foundation_top_bar_l() {
    wp_nav_menu(array( 
        'container' => false,                           // remove nav container
        'container_class' => 'menu',                // class of container
        'menu' => '',                               // menu name
        'menu_class' => 'top-bar-menu left',            // adding custom nav class
        'theme_location' => 'top-bar-l',                // where it's located in the theme
        'before' => '',                                 // before each link <a> 
        'after' => '',                                  // after each link </a>
        'link_before' => '',                            // before each link text
        'link_after' => '',                             // after each link text
        'depth' => 5,                                   // limit the depth of the nav
        'fallback_cb' => false,                         // fallback function (see below)
        'walker' => new top_bar_walker()
    ));
} // end left top bar
 
// the right top bar
function fiwi_foundation_top_bar_r() {
    wp_nav_menu(array( 
        'container' => false,                           // remove nav container
        'container_class' => '',                // class of container
        'menu' => '',                               // menu name
        'menu_class' => 'top-bar-menu right',           // adding custom nav class
        'theme_location' => 'top-bar-r',                // where it's located in the theme
        'before' => '',                                 // before each link <a> 
        'after' => '',                                  // after each link </a>
        'link_before' => '',                            // before each link text
        'link_after' => '',                             // after each link text
        'depth' => 5,                                   // limit the depth of the nav
        'fallback_cb' => false,                         // fallback function (see below)
        'walker' => new top_bar_walker()
    ));
} // end right top bar


/*
Customize the output of menus for Foundation top bar classes and add descriptions
 
http://www.kriesi.at/archives/improve-your-wordpress-navigation-menu-output
http://code.hyperspatial.com/1514/twitter-bootstrap-walker-classes/
*/
class top_bar_walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
 
        $class_names = $value = '';
 
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        
    $classes[] = ($item->current) ? 'active' : '';
        $classes[] = ($args->has_children) ? 'has-dropdown' : '';
        
    $args->link_before = (in_array('section', $classes)) ? '<label>' : '';
    $args->link_after = (in_array('section', $classes)) ? '</label>' : '';
    $output .= (in_array('section', $classes)) ? '<li class="divider"></li>' : '';
 
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args ) );
        $class_names = strlen(trim($class_names)) > 0 ? ' class="'.esc_attr($class_names).'"' : '';
        
    $output .= ($depth == 0) ? $indent.'<li class="divider"></li>' : '';
        $output .= $indent.'<li id="menu-item-'.$item->ID.'"'.$value.$class_names.'>';
 
        $attributes  = !empty($item->attr_title) ? ' title="' .esc_attr($item->attr_title).'"' : '';
        $attributes .= !empty($item->target)     ? ' target="'.esc_attr($item->target    ).'"' : '';
        $attributes .= !empty($item->xfn)        ? ' rel="'   .esc_attr($item->xfn       ).'"' : '';
        $attributes .= !empty($item->url)        ? ' href="'  .esc_attr($item->url       ).'"' : '';
        
    $item_output  = $args->before;
    $item_output .= (!in_array('section', $classes)) ? '<a'.$attributes.'>' : '';
    $item_output .= $args->link_before.apply_filters('the_title', $item->title, $item->ID);
    $item_output .= $args->link_after;
    $item_output .= (!in_array('section', $classes)) ? '</a>' : '';
    $item_output .= $args->after;
 
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    function end_el(&$output, $item, $depth) {
        $output .= '</li>'."\n";
    }
    function start_lvl(&$output, $depth) {
        $indent  = str_repeat("\t", $depth);
        $output .= "\n".$indent.'<ul class="sub-menu dropdown">'."\n";
    }
    function end_lvl(&$output, $depth) {
        $indent  = str_repeat("\t", $depth);
        $output .= $indent.'</ul>'."\n";
    }       
    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $id_field = $this->db_fields['id'];
        if (is_object($args[0])) {
            $args[0]->has_children = ! empty($children_elements[$element->$id_field]);
        }
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }   
} // end top bar walker

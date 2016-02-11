<?php
/**
 *
 */

namespace Smores;

class TopBarPageWalker extends Walker_Page
{
    /**
     * [display_element description]
     *
     * @param  [type]  $element           [description]
     * @param  [type]  $children_elements [description]
     * @param  [type]  $max_depth         [description]
     * @param  integer $depth             [description]
     * @param  [type]  $args              [description]
     * @param  [type]  $output            [description]
     * @return [type]                     [description]
     */
    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output)
    {
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    /**
     * [start_el description]
     *
     * @param  [type]  $output [description]
     * @param  [type]  $item   [description]
     * @param  integer $depth  [description]
     * @param  array   $args   [description]
     * @return [type]          [description]
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $item_html = '';

        parent::start_el($item_html, $item, $depth, $args);

        $output  .= ($depth == 0) ? '<li class="divider"></li>' : '';
        $classes  = empty($item->classes) ? array() : (array) $item->classes;

        if(in_array('label', $classes)) {
            $output    .= '<li class="divider"></li>';
            $item_html  = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '<label>$1</label>', $item_html);
        }

        if (in_array('divider', $classes)) {
            $item_html = preg_replace( '/<a[^>]*>( .* )<\/a>/iU', '', $item_html );
        }

        $output .= $item_html;
    }

    /**
     * [start_lvl description]
     *
     * @param  [type]  $output [description]
     * @param  integer $depth  [description]
     * @param  array   $args   [description]
     * @return [type]          [description]
     */
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= "\n<ul class=\"sub-menu dropdown\">\n";
    }
}

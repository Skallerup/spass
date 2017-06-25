<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

require_once 'admin/settings.php';

add_action( 'wp_enqueue_scripts', 'reales_enqueue_styles' );
function reales_enqueue_styles() {
    wp_enqueue_style( 'reales_style', get_template_directory_uri() . '/style.css', 
        array(
            'open_sans',
            'font_awesome', 
            'simple_line_icons', 
            'jquery_ui', 
            'file_input', 
            'bootstrap_style',
            'datepicker',
            'fancybox',
            'fancybox_buttons'
        )
    );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array(
            'open_sans',
            'font_awesome', 
            'simple_line_icons', 
            'jquery_ui', 
            'file_input', 
            'bootstrap_style',
            'datepicker',
            'fancybox',
            'fancybox_buttons',
            'reales_style'
        )
    );
}


?>
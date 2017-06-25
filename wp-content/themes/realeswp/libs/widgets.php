<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

require 'widgets/contact_widget.php';
require 'widgets/social_widget.php';
require 'widgets/featured_properties_widget.php';
require 'widgets/recent_properties_widget.php';
require 'widgets/featured_agents_widget.php';
require 'widgets/search_widget.php';

/**
 * Register Reales custom widgets
 */
if( !function_exists('reales_register_widgets') ): 
    function reales_register_widgets() {
        register_widget('Contact_Widget');
        register_widget('Social_Widget');
        register_widget('Featured_Properties_Widget');
        register_widget('Recent_Properties_Widget');
        register_widget('Featured_Agents_Widget');
        register_widget('Search_Widget');
    }
endif;
add_action( 'widgets_init', 'reales_register_widgets' );

?>
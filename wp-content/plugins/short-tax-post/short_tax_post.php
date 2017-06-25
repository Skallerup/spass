<?php
/*
* Plugin Name: Reales WP STPT
* Description: Creates shortcodes, register custom taxonomies and post types
* Version: 1.0.8
* Author: Marius Nastase
* Author URI: http://mariusn.com
*/

define('PLUGIN_PATH', plugin_dir_url( __FILE__ ));
define('PLUGIN_BASENAME', plugin_basename(__FILE__));

add_action( 'plugins_loaded', 'reales_load_textdomain' );
function reales_load_textdomain() {
    load_plugin_textdomain( 'reales', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

/**
 *****************************************************************************
 * Shortcodes
 *****************************************************************************
 */


require_once 'libs/shortcodes/services.php';
require_once 'libs/shortcodes/recent_properties.php';
require_once 'libs/shortcodes/featured_properties.php';
require_once 'libs/shortcodes/featured_agents.php';
require_once 'libs/shortcodes/testimonials.php';
require_once 'libs/shortcodes/latest_posts.php';
require_once 'libs/shortcodes/featured_posts.php';
require_once 'libs/shortcodes/membership_plans.php';
require_once 'libs/shortcodes/single_property.php';
require_once 'libs/shortcodes/columns.php';

if( !function_exists('reales_register_buttons') ): 
    function reales_register_buttons($buttons) {
        array_push($buttons, "|", "services");
        array_push($buttons, "|", "recent_properties");
        array_push($buttons, "|", "featured_properties");
        array_push($buttons, "|", "single_property");
        array_push($buttons, "|", "featured_agents");
        array_push($buttons, "|", "testimonials");
        array_push($buttons, "|", "latest_posts");
        array_push($buttons, "|", "featured_posts");
        array_push($buttons, "|", "membership_plans");
        array_push($buttons, "|", "column");

        return $buttons;
    }
endif;

if( !function_exists('reales_add_plugins') ): 
    function reales_add_plugins($plugin_array) {
        $plugin_array['services']            = plugin_dir_url( __FILE__ ) . '/js/shortcodes.js';
        $plugin_array['recent_properties']   = plugin_dir_url( __FILE__ ) . '/js/shortcodes.js';
        $plugin_array['featured_properties'] = plugin_dir_url( __FILE__ ) . '/js/shortcodes.js';
        $plugin_array['single_property']     = plugin_dir_url( __FILE__ ) . '/js/shortcodes.js';
        $plugin_array['featured_agents']     = plugin_dir_url( __FILE__ ) . '/js/shortcodes.js';
        $plugin_array['testimonials']        = plugin_dir_url( __FILE__ ) . '/js/shortcodes.js';
        $plugin_array['latest_posts']        = plugin_dir_url( __FILE__ ) . '/js/shortcodes.js';
        $plugin_array['featured_posts']      = plugin_dir_url( __FILE__ ) . '/js/shortcodes.js';
        $plugin_array['membership_plans']    = plugin_dir_url( __FILE__ ) . '/js/shortcodes.js';
        $plugin_array['column']              = plugin_dir_url( __FILE__ ) . '/js/shortcodes.js';
        return $plugin_array;
    }
endif;

if( !function_exists('reales_register_plugin_buttons') ): 
    function reales_register_plugin_buttons() {
        if(!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
            return;
        }

        if(get_user_option('rich_editing') == 'true') {
            add_filter('mce_external_plugins', 'reales_add_plugins');
            add_filter('mce_buttons_3', 'reales_register_buttons');
        }
    }
endif;

if( !function_exists('reales_register_shortcodes') ): 
    function reales_register_shortcodes() {
        add_shortcode('services', 'reales_services_shortcode');
        add_shortcode('recent_properties', 'reales_recent_properties_shortcode');
        add_shortcode('featured_properties', 'reales_featured_properties_shortcode');
        add_shortcode('single_property', 'reales_single_property_shortcode');
        add_shortcode('featured_agents', 'reales_featured_agents_shortcode');
        add_shortcode('testimonials', 'reales_testimonials_shortcode');
        add_shortcode('latest_posts', 'reales_latest_posts_shortcode');
        add_shortcode('featured_posts', 'reales_featured_posts_shortcode');
        add_shortcode('membership_plans', 'reales_membership_plans_shortcode');
        add_shortcode('column', 'reales_column_shortcode');
    }
endif;

add_action('init', 'reales_register_plugin_buttons');
add_action('init', 'reales_register_shortcodes');


/**
 *****************************************************************************
 * Custom post types
 *****************************************************************************
 */

require_once 'libs/custom_post_types/property.php';
require_once 'libs/custom_post_types/agent.php';
require_once 'libs/custom_post_types/testimonials.php';
require_once 'libs/custom_post_types/membership.php';
require_once 'libs/custom_post_types/invoice.php';

foreach ( array('post.php','post-new.php') as $hook ) {
    add_action( "admin_head-$hook", 'reales_admin_head' );
}

/**
 * Localize Script
 */
function reales_admin_head() {
    $admin_url = get_admin_url();
    ?>
    <!-- TinyMCE Shortcode Plugin -->
    <script type='text/javascript'>
    var my_plugin = {
        'admin_url': '<?php echo $admin_url; ?>',
    };
    </script>
    <!-- TinyMCE Shortcode Plugin -->
    <?php
}

if( !function_exists('reales_get_cts') ): 
    function reales_get_cts() {
        $cat_taxonomies = array( 
            'property_category'
        );
        $cat_args = array(
            'orderby'           => 'name', 
            'order'             => 'ASC',
            'hide_empty'        => false
        ); 
        $cat_terms = get_terms($cat_taxonomies, $cat_args);
        $type_taxonomies = array( 
            'property_type_category'
        );
        $type_args = array(
            'orderby'           => 'name', 
            'order'             => 'ASC',
            'hide_empty'        => false
        ); 
        $type_terms = get_terms($type_taxonomies, $type_args);

        echo json_encode(array('getcts'=>true, 'categories'=>$cat_terms, 'types'=>$type_terms));
        exit();

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_get_cts', 'reales_get_cts' );
add_action( 'wp_ajax_reales_get_cts', 'reales_get_cts' );
?>
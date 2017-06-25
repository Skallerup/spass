<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if( !function_exists('reales_search_my_properties') ): 
    function reales_search_my_properties($agent_id) {
        $reales_appearance_settings = get_option('reales_appearance_settings');
        $posts_per_page_setting = isset($reales_appearance_settings['reales_properties_per_page_field']) ? $reales_appearance_settings['reales_properties_per_page_field'] : '';
        $posts_per_page = $posts_per_page_setting != '' ? $posts_per_page_setting : 10;

        global $paged;

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'posts_per_page' => $posts_per_page,
            'paged' => $paged,
            'post_type' => 'property',
            'post_status' => array('publish', 'pending')
        );

        $args['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key'     => 'property_agent',
                'value'   => $agent_id,
            )
        );

        $query = new WP_Query($args);
        wp_reset_query();
        wp_reset_postdata();
        return $query;
    }
endif;

?>
<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

/**
 * Function to display post views
 */
if( !function_exists('reales_set_post_views') ): 
    function reales_set_post_views($post_id) {
        $count_key = 'post_views_count';
        $count = get_post_meta($post_id, $count_key, true);
        if($count == '') {
            $count = 0;
            delete_post_meta($post_id, $count_key);
            add_post_meta($post_id, $count_key, '0');
        } else {
            $count++;
            update_post_meta($post_id, $count_key, $count);
        }
    }
endif;

/**
 * Function to get post views
 */
if( !function_exists('reales_get_post_views') ): 
    function reales_get_post_views($post_id, $after) {
        $count_key = 'post_views_count';
        $count = get_post_meta($post_id, $count_key, true);
        if($count == '') {
            delete_post_meta($post_id, $count_key);
            add_post_meta($post_id, $count_key, '0');
            return "0";
        } else if($count > 9999) {
            return "9999+";
        }
        return $count . ' ' . $after;
    }
endif;

?>
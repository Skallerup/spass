<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

/**
 * Function to add property to favourites
 */
if( !function_exists('reales_add_to_favourites') ): 
    function reales_add_to_favourites() {
        check_ajax_referer('fav_ajax_nonce', 'security');
        $post_id = isset($_POST['post_id']) ? sanitize_text_field($_POST['post_id']) : '';
        $user_id = isset($_POST['user_id']) ? sanitize_text_field($_POST['user_id']) : '';

        $fav_key = 'property_fav';
        $fav = get_user_meta($user_id, $fav_key, true);
        if($fav == '') {
            $fav = array();
            delete_user_meta($user_id, $fav_key);
            add_user_meta($user_id, $fav_key, $fav);
        }
        if(in_array($post_id, $fav) === false) {
            array_push($fav, $post_id);
            update_user_meta($user_id, $fav_key, $fav);
        }

        echo json_encode(array('addfav'=>true, 'fav'=>$fav));

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_add_to_favourites', 'reales_add_to_favourites' );
add_action( 'wp_ajax_reales_add_to_favourites', 'reales_add_to_favourites' );

/**
 * Function to remove property from favourites
 */
if( !function_exists('reales_remove_from_favourites') ): 
    function reales_remove_from_favourites() {
        check_ajax_referer('fav_ajax_nonce', 'security');
        $post_id = isset($_POST['post_id']) ? sanitize_text_field($_POST['post_id']) : '';
        $user_id = isset($_POST['user_id']) ? sanitize_text_field($_POST['user_id']) : '';

        $fav_key = 'property_fav';
        $fav = get_user_meta($user_id, $fav_key, true);
        if(in_array($post_id, $fav)) {
            $fav = array_diff($fav, array($post_id));
            update_user_meta($user_id, $fav_key, $fav);
        }

        echo json_encode(array('removefav'=>true, 'fav'=>$fav));

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_remove_from_favourites', 'reales_remove_from_favourites' );
add_action( 'wp_ajax_reales_remove_from_favourites', 'reales_remove_from_favourites' );

?>
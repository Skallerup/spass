<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

/**
 * Admin notification when new property submitted
 */
if( !function_exists('reales_admin_property_notification') ): 
    function reales_admin_property_notification($property_title, $agent_id, $edit) {
        if($edit == '') {
            $message = sprintf( __('A new property was submitted on %s:','reales'), get_option('blogname') ) . "\r\n\r\n";
            $message .= sprintf( __('Property title: %s','reales'), esc_html($property_title) ) . "\r\n\r\n";
            $message .= sprintf( __('Agent: %s','reales'), get_the_title($agent_id) ) . "\r\n";
            $headers = 'From: noreply  <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n" .
                    'Reply-To: noreply@' . $_SERVER['HTTP_HOST'] . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
            wp_mail(
                get_option('admin_email'),
                sprintf(__('[%s] Property Submitted','reales'), get_option('blogname') ),
                $message,
                $headers
            );
        } else {
            $message = sprintf( __('A property was updated on %s:','reales'), get_option('blogname') ) . "\r\n\r\n";
            $message .= sprintf( __('Property title: %s','reales'), esc_html($property_title) ) . "\r\n\r\n";
            $message .= sprintf( __('Agent: %s','reales'), get_the_title($agent_id) ) . "\r\n";
            $headers = 'From: noreply  <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n" .
                    'Reply-To: noreply@' . $_SERVER['HTTP_HOST'] . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
            wp_mail(
                get_option('admin_email'),
                sprintf(__('[%s] Property Updated','reales'), get_option('blogname') ),
                $message,
                $headers
            );
        }
    }
endif;

/**
 * Save property
 */
if( !function_exists('reales_save_property') ): 
    function reales_save_property() {
        check_ajax_referer('submit_property_ajax_nonce', 'security');

        $reales_prop_fields_settings = get_option('reales_prop_fields_settings');
        $p_price = isset($reales_prop_fields_settings['reales_p_price_field']) ? $reales_prop_fields_settings['reales_p_price_field'] : '';
        $p_price_r = isset($reales_prop_fields_settings['reales_p_price_r_field']) ? $reales_prop_fields_settings['reales_p_price_r_field'] : '';
        $p_description = isset($reales_prop_fields_settings['reales_p_description_field']) ? $reales_prop_fields_settings['reales_p_description_field'] : '';
        $p_description_r = isset($reales_prop_fields_settings['reales_p_description_r_field']) ? $reales_prop_fields_settings['reales_p_description_r_field'] : '';
        $p_category = isset($reales_prop_fields_settings['reales_p_category_field']) ? $reales_prop_fields_settings['reales_p_category_field'] : '';
        $p_category_r = isset($reales_prop_fields_settings['reales_p_category_r_field']) ? $reales_prop_fields_settings['reales_p_category_r_field'] : '';
        $p_type = isset($reales_prop_fields_settings['reales_p_type_field']) ? $reales_prop_fields_settings['reales_p_type_field'] : '';
        $p_type_r = isset($reales_prop_fields_settings['reales_p_type_r_field']) ? $reales_prop_fields_settings['reales_p_type_r_field'] : '';
        $p_city = isset($reales_prop_fields_settings['reales_p_city_field']) ? $reales_prop_fields_settings['reales_p_city_field'] : '';
        $p_city_r = isset($reales_prop_fields_settings['reales_p_city_r_field']) ? $reales_prop_fields_settings['reales_p_city_r_field'] : '';
        $p_coordinates = isset($reales_prop_fields_settings['reales_p_coordinates_field']) ? $reales_prop_fields_settings['reales_p_coordinates_field'] : '';
        $p_coordinates_r = isset($reales_prop_fields_settings['reales_p_coordinates_r_field']) ? $reales_prop_fields_settings['reales_p_coordinates_r_field'] : '';
        $p_address = isset($reales_prop_fields_settings['reales_p_address_field']) ? $reales_prop_fields_settings['reales_p_address_field'] : '';
        $p_address_r = isset($reales_prop_fields_settings['reales_p_address_r_field']) ? $reales_prop_fields_settings['reales_p_address_r_field'] : '';
        $p_neighborhood = isset($reales_prop_fields_settings['reales_p_neighborhood_field']) ? $reales_prop_fields_settings['reales_p_neighborhood_field'] : '';
        $p_neighborhood_r = isset($reales_prop_fields_settings['reales_p_neighborhood_r_field']) ? $reales_prop_fields_settings['reales_p_neighborhood_r_field'] : '';
        $p_zip = isset($reales_prop_fields_settings['reales_p_zip_field']) ? $reales_prop_fields_settings['reales_p_zip_field'] : '';
        $p_zip_r = isset($reales_prop_fields_settings['reales_p_zip_r_field']) ? $reales_prop_fields_settings['reales_p_zip_r_field'] : '';
        $p_state = isset($reales_prop_fields_settings['reales_p_state_field']) ? $reales_prop_fields_settings['reales_p_state_field'] : '';
        $p_state_r = isset($reales_prop_fields_settings['reales_p_state_r_field']) ? $reales_prop_fields_settings['reales_p_state_r_field'] : '';
        $p_country = isset($reales_prop_fields_settings['reales_p_country_field']) ? $reales_prop_fields_settings['reales_p_country_field'] : '';
        $p_country_r = isset($reales_prop_fields_settings['reales_p_country_r_field']) ? $reales_prop_fields_settings['reales_p_country_r_field'] : '';
        $p_area = isset($reales_prop_fields_settings['reales_p_area_field']) ? $reales_prop_fields_settings['reales_p_area_field'] : '';
        $p_area_r = isset($reales_prop_fields_settings['reales_p_area_r_field']) ? $reales_prop_fields_settings['reales_p_area_r_field'] : '';
        $p_bedrooms = isset($reales_prop_fields_settings['reales_p_bedrooms_field']) ? $reales_prop_fields_settings['reales_p_bedrooms_field'] : '';
        $p_bathrooms = isset($reales_prop_fields_settings['reales_p_bathrooms_field']) ? $reales_prop_fields_settings['reales_p_bathrooms_field'] : '';
        $p_plans = isset($reales_prop_fields_settings['reales_p_plans_field']) ? $reales_prop_fields_settings['reales_p_plans_field'] : '';
        $p_video = isset($reales_prop_fields_settings['reales_p_video_field']) ? $reales_prop_fields_settings['reales_p_video_field'] : '';

        $user_id = isset($_POST['user']) ? sanitize_text_field($_POST['user']) : '';
        $new_id = isset($_POST['new_id']) ? sanitize_text_field($_POST['new_id']) : '';
        $title = isset($_POST['title']) ? sanitize_text_field($_POST['title']) : '';
        $content = isset($_POST['content']) ? $_POST['content'] : '';
        $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '0';
        $type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '0';
        $city = isset($_POST['city']) ? sanitize_text_field($_POST['city']) : '';
        $lat = isset($_POST['lat']) ? sanitize_text_field($_POST['lat']) : '';
        $lng = isset($_POST['lng']) ? sanitize_text_field($_POST['lng']) : '';
        $address = isset($_POST['address']) ? sanitize_text_field($_POST['address']) : '';
        $neighborhood = isset($_POST['neighborhood']) ? sanitize_text_field($_POST['neighborhood']) : '';
        $zip = isset($_POST['zip']) ? sanitize_text_field($_POST['zip']) : '';
        $state = isset($_POST['state']) ? sanitize_text_field($_POST['state']) : '';
        $country = isset($_POST['country']) ? sanitize_text_field($_POST['country']) : '';
        $price = isset($_POST['price']) ? sanitize_text_field($_POST['price']) : '';
        // Comment this for now
        // $price_no = preg_replace('/[^a-z_ \-0-9\x{4e00}-\x{9fa5}]/ui', '', $price);
        $price_label = isset($_POST['price_label']) ? sanitize_text_field($_POST['price_label']) : '';
        $area = isset($_POST['area']) ? sanitize_text_field($_POST['area']) : '';
        $bedrooms = isset($_POST['bedrooms']) ? sanitize_text_field($_POST['bedrooms']) : '';
        $bathrooms = isset($_POST['bathrooms']) ? sanitize_text_field($_POST['bathrooms']) : '';
        if($bedrooms == '0') {
            $bedrooms = '';
        }
        if($bathrooms == '0') {
            $bathrooms = '';
        }
        $new_amenities = isset($_POST['amenities']) ? array_map('reales_sanitize_item', $_POST['amenities']) : '';
        if($_POST['cfields'] && is_array($_POST['cfields'])) {
            array_walk_recursive($_POST['cfields'], 'reales_sanitize_multi_array');
            $custom_fields = $_POST['cfields'];
        } else {
            $custom_fields = '';
        }
        $gallery = isset($_POST['gallery']) ? sanitize_text_field($_POST['gallery']) : '';
        $plans = isset($_POST['plans']) ? sanitize_text_field($_POST['plans']) : '';
        $video_source = isset($_POST['video_source']) ? sanitize_text_field($_POST['video_source']) : '';
        $video_id = isset($_POST['video_id']) ? sanitize_text_field($_POST['video_id']) : '';
        $agent_id = reales_get_agent_by_userid($user_id);

        $reales_general_settings = get_option('reales_general_settings');
        $review = isset($reales_general_settings['reales_review_field']) ? $reales_general_settings['reales_review_field'] : '';

        if($review != '' || ($new_id != '' && get_post_status($new_id) == 'publish')) {
            $prop_status = 'publish';
        } else {
            $prop_status = 'pending';
        }

        $prop = array(
            'post_title' => $title,
            'post_content' => $content,
            'post_type' => 'property',
            'post_status' => $prop_status,
            'post_author' => $user_id
        );

        if($new_id != '') {
            $prop['ID'] = $new_id;
        }

        $reales_captcha_settings = get_option('reales_captcha_settings');
        $show_captcha = isset($reales_captcha_settings['reales_captcha_submit_field']) ? $reales_captcha_settings['reales_captcha_submit_field'] : false;
        $site_key = isset($reales_captcha_settings['reales_captcha_site_key_field']) ? $reales_captcha_settings['reales_captcha_site_key_field'] : '';
        $secret_key = isset($reales_captcha_settings['reales_captcha_secret_key_field']) ? $reales_captcha_settings['reales_captcha_secret_key_field'] : '';

        if($show_captcha && $site_key != '' && $secret_key != '') {
            $captcha_response = isset($_POST['g-recaptcha-response']) ? sanitize_text_field($_POST['g-recaptcha-response']) : '';
            $reCaptcha = new \ReCaptcha\ReCaptcha($secret_key, new \ReCaptcha\RequestMethod\CurlPost());
            $check_captcha = $reCaptcha->verify($captcha_response, $_SERVER['REMOTE_ADDR']);

            if($check_captcha->isSuccess() == false) {
                echo json_encode(array('sent'=>false, 'message'=>__('Please retry CAPTCHA', 'reales')));
                exit();
            }
        }

        if($title == '') {
            echo json_encode(array('save'=>false, 'message'=>__('Title field is mandatory.', 'reales')));
            exit();
        }
        if($price == '' && $p_price != '' && $p_price == 'enabled' && $p_price_r != '' && $p_price_r == 'required') {
            echo json_encode(array('save'=>false, 'message'=>__('Price field is mandatory.', 'reales')));
            exit();
        }
        if($content == '' && $p_description != '' && $p_description == 'enabled' && $p_description_r != '' && $p_description_r == 'required') {
            echo json_encode(array('save'=>false, 'message'=>__('Description field is mandatory.', 'reales')));
            exit();
        }
        if($category == '0' && $p_category != '' && $p_category == 'enabled' && $p_category_r != '' && $p_category_r == 'required') {
            echo json_encode(array('save'=>false, 'message'=>__('Category field is mandatory.', 'reales')));
            exit();
        }
        if($type == '0' && $p_type != '' && $p_type == 'enabled' && $p_type_r != '' && $p_type_r == 'required') {
            echo json_encode(array('save'=>false, 'message'=>__('Type field is mandatory.', 'reales')));
            exit();
        }
        if($lat == '' && $lng == '' && $p_coordinates != '' && $p_coordinates == 'enabled' && $p_coordinates_r != '' && $p_coordinates_r == 'required') {
            echo json_encode(array('save'=>false, 'message'=>__('Coordinates fields are mandatory.', 'reales')));
            exit();
        }
        if($address == '' && $p_address != '' && $p_address == 'enabled' && $p_address_r != '' && $p_address_r == 'required') {
            echo json_encode(array('save'=>false, 'message'=>__('Address field is mandatory.', 'reales')));
            exit();
        }
        if($neighborhood == '' && $p_neighborhood != '' && $p_neighborhood == 'enabled' && $p_neighborhood_r != '' && $p_neighborhood_r == 'required') {
            echo json_encode(array('save'=>false, 'message'=>__('Neighborhood field is mandatory.', 'reales')));
            exit();
        }
        if($zip == '' && $p_zip != '' && $p_zip == 'enabled' && $p_zip_r != '' && $p_zip_r == 'required') {
            echo json_encode(array('save'=>false, 'message'=>__('Zip Code field is mandatory.', 'reales')));
            exit();
        }
        if($state == '' && $p_state != '' && $p_state == 'enabled' && $p_state_r != '' && $p_state_r == 'required') {
            echo json_encode(array('save'=>false, 'message'=>__('County/State field is mandatory.', 'reales')));
            exit();
        }
        if($country == '' && $p_country != '' && $p_country == 'enabled' && $p_country_r != '' && $p_country_r == 'required') {
            echo json_encode(array('save'=>false, 'message'=>__('Country field is mandatory.', 'reales')));
            exit();
        }
        if($area == '' && $p_area != '' && $p_area == 'enabled' && $p_area_r != '' && $p_area_r == 'required') {
            echo json_encode(array('save'=>false, 'message'=>__('Area field is mandatory.', 'reales')));
            exit();
        }
        if($gallery == '') {
            echo json_encode(array('save'=>false, 'message'=>__('Upload at least 1 image in gallery.', 'reales')));
            exit();
        }
        if($custom_fields != '') {
            foreach($custom_fields as $key => $value) {
                if($value['field_mandatory'] == 'yes' && $value['field_value'] == '') {
                    echo json_encode(array('save'=>false, 'message'=> sprintf (__('%s field is mandatory.', 'reales'), $value['field_label'])));
                    exit();
                }
            }
        }

        $prop_id = wp_insert_post($prop);
        wp_set_object_terms($prop_id, array(intval($category)), 'property_category');
        wp_set_object_terms($prop_id, array(intval($type)), 'property_type_category');
        $prop_link = get_permalink($prop_id);
        update_post_meta($prop_id, 'property_city', $city);
        update_post_meta($prop_id, 'property_lat', $lat);
        update_post_meta($prop_id, 'property_lng', $lng);
        update_post_meta($prop_id, 'property_address', $address);
        update_post_meta($prop_id, 'property_neighborhood', $neighborhood);
        update_post_meta($prop_id, 'property_zip', $zip);
        update_post_meta($prop_id, 'property_state', $state);
        update_post_meta($prop_id, 'property_country', $country);
        update_post_meta($prop_id, 'property_price', $price);
        update_post_meta($prop_id, 'property_price_label', $price_label);
        update_post_meta($prop_id, 'property_area', $area);
        update_post_meta($prop_id, 'property_bedrooms', $bedrooms);
        update_post_meta($prop_id, 'property_bathrooms', $bathrooms);
        update_post_meta($prop_id, 'property_gallery', $gallery);
        update_post_meta($prop_id, 'property_plans', $plans);
        update_post_meta($prop_id, 'property_video_source', $video_source);
        update_post_meta($prop_id, 'property_video_id', $video_id);
        update_post_meta($prop_id, 'property_agent', $agent_id);
        if($new_id == '') {
            update_post_meta($prop_id, 'property_featured', '');
        }

        $reales_amenity_settings = get_option('reales_amenity_settings');

        if(is_array($reales_amenity_settings) && count($reales_amenity_settings) > 0) {
            foreach($reales_amenity_settings as $key => $value) {
                if(is_array($new_amenities) && in_array($key, $new_amenities)) {
                    update_post_meta($prop_id, $key, 1);
                } else {
                    update_post_meta($prop_id, $key, NULL);
                }
            }
        }

        if($custom_fields != '') {
            foreach($custom_fields as $key => $value) {
                update_post_meta($prop_id, $value['field_name'], $value['field_value']);
            }
        }

        $reales_membership_settings = get_option('reales_membership_settings', '');
        $payment_type               = isset($reales_membership_settings['reales_paid_field']) ? $reales_membership_settings['reales_paid_field'] : '';
        $standard_unlim             = isset($reales_membership_settings['reales_free_submissions_unlim_field']) ? $reales_membership_settings['reales_free_submissions_unlim_field'] : '';
        $agent_payment              = get_post_meta($agent_id, 'agent_payment', true);

        if($agent_payment == '1') {
            update_post_meta($prop_id, 'payment_status', 'paid');
        } else {
            // update the free standard submissions number on agent
            if($new_id == '' && $payment_type == 'listing') {
                $agent_free_listings = get_post_meta($agent_id, 'agent_free_listings', true);
                $afl_int             = intval($agent_free_listings);

                if($afl_int > 0 || $standard_unlim == '1') {
                    update_post_meta($agent_id, 'agent_free_listings', $afl_int - 1);
                    update_post_meta($prop_id, 'payment_status', 'paid');
                } else {
                    $updated_prop = array('ID' => $prop_id, 'post_status' => 'pending');
                    wp_update_post($updated_prop);
                }
            }

            // update the membership submissions number for agent
            if($new_id == '' && $payment_type == 'membership') {
                $agent_plan_listings = get_post_meta($agent_id, 'agent_plan_listings', true);
                $apl_int             = intval($agent_plan_listings);

                update_post_meta($agent_id, 'agent_plan_listings', $apl_int - 1);
                update_post_meta($prop_id, 'payment_status', 'paid');
            }
        }

        if($prop_id != 0) {
            $reales_notifications_settings = get_option('reales_notifications_settings');
            $notify_admin = isset($reales_notifications_settings['reales_notify_admin_publish_field']) ? $reales_notifications_settings['reales_notify_admin_publish_field'] : '';
            if($notify_admin == 1) {
                reales_admin_property_notification($title, $agent_id, $new_id);
            }
            if($review != '' || ($new_id != '' && get_post_status($new_id) == 'publish')) {
                echo json_encode(array('save'=>true, 'propID'=>$prop_id, 'propLink'=>$prop_link, 'propStatus'=>'publish', 'message'=>__('The property was successfully saved. Redirecting...', 'reales')));
                exit();
            } else {
                echo json_encode(array('save'=>true, 'propID'=>$prop_id, 'propLink'=>$prop_link, 'propStatus'=>'pending', 'message'=>__('The property was successfully saved. Redirecting...', 'reales')));
                exit();
            }
        } else {
            echo json_encode(array('save'=>false, 'message'=>__('Something went wrong. The property was not saved.', 'reales')));
            exit();
        }

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_save_property', 'reales_save_property' );
add_action( 'wp_ajax_reales_save_property', 'reales_save_property' );

/**
 * Delete property
 */
if( !function_exists('reales_delete_property') ): 
    function reales_delete_property() {
        check_ajax_referer('submit_property_ajax_nonce', 'security');

        $del_id = isset($_POST['new_id']) ? sanitize_text_field($_POST['new_id']) : '';

        $del_prop = wp_delete_post($del_id);

        if($del_prop) {
            echo json_encode(array('delete'=>true, 'message'=>__('The property was successfully deleted. Redirecting...', 'reales')));
            exit();
        } else {
            echo json_encode(array('delete'=>false, 'message'=>__('Something went wrong. The property was not deleted.', 'reales')));
            exit();
        }

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_delete_property', 'reales_delete_property' );
add_action( 'wp_ajax_reales_delete_property', 'reales_delete_property' );

/**
 * Upgrade property to featured
 */
if( !function_exists('reales_upgrade_property_featured') ): 
    function reales_upgrade_property_featured() {
        check_ajax_referer('upgrade_property_ajax_nonce', 'security');

        $prop_id = isset($_POST['prop_id']) ? sanitize_text_field($_POST['prop_id']) : '';
        $agent_id = isset($_POST['agent_id']) ? sanitize_text_field($_POST['agent_id']) : '';
        $agent_payment = get_post_meta($agent_id, 'agent_payment', true);

        $feat_prop = update_post_meta($prop_id, 'property_featured', 1);
        $agent_free_featured_listings = get_post_meta($agent_id, 'agent_free_featured_listings', true);
        $affl_int = intval($agent_free_featured_listings);

        if($agent_payment != '1') {
            update_post_meta($agent_id, 'agent_free_featured_listings', $affl_int - 1);
        }

        if($feat_prop) {
            echo json_encode(array('upgrade'=>true, 'message'=>__('The property was successfully upgraded to featured. Redirecting...', 'reales')));
            exit();
        } else {
            echo json_encode(array('upgrade'=>false, 'message'=>__('Something went wrong. The property was not upgraded.', 'reales')));
            exit();
        }

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_upgrade_property_featured', 'reales_upgrade_property_featured' );
add_action( 'wp_ajax_reales_upgrade_property_featured', 'reales_upgrade_property_featured' );

/**
 * Set property as featured from agent plan
 */
if( !function_exists('reales_set_property_featured') ): 
    function reales_set_property_featured() {
        check_ajax_referer('featured_property_ajax_nonce', 'security');

        $prop_id = isset($_POST['prop_id']) ? sanitize_text_field($_POST['prop_id']) : '';
        $agent_id = isset($_POST['agent_id']) ? sanitize_text_field($_POST['agent_id']) : '';
        $agent_payment = get_post_meta($agent_id, 'agent_payment', true);

        $feat_prop = update_post_meta($prop_id, 'property_featured', 1);
        $agent_plan_featured_listings = get_post_meta($agent_id, 'agent_plan_featured', true);
        $apfl_int = intval($agent_plan_featured_listings);

        if($agent_payment != '1') {
            update_post_meta($agent_id, 'agent_plan_featured', $apfl_int - 1);
        }

        if($feat_prop) {
            echo json_encode(array('upgrade'=>true, 'message'=>__('The property was successfully set as featured. Redirecting...', 'reales')));
            exit();
        } else {
            echo json_encode(array('upgrade'=>false, 'message'=>__('Something went wrong. The property was not set as featured.', 'reales')));
            exit();
        }

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_set_property_featured', 'reales_set_property_featured' );
add_action( 'wp_ajax_reales_set_property_featured', 'reales_set_property_featured' );

?>
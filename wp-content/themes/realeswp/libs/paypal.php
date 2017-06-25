<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if( !function_exists('reales_get_access_token') ):
    function reales_get_access_token($url, $postdata) {
        $reales_membership_settings = get_option('reales_membership_settings');
        $client_id = isset($reales_membership_settings['reales_paypal_client_id_field']) ? $reales_membership_settings['reales_paypal_client_id_field'] : '';
        $client_secret = isset($reales_membership_settings['reales_paypal_client_key_field']) ? $reales_membership_settings['reales_paypal_client_key_field'] : '';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_USERPWD, $client_id . ":" . $client_secret);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
        $response = curl_exec($curl);
        if(empty($response)) {
            die(curl_error($curl));
            curl_close($curl);
        } else {
            $info = curl_getinfo($curl);
            curl_close($curl);
            if($info['http_code'] != 200 && $info['http_code'] != 201 ) {
                echo "Received error: " . $info['http_code'] . "\n";
                echo "Raw response: " . $response . "\n";
                die();
            }
        }

        $jsonResponse = json_decode($response);
        return $jsonResponse->access_token;
    }

endif;

if( !function_exists('reales_make_post_call') ):
    function reales_make_post_call($url, $postdata, $token) {

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $token,
            'Accept: application/json',
            'Content-Type: application/json'
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
        $response = curl_exec($curl);
        if(empty($response)) {
            die(curl_error($curl));
            curl_close($curl);
        } else {
            $info = curl_getinfo($curl);
            curl_close($curl);
            if($info['http_code'] != 200 && $info['http_code'] != 201) {
                echo "Received error: " . $info['http_code'] . "\n";
                echo "Raw response: " . $response . "\n";
                die();
            }
        }

        $jsonResponse = json_decode($response, TRUE);
        return $jsonResponse;
    }
endif;

if( !function_exists('reales_pay_listing') ):
    function reales_pay_listing() {
        global $current_user;
        $current_user = wp_get_current_user();

        $prop_id = isset($_POST['prop_id']) ? intval($_POST['prop_id']) : '';
        $is_featured = isset($_POST['is_featured']) ? intval($_POST['is_featured']) : '';
        $is_upgrade = isset($_POST['is_upgrade']) ? intval($_POST['is_upgrade']) : '';

        get_currentuserinfo();
        $userID = $current_user->ID;
        $post = get_post($prop_id);

        if($post->post_author != $userID) {
            exit();
        }

        $reales_membership_settings = get_option('reales_membership_settings');
        $paypal_version = isset($reales_membership_settings['reales_paypal_api_version_field']) ? $reales_membership_settings['reales_paypal_api_version_field'] : '';

        $host = 'https://api.sandbox.paypal.com';
        $submission_price = isset($reales_membership_settings['reales_submission_price_field']) ? floatval($reales_membership_settings['reales_submission_price_field']) : 0;
        $featured_submission_price = isset($reales_membership_settings['reales_featured_price_field']) ? floatval($reales_membership_settings['reales_featured_price_field']) : 0;
        $payment_curency = isset($reales_membership_settings['reales_payment_currency_field']) ? $reales_membership_settings['reales_payment_currency_field'] : '';
        $payment_description = __('Listing payment on ', 'reales') . home_url();

        if($is_featured == 0) {
            $total_price =  number_format($submission_price, 2, '.', '');
        } else {
            $total_price = $submission_price + $featured_submission_price;
            $total_price = number_format($total_price, 2, '.', '');
        }

        if($is_upgrade == 1) {
            $total_price = number_format($featured_submission_price, 2, '.', '');
            $payment_description = __('Upgrade to Featured Listing on ', 'reales') . home_url();
        }

        if($paypal_version == 'live') {
            $host = 'https://api.paypal.com';
        }

        $url = $host.'/v1/oauth2/token';
        $postArgs = 'grant_type=client_credentials';
        $token = reales_get_access_token($url, $postArgs);
        $url = $host.'/v1/payments/payment';
        $my_properties_link = reales_get_my_properties_link();
        $processor_link = reales_get_paypal_procesor_link();


        $payment = array(
            'intent' => 'sale',
            'redirect_urls' => array(
                'return_url' => $processor_link,
                'cancel_url' => $my_properties_link
            ),
            'payer' => array('payment_method' => 'paypal'),
        );

        $payment['transactions'][0] = array(
            'amount' => array(
                'total' => $total_price,
                'currency' => $payment_curency,
                'details' => array(
                    'subtotal' => $total_price,
                    'tax' => '0.00',
                    'shipping' => '0.00'
                )
            ),
            'description' => $payment_description
        );

        if($is_upgrade == 1) {
            $payment['transactions'][0]['item_list']['items'][] = array(
                'quantity' => '1',
                'name' => __('Upgrade to Featured Listing', 'reales'),
                'price' => $total_price,
                'currency' => $payment_curency,
                'sku' => 'Upgrade Featured Listing',
            );
        } else {
            if($is_featured == 0) {
                $payment['transactions'][0]['item_list']['items'][] = array(
                    'quantity' => '1',
                    'name' => __('Listing Payment', 'reales'),
                    'price' => $total_price,
                    'currency' => $payment_curency,
                    'sku' => 'Paid Listing',
                );
            } else {
                $payment['transactions'][0]['item_list']['items'][] = array(
                    'quantity' => '1',
                    'name' => __('Listing Payment with Featured option', 'reales'),
                    'price' => $total_price,
                    'currency' => $payment_curency,
                    'sku' => 'Featured Paid Listing',
                );
            }
        }

        $json = json_encode($payment);
        $json_resp = reales_make_post_call($url, $json, $token);
        foreach($json_resp['links'] as $link) {
            if($link['rel'] == 'execute') {
                $payment_execute_url = $link['href'];
                $payment_execute_method = $link['method'];
            } else if($link['rel'] == 'approval_url') {
                $payment_approval_url = $link['href'];
                $payment_approval_method = $link['method'];
            }
        }

        $executor['paypal_execute'] = $payment_execute_url;
        $executor['paypal_token'] = $token;
        $executor['listing_id'] = $prop_id;
        $executor['is_featured'] = $is_featured;
        $executor['is_upgrade'] = $is_upgrade;
        $save_data[$current_user->ID] = $executor;
        update_option('paypal_transfer', $save_data);

        echo json_encode(array('url' => $payment_approval_url));

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_pay_listing', 'reales_pay_listing' );
add_action( 'wp_ajax_reales_pay_listing', 'reales_pay_listing' );

if( !function_exists('reales_pay_membership_plan') ):
    function reales_pay_membership_plan() {
        $plan_id = isset($_POST['plan_id']) ? intval($_POST['plan_id']) : '';

        $plan = get_post($plan_id);

        if(!empty($plan)) {
            global $current_user;
            get_currentuserinfo();
            $plan_price = get_post_meta($plan_id, 'membership_plan_price', true);

            $reales_membership_settings = get_option('reales_membership_settings');
            $paypal_version = isset($reales_membership_settings['reales_paypal_api_version_field']) ? $reales_membership_settings['reales_paypal_api_version_field'] : '';
            $payment_curency = isset($reales_membership_settings['reales_payment_currency_field']) ? $reales_membership_settings['reales_payment_currency_field'] : '';


            $host = 'https://api.sandbox.paypal.com';
            if($paypal_version == 'live') {
                $host = 'https://api.paypal.com';
            }

            $url = $host . '/v1/oauth2/token';
            $postArgs = 'grant_type=client_credentials';
            $token = reales_get_access_token($url, $postArgs);
            $url = $host . '/v1/payments/payment';

            $user_account_link = reales_get_user_account_link();

            $payment = array(
                'intent' => 'sale',
                'redirect_urls' => array(
                    'return_url' => $user_account_link,
                    'cancel_url' => $user_account_link
                ),
                'payer' => array('payment_method' => 'paypal'),
            );

            $payment['transactions'][0] = array(
                'amount' => array(
                    'total' => $plan_price,
                    'currency' => $payment_curency,
                    'details' => array(
                        'subtotal' => $plan_price,
                        'tax' => '0.00',
                        'shipping' => '0.00'
                    )
                ),
                'description' => $plan->post_title . ' ' . __('membership plan payment on', 'reales') . ' ' . home_url()
            );

            $payment['transactions'][0]['item_list']['items'][] = array(
                'quantity' => '1',
                'name' => __('Membership Plan Payment', 'reales'),
                'price' => $plan_price,
                'currency' => $payment_curency,
                'sku' => $plan->post_title . ' ' . __('Membership Payment', 'reales'),
            );

            $json = json_encode($payment);
            $json_resp = reales_make_post_call($url, $json, $token);
            foreach($json_resp['links'] as $link) {
                if($link['rel'] == 'execute') {
                    $payment_execute_url = $link['href'];
                    $payment_execute_method = $link['method'];
                } else if($link['rel'] == 'approval_url') {
                    $payment_approval_url = $link['href'];
                    $payment_approval_method = $link['method'];
                }
            }

            $executor['paypal_execute'] = $payment_execute_url;
            $executor['paypal_token'] = $token;
            $executor['plan_id'] = $plan_id;
            $save_data[$current_user->ID ] = $executor;
            update_option('paypal_plan_transfer', $save_data);

            echo json_encode(array('url' => $payment_approval_url));
        }
        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_pay_membership_plan', 'reales_pay_membership_plan' );
add_action( 'wp_ajax_reales_pay_membership_plan', 'reales_pay_membership_plan' );

if( !function_exists('reales_activate_membership_plan') ):
    function reales_activate_membership_plan() {
        $plan_id  = isset($_POST['plan_id']) ? intval($_POST['plan_id']) : '';
        $agent_id = isset($_POST['agent_id']) ? intval($_POST['agent_id']) : '';

        $plan = get_post($plan_id);

        if(!empty($plan)) {
            reales_update_agent_membership($agent_id, $plan_id, 1);

            $user_account_link = reales_get_user_account_link();
            echo json_encode(array('url' => $user_account_link));
        }
        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_activate_membership_plan', 'reales_activate_membership_plan' );
add_action( 'wp_ajax_reales_activate_membership_plan', 'reales_activate_membership_plan' );

if( !function_exists('reales_get_paypal_procesor_link') ):
    function reales_get_paypal_procesor_link() {
        $pages = get_pages(array(
            'meta_key'   => '_wp_page_template',
            'meta_value' => 'paypal-processor.php'
        ));

        if($pages) {
            $processor_link = get_permalink($pages[0]->ID);
        } else {
            $processor_link = home_url();
        }

        return $processor_link;
    }
endif;

if( !function_exists('reales_get_user_account_link') ):
    function reales_get_user_account_link() {
        $pages = get_pages(array(
            'meta_key'   => '_wp_page_template',
            'meta_value' => 'user-account.php'
        ));

        if($pages ) {
            $account_link = get_permalink($pages[0]->ID);
        } else {
            $account_link = home_url();
        }

        return $account_link;
    }
endif;

if( !function_exists('reales_get_my_properties_link') ):
    function reales_get_my_properties_link() {
        $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'my-properties.php'
        ));

        if($pages ) {
            $my_properties_link = get_permalink($pages[0]->ID);
        } else {
            $my_properties_link = home_url();
        }

        return $my_properties_link;
    }
endif;

if( !function_exists('reales_email_payment_to_admin') ):
    function reales_email_payment_to_admin($prop_id, $agent_id, $is_upgrade) {
        $headers = 'From: noreply  <noreply@' . $_SERVER['HTTP_HOST'] . '>' . "\r\n" .
                'Reply-To: noreply@' . $_SERVER['HTTP_HOST'] . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
     
        if($is_upgrade == 1) {
            $subject = sprintf(__('[%s] Listing Upgraded to Featured', 'reales'), get_option('blogname'));
            $message = sprintf(__('You have a new featured listing on %s.', 'reales'), get_option('blogname')) . "\r\n\r\n";
        } else {
            $subject = sprintf(__('[%s] New Paid Submission', 'reales'), get_option('blogname'));
            $message = sprintf(__('You have a new paid submission on %s.', 'reales'), get_option('blogname')) . "\r\n\r\n";
        }
        $message .= sprintf(__('Property title: %s','reales'), get_the_title($prop_id)) . "\r\n\r\n";
        $message .= sprintf(__('Agent: %s','reales'), get_the_title($agent_id)) . "\r\n";

        wp_mail(get_option('admin_email'), $subject, $message, $headers);
    }
endif;

if( !function_exists('reales_update_agent_membership') ):
    function reales_update_agent_membership($agent_id, $plan_id, $is_free = 0) {
        $plan_listings          = get_post_meta($plan_id, 'membership_submissions_no', true);
        $plan_unlimited         = get_post_meta($plan_id, 'membership_unlim_submissions', true);
        $plan_featured_listings = get_post_meta($plan_id, 'membership_featured_submissions_no', true);
        $agent_email            = get_post_meta($agent_id, 'agent_email', true);

        update_post_meta($agent_id, 'agent_plan', $plan_id);
        update_post_meta($agent_id, 'agent_plan_listings', $plan_listings);
        update_post_meta($agent_id, 'agent_plan_unlimited', $plan_unlimited);
        update_post_meta($agent_id, 'agent_plan_featured', $plan_featured_listings);

        $time = time(); 
        $date = date('Y-m-d H:i:s',$time); 
        update_post_meta($agent_id, 'agent_plan_activation', $date);

        if($is_free == 0) {
            reales_insert_invoice('Membership Plan', $plan_id, $agent_id, 0, 0);
        }

        $headers = 'From: noreply  <noreply@' . $_SERVER['HTTP_HOST'] . '>' . "\r\n" .
                'Reply-To: noreply@' . $_SERVER['HTTP_HOST'] . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

        $subject = sprintf(__('[%s] Membership Plan Activated', 'reales'), get_option('blogname'));
        $message = sprintf(__('You have a new membership plan on %s is activated.', 'reales'), get_option('blogname')) . "\r\n\r\n";
        $message .= sprintf(__('Membership Type: %s','reales'), get_the_title($plan_id)) . "\r\n";

        wp_mail($agent_email, $subject, $message, $headers);
    }
endif;

?>
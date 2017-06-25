<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

/**
 * Function that sends email message from contact agent form
 */
if( !function_exists('reales_send_message_to_agent') ): 
    function reales_send_message_to_agent() {
        check_ajax_referer('agent_message_ajax_nonce', 'security');

        $allowed_html = array();
        $agent_email = isset($_POST['agent_email']) ? sanitize_email($_POST['agent_email']) : '';
        $client_name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        $client_email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
        $client_phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
        $client_subject = isset($_POST['subject']) ? sanitize_text_field($_POST['subject']) : '';
        $client_message = isset($_POST['message']) ? sanitize_text_field($_POST['message']) : '';
        $p_info_title = isset($_POST['p_info_title']) ? sanitize_text_field($_POST['p_info_title']) : '';
        $p_info_link = isset($_POST['p_info_link']) ? sanitize_text_field($_POST['p_info_link']) : '';

        $reales_captcha_settings = get_option('reales_captcha_settings');
        $show_captcha = isset($reales_captcha_settings['reales_captcha_contact_field']) ? $reales_captcha_settings['reales_captcha_contact_field'] : false;
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

        if(empty($client_name) || empty($client_email) || empty($client_phone) || empty($client_subject) || empty($client_message)) {
            echo json_encode(array('sent'=>false, 'message'=>__('Your message failed to be sent. Please check your fields.', 'reales')));
            exit();
        }

        $body = '';
        if($p_info_title != '' && $p_info_link != '') {
            $body .= __('You received the following message from ', 'reales');
            $body .= $client_name . ' [Phone number: ' . $client_phone . ']' . "\n\n";
            $body .= __('regarding a property you listed: ', 'reales') . "\n";
            $body .=  $p_info_title . ' [ ' . $p_info_link . ' ]' . "\n\n";
            $body .= $client_message;
        } else {
            $body .= __('You received the following message from ', 'reales');
            $body .= $client_name . ' [Phone number: ' . $client_phone . ']' . "\n\n";
            $body .= $client_message;
        }

        $headers = 'From: ' . $client_name . '  <' . $client_email . '>' . "\r\n" .
                'Reply-To: ' . $client_name . '  <' . $client_email . '>' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        $send = wp_mail(
            $agent_email,
            sprintf( __('[%s Message from client] %s', 'reales'), get_option('blogname'), $client_subject ),
            $body,
            $headers
        );

        if($send) {
            echo json_encode(array('sent'=>true, 'message'=>__('Your message was successfully sent.', 'reales')));
            exit();
        } else {
            echo json_encode(array('sent'=>false, 'message'=>__('Your message failed to be sent.', 'reales')));
            exit();
        }

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_send_message_to_agent', 'reales_send_message_to_agent' );
add_action( 'wp_ajax_reales_send_message_to_agent', 'reales_send_message_to_agent' );

?>
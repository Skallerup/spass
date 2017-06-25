<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

/**
 * Function that sends email message to admin for reporting a property
 */
if( !function_exists('reales_report_property') ): 
    function reales_report_property() {
        check_ajax_referer('report_property_ajax_nonce', 'security');

        $reason       = isset($_POST['reason']) ? sanitize_text_field($_POST['reason']) : '';
        $report_title = isset($_POST['report_title']) ? sanitize_text_field($_POST['report_title']) : '';
        $report_link  = isset($_POST['report_link']) ? sanitize_text_field($_POST['report_link']) : '';

        if(empty($reason)) {
            echo json_encode(array('sent'=>false, 'message'=>__('Please describe a reason.', 'reales')));
            exit();
        }

        $body = '';
        $body .= __('You received a report regarding this property listing:', 'reales') . "\n\n";
        $body .=  $report_title . ' [ ' . $report_link . ' ]' . "\n\n";
        $body .=  __('Reason: ', 'reales') . "\n\n";
        $body .= $reason;

        $headers = 'From: noreply  <noreply@' . $_SERVER['HTTP_HOST'] . '>' . "\r\n" .
                'Reply-To: noreply@' . $_SERVER['HTTP_HOST'] . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        $send = wp_mail(
            get_option('admin_email'),
            sprintf( __('%s - Property Listing Report', 'reales'), get_option('blogname') ),
            $body,
            $headers
        );

        if($send) {
            echo json_encode(array('sent'=>true, 'message'=>__('Your report was successfully submited.', 'reales')));
            exit();
        } else {
            echo json_encode(array('sent'=>false, 'message'=>__('Your report failed to be submited.', 'reales')));
            exit();
        }

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_report_property', 'reales_report_property' );
add_action( 'wp_ajax_reales_report_property', 'reales_report_property' );

?>
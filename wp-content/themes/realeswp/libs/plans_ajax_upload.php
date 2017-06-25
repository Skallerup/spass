<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if( !function_exists('reales_upload_plans') ): 
    function reales_upload_plans() {
        $file = array(
            'name'      => sanitize_text_field($_FILES['aaiu_upload_file_plans']['name']),
            'type'      => sanitize_text_field($_FILES['aaiu_upload_file_plans']['type']),
            'tmp_name'  => sanitize_text_field($_FILES['aaiu_upload_file_plans']['tmp_name']),
            'error'     => sanitize_text_field($_FILES['aaiu_upload_file_plans']['error']),
            'size'      => sanitize_text_field($_FILES['aaiu_upload_file_plans']['size'])
        );
        $file = reales_fileupload_process_plans($file);
    }
endif;
add_action('wp_ajax_reales_upload_plans', 'reales_upload_plans');
add_action('wp_ajax_nopriv_reales_upload_plans', 'reales_upload_plans');

if( !function_exists('reales_delete_file_plans') ): 
    function reales_delete_file_plans() {
        $attach_id = intval(sanitize_text_field($_POST['attach_id']));
        wp_delete_attachment($attach_id, true);
        exit;
    }
endif;
add_action('wp_ajax_reales_delete_file_plans', 'reales_delete_file_plans');
add_action('wp_ajax_nopriv_reales_delete_file_plans', 'reales_delete_file_plans');

if( !function_exists('reales_fileupload_process_plans') ): 
    function reales_fileupload_process_plans($file) {

        $attachment = reales_handle_file_plans($file);

        if (is_array($attachment)) {
            $html = reales_get_html_plans($attachment);

            $response = array(
                'success'   => true,
                'html'      => $html,
                'attach'    => $attachment['id']
            );
            echo json_encode($response);
            exit;
        }
        $response = array('success' => false);
        echo json_encode($response);
        exit;
    }
endif;

if( !function_exists('reales_handle_file_plans') ): 
    function reales_handle_file_plans($upload_data) {

        $return = false;
        $uploaded_file = wp_handle_upload($upload_data, array('test_form' => false));

        if (isset($uploaded_file['file'])) {
            $file_loc   =   $uploaded_file['file'];
            $file_name  =   basename($upload_data['name']);
            $file_type  =   wp_check_filetype($file_name);

            $attachment = array(
                'post_mime_type' => $file_type['type'],
                'post_title' => preg_replace('/\.[^.]+$/', '', basename($file_name)),
                'post_content' => '',
                'post_status' => 'inherit'
            );

            $attach_id      =   wp_insert_attachment($attachment, $file_loc);
            $attach_data    =   wp_generate_attachment_metadata($attach_id, $file_loc);
            wp_update_attachment_metadata($attach_id, $attach_data);

            $return = array('data' => $attach_data, 'id' => $attach_id);

            return $return;
        }

        return $return;
    }
endif;

if( !function_exists('reales_get_html_plans') ): 
    function reales_get_html_plans($attachment) {
        $attach_id  =   $attachment['id'];
        $post       =   get_post($attach_id);
        $dir        =   wp_upload_dir();
        $path       =   $dir['baseurl'];
        $file       =    $attachment['data']['file'];
        $html       =   '';
        $html .= $path.'/'.$file; 

        return $html;
    }
endif;

?>
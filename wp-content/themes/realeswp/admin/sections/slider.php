<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if( !function_exists('reales_admin_slider') ): 
    function reales_admin_slider() {
        add_settings_section( 'reales_slider_section', __( 'Homepage Custom Slider', 'reales' ), 'reales_slider_section_callback', 'reales_slider_settings' );
    }
endif;

if( !function_exists('reales_slider_section_callback') ): 
    function reales_slider_section_callback() { 
        wp_nonce_field('add_slider_ajax_nonce', 'securitySlider', true);

        print '<h4>' . __('Add New Slide', 'reales') . '</h4>';
        print '<table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">' . __('Slide ID', 'reales') . '</th>
                    <td>
                        <input type="text" size="40" name="slide_id" id="slide_id">
                        <p class="help">' . __('Give the slide an unique ID (start with a letter)', 'reales') . '</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">' . __('Slide image', 'reales') . '</th>
                    <td>
                        <input type="text" size="40" name="slide_image" id="slide_image">
                        <input id="slide_image_btn" type="button"  class="slide_image_btn button" value="' . __('Browse...', 'reales') . '" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">' . __('Slide title', 'reales') . '</th>
                    <td>
                        <input type="text" size="40" name="slide_title" id="slide_title">
                    </td>
                </tr>
                <tr>
                    <th scope="row">' . __('Slide subtitle', 'reales') . '</th>
                    <td>
                        <input type="text" size="40" name="slide_subtitle" id="slide_subtitle">
                    </td>
                </tr>
                <tr>
                    <th scope="row">' . __('CTA button text', 'reales') . '</th>
                    <td>
                        <input type="text" size="40" name="slide_cta_text" id="slide_cta_text">
                    </td>
                </tr>
                <tr>
                    <th scope="row">' . __('CTA button link', 'reales') . '</th>
                    <td>
                        <input type="text" size="40" name="slide_cta_link" id="slide_cta_link">
                    </td>
                </tr>
                <tr>
                    <th scope="row">' . __('Position', 'reales') . '</th>
                    <td>
                        <input type="text" size="4" name="slide_position" id="slide_position" value="0">
                    </td>
                </tr>
            </tbody>
        </table>';
        print '<p class="submit"><input type="button" name="add_slide_btn" id="add_slide_btn" class="button button-secondary" value="' . __('Add Slide', 'reales') . '">&nbsp;&nbsp;&nbsp;<span class="fa fa-spin fa-spinner preloader"></span></p>';

        print '<h4>' . __('Slides', 'reales') . '</h4>';
        print '<table class="table table-hover" id="sliderTable">
                <thead>
                    <tr>
                        <th width="15%">' . __('Image', 'reales') . '</th>
                        <th width="65%">' . __('Details', 'reales') . '</th>
                        <th width="10%">' . __('Position', 'reales') . '</th>
                        <th width="10%">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>';

        $options = get_option('reales_slider_settings');
        if(is_array($options)) {
            uasort($options, "reales_compare_position");

            foreach ($options as $key => $value) {
                print '<tr>
                            <td><img src="' . $value['image'] . '"></td>
                            <td>
                                ' . __('Title', 'reales') . ': <input type="text" size="40" name="reales_slider_settings[' . $key . '][title]" value="' . $value['title'] . '">
                                <br>
                                ' . __('Image', 'reales') . ': <input type="text" size="40" name="reales_slider_settings[' . $key . '][image]" value="' . $value['image'] . '">
                                <input type="button" class="slide_image_btn button" value="' . __('Browse...', 'reales') . '" />
                                <br>
                                ' . __('Subtitle', 'reales') . ': <input type="text" size="40" name="reales_slider_settings[' . $key . '][subtitle]" value="' . $value['subtitle'] . '">
                                <br>
                                ' . __('CTA Button Text', 'reales') . ': <input type="text" size="40" name="reales_slider_settings[' . $key . '][cta_text]" value="' . $value['cta_text'] . '">
                                <br>
                                ' . __('CTA Button Link', 'reales') . ': <input type="text" size="40" name="reales_slider_settings[' . $key . '][cta_link]" value="' . $value['cta_link'] . '">
                            </td>
                            <td><input type="text" size="4" name="reales_slider_settings[' . $key . '][position]" value="' . $value['position'] . '"></td>
                            <td>
                                <a href="javascript:void(0);" data-row="' . $key . '" class="delete-slide">' . __('Delete', 'reales') . ' <span class="fa fa-spin fa-spinner preloader"></span></a>
                            </td>
                        </tr>';
            }
        }

        print '</tbody></table>';
    }
endif;

if( !function_exists('reales_add_slide') ): 
    function reales_add_slide() {
        check_ajax_referer('add_slider_ajax_nonce', 'security');
        $id       = isset($_POST['id']) ? sanitize_text_field($_POST['id']) : '';
        $image    = isset($_POST['image']) ? sanitize_text_field($_POST['image']) : '';
        $title    = isset($_POST['title']) ? sanitize_text_field($_POST['title']) : '';
        $subtitle = isset($_POST['subtitle']) ? sanitize_text_field($_POST['subtitle']) : '';
        $cta_text = isset($_POST['cta_text']) ? sanitize_text_field($_POST['cta_text']) : '';
        $cta_link = isset($_POST['cta_link']) ? sanitize_text_field($_POST['cta_link']) : '';
        $position = isset($_POST['position']) ? sanitize_text_field($_POST['position']) : '';

        if($id == '') {
            echo json_encode(array('add'=>false, 'message'=>__('Slide ID is mandatory.', 'reales')));
            exit();
        }
        if($position == '') {
            echo json_encode(array('add'=>false, 'message'=>__('Position is mandatory.', 'reales')));
            exit();
        }

        $var_name = str_replace(' ', '_', trim($id));
        $var_name = sanitize_key($var_name);

        $reales_slider_settings                        = get_option('reales_slider_settings');
        $reales_slider_settings[$var_name]['id']       = $id;
        $reales_slider_settings[$var_name]['image']    = $image;
        $reales_slider_settings[$var_name]['title']    = $title;
        $reales_slider_settings[$var_name]['subtitle'] = $subtitle;
        $reales_slider_settings[$var_name]['cta_text'] = $cta_text;
        $reales_slider_settings[$var_name]['cta_link'] = $cta_link;
        $reales_slider_settings[$var_name]['position'] = $position;

        update_option('reales_slider_settings', $reales_slider_settings);

        echo json_encode(array('add'=>true));
        exit();

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_add_slide', 'reales_add_slide' );
add_action( 'wp_ajax_reales_add_slide', 'reales_add_slide' );

if( !function_exists('reales_delete_slide') ): 
    function reales_delete_slide() {
        check_ajax_referer('add_slider_ajax_nonce', 'security');
        $id = isset($_POST['id']) ? sanitize_text_field($_POST['id']) : '';

        $reales_slider_settings = get_option('reales_slider_settings');
        unset($reales_slider_settings[$id]);
        update_option('reales_slider_settings', $reales_slider_settings);

        echo json_encode(array('delete'=>true));
        exit();

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_delete_slide', 'reales_delete_slide' );
add_action( 'wp_ajax_reales_delete_slide', 'reales_delete_slide' );
?>
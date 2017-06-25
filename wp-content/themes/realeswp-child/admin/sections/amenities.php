<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if( !function_exists('reales_admin_amenities') ): 
    function reales_admin_amenities() {
        add_settings_section( 'reales_amenities_section', __( 'Amenities', 'reales' ), 'reales_amenities_section_callback', 'reales_amenity_settings' );
    }
endif;

if( !function_exists('reales_amenities_section_callback') ): 
    function reales_amenities_section_callback() { 
        wp_nonce_field('add_amenities_ajax_nonce', 'securityAddAmenities', true);

        print '<h4>' . __('Add New Amenity', 'reales') . '</h4>';
        print '<table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">' . __('Amenity ID', 'reales') . '</th>
                    <td>
                        <input type="text" size="40" name="amenity_name" id="amenity_name">
                        <p class="help">' . __('Give the amenity an unique ID (start with a letter)', 'reales') . '</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">' . __('Amenity label', 'reales') . '</th>
                    <td>
                        <input type="text" size="40" name="amenity_label" id="amenity_label"><br>
                        <p class="help">' . __('This value will be displayed in the interface', 'reales') . '</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">' . __('Amenity icon', 'reales') . '</th>
                    <td>
                        <div class="dropdown">
                            <a class="button button-secondary">' . __('Select an icon', 'reales') . '&nbsp;&nbsp;&nbsp;<span class="fa fa-caret-down"></span></a>
                            <ul class="dropdown-menu iconsMenu"></ul>
                            <input type="hidden" name="amenity_icon" id="amenity_icon" class="iconsField">
                        </div>
                        <div class="dropdown-backdrop"></div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">' . __('Position', 'reales') . '</th>
                    <td>
                        <input type="text" size="4" name="amenity_position" id="amenity_position" value="0">
                    </td>
                </tr>
            </tbody>
        </table>';
        print '<p class="submit"><input type="button" name="add_amenity_btn" id="add_amenity_btn" class="button button-secondary" value="' . __('Add Amenity', 'reales') . '">&nbsp;&nbsp;&nbsp;<span class="fa fa-spin fa-spinner preloader"></span></p>';

        print '<h4>' . __('Amenities List', 'reales') . '</h4>';
        print '<table class="table table-hover" id="amenitiesTable">
            <thead>
                <tr>
                    <th>' . __('Field name', 'reales') . '</th>
                    <th>' . __('Amenity label', 'reales') . '</th>
                    <th>' . __('Amenity icon', 'reales') . '</th>
                    <th>' . __('Position', 'reales') . '</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>';

        $options = get_option('reales_amenity_settings');
        if(is_array($options)) {
            uasort($options, "reales_compare_position");

            foreach ($options as $key => $value) {
                print '<tr>
                    <td><input type="text" name="reales_amenity_settings[' . $key . '][name]" value="' . $value['name'] . '"></td>
                    <td><input type="text" name="reales_amenity_settings[' . $key . '][label]" value="' . $value['label'] . '"></td>
                    <td>
                        <div class="dropdown">
                            <a class="button button-secondary">' . __('Select an icon', 'reales') . '&nbsp;&nbsp;&nbsp;<span class="fa fa-caret-down"></span></a>
                            <ul class="dropdown-menu iconsMenu"></ul>
                            <input type="hidden" name="reales_amenity_settings[' . $key . '][icon]" class="iconsField" value="' . $value['icon'] . '">
                        </div>
                        <div class="dropdown-backdrop"></div>
                    </td>
                    <td><input type="text" size="4" name="reales_amenity_settings[' . $key . '][position]" value="' . $value['position'] . '"></td>
                    <td><a href="javascript:void(0);" data-row="' . $key . '" class="delete-amenity">' . __('Delete', 'reales') . ' <span class="fa fa-spin fa-spinner preloader"></span></a></td>
                </tr>';
            }
        }

        print '</tbody></table>';
    }
endif;

if( !function_exists('reales_add_amenities') ): 
    function reales_add_amenities () {
        check_ajax_referer('add_amenities_ajax_nonce', 'security');
        $name        = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        $label       = isset($_POST['label']) ? sanitize_text_field($_POST['label']) : '';
        $icon        = isset($_POST['icon']) ? sanitize_text_field($_POST['icon']) : '';
        $position    = isset($_POST['position']) ? sanitize_text_field($_POST['position']) : '';

        if($name == '') {
            echo json_encode(array('add'=>false, 'message'=>__('Field ID is mandatory.', 'reales')));
            exit();
        }
        if($label == '') {
            echo json_encode(array('add'=>false, 'message'=>__('Amenity label is mandatory.', 'reales')));
            exit();
        }
        if($icon == '') {
            echo json_encode(array('add'=>false, 'message'=>__('Amenity icon is mandatory.', 'reales')));
            exit();
        }
        if($position == '') {
            echo json_encode(array('add'=>false, 'message'=>__('Position is mandatory.', 'reales')));
            exit();
        }

        $var_name = str_replace(' ', '_', trim($name));
        $var_name = sanitize_key($var_name);

        $reales_amenity_settings                           = get_option('reales_amenity_settings');
        $reales_amenity_settings[$var_name]['name']        = $name;
        $reales_amenity_settings[$var_name]['label']       = $label;
        $reales_amenity_settings[$var_name]['icon']        = $icon;
        $reales_amenity_settings[$var_name]['position']    = $position;

        update_option('reales_amenity_settings', $reales_amenity_settings);

        echo json_encode(array('add'=>true));
        exit();

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_add_amenities', 'reales_add_amenities' );
add_action( 'wp_ajax_reales_add_amenities', 'reales_add_amenities' );

if( !function_exists('reales_delete_amenities') ): 
    function reales_delete_amenities () {
        check_ajax_referer('add_amenities_ajax_nonce', 'security');
        $amenity_name = isset($_POST['amenity_name']) ? sanitize_text_field($_POST['amenity_name']) : '';

        $reales_amenity_settings = get_option('reales_amenity_settings');
        unset($reales_amenity_settings[$amenity_name]);
        update_option('reales_amenity_settings', $reales_amenity_settings);

        echo json_encode(array('delete'=>true));
        exit();

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_delete_amenities', 'reales_delete_amenities' );
add_action( 'wp_ajax_reales_delete_amenities', 'reales_delete_amenities' );
?>
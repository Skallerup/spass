<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if( !function_exists('reales_admin_cities') ): 
    function reales_admin_cities() {
        add_settings_section( 'reales_cities_section', __( 'Cities', 'reales' ), 'reales_cities_section_callback', 'reales_cities_settings' );
    }
endif;

if( !function_exists('reales_cities_section_callback') ): 
    function reales_cities_section_callback() { 
        wp_nonce_field('add_cities_ajax_nonce', 'securityAddCities', true);

        $options = get_option( 'reales_cities_settings' );

        print '<h4>' . __('Add New City', 'reales') . '</h4>';
        print '<table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">' . __('City ID', 'reales') . '</th>
                    <td>
                        <input type="text" size="40" name="city_id" id="city_id">
                        <p class="help">' . __('Give the city an unique ID (start with a letter)', 'reales') . '</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">' . __('City name', 'reales') . '</th>
                    <td>
                        <input type="text" size="40" name="city_name" id="city_name">
                    </td>
                </tr>
                <tr>
                    <th scope="row">' . __('Position', 'reales') . '</th>
                    <td>
                        <input type="text" size="4" name="city_position" id="city_position" value="0">
                    </td>
                </tr>
            </tbody>
        </table>';
        print '<p class="submit"><input type="button" name="add_city_btn" id="add_city_btn" class="button button-secondary" value="' . __('Add City', 'reales') . '">&nbsp;&nbsp;&nbsp;<span class="fa fa-spin fa-spinner preloader"></span></p>';

        print '<h4>' . __('Cities List', 'reales') . '</h4>';
        print '<table class="table table-hover" id="citiesTable">
            <thead>
                <tr>
                    <th>' . __('City ID', 'reales') . '</th>
                    <th>' . __('City name', 'reales') . '</th>
                    <th>' . __('Position', 'reales') . '</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>';

        if(is_array($options)) {
            uasort($options, "reales_compare_position");

            foreach ($options as $key => $value) {
                print '<tr>
                    <td><input type="text" name="reales_cities_settings[' . $key . '][id]" value="' . $value['id'] . '"></td>
                    <td><input type="text" name="reales_cities_settings[' . $key . '][name]" value="' . $value['name'] . '"></td>
                    <td><input type="text" size="4" name="reales_cities_settings[' . $key . '][position]" value="' . $value['position'] . '"></td>
                    <td><a href="javascript:void(0);" data-row="' . $key . '" class="delete-city">' . __('Delete', 'reales') . ' <span class="fa fa-spin fa-spinner preloader"></span></a></td>
                </tr>';
            }
        }

        print '</tbody></table>';
    }
endif;

if( !function_exists('reales_add_cities') ): 
    function reales_add_cities () {
        check_ajax_referer('add_cities_ajax_nonce', 'security');
        $id       = isset($_POST['id']) ? sanitize_text_field($_POST['id']) : '';
        $name     = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        $position = isset($_POST['position']) ? sanitize_text_field($_POST['position']) : '';

        if($id == '') {
            echo json_encode(array('add'=>false, 'message'=>__('City ID is mandatory.', 'reales')));
            exit();
        }
        if($name == '') {
            echo json_encode(array('add'=>false, 'message'=>__('City name is mandatory.', 'reales')));
            exit();
        }
        if($position == '') {
            echo json_encode(array('add'=>false, 'message'=>__('Position is mandatory.', 'reales')));
            exit();
        }

        $var_name = str_replace(' ', '_', trim($id));
        $var_name = sanitize_key($var_name);

        $reales_cities_settings                        = get_option('reales_cities_settings');
        $reales_cities_settings[$var_name]['id']       = $id;
        $reales_cities_settings[$var_name]['name']     = $name;
        $reales_cities_settings[$var_name]['position'] = $position;

        update_option('reales_cities_settings', $reales_cities_settings);

        echo json_encode(array('add'=>true));
        exit();

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_add_cities', 'reales_add_cities' );
add_action( 'wp_ajax_reales_add_cities', 'reales_add_cities' );

if( !function_exists('reales_delete_cities') ): 
    function reales_delete_cities () {
        check_ajax_referer('add_cities_ajax_nonce', 'security');
        $city_id = isset($_POST['city_id']) ? sanitize_text_field($_POST['city_id']) : '';

        $reales_cities_settings = get_option('reales_cities_settings');
        unset($reales_cities_settings[$city_id]);
        update_option('reales_cities_settings', $reales_cities_settings);

        echo json_encode(array('delete'=>true));
        exit();

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_delete_cities', 'reales_delete_cities' );
add_action( 'wp_ajax_reales_delete_cities', 'reales_delete_cities' );
?>
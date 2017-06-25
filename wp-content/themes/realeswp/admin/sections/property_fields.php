<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if( !function_exists('reales_admin_prop_fields') ): 
    function reales_admin_prop_fields() {
        add_settings_section( 'reales_prop_fields_section', __( 'Property Fields', 'reales' ), 'reales_prop_fields_section_callback', 'reales_prop_fields_settings' );
        add_settings_field( 'reales_p_id_field', __( 'ID', 'reales' ), 'reales_p_id_field_render', 'reales_prop_fields_settings', 'reales_prop_fields_section' );
        add_settings_field( 'reales_p_price_field', __( 'Price', 'reales' ), 'reales_p_price_field_render', 'reales_prop_fields_settings', 'reales_prop_fields_section' );
        add_settings_field( 'reales_p_description_field', __( 'Description', 'reales' ), 'reales_p_description_field_render', 'reales_prop_fields_settings', 'reales_prop_fields_section' );
        add_settings_field( 'reales_p_category_field', __( 'Category', 'reales' ), 'reales_p_category_field_render', 'reales_prop_fields_settings', 'reales_prop_fields_section' );
        add_settings_field( 'reales_p_type_field', __( 'Type', 'reales' ), 'reales_p_type_field_render', 'reales_prop_fields_settings', 'reales_prop_fields_section' );
        add_settings_field( 'reales_p_city_field', __( 'City', 'reales' ), 'reales_p_city_field_render', 'reales_prop_fields_settings', 'reales_prop_fields_section' );
        add_settings_field( 'reales_p_coordinates_field', __( 'Coordinates', 'reales' ), 'reales_p_coordinates_field_render', 'reales_prop_fields_settings', 'reales_prop_fields_section' );
        add_settings_field( 'reales_p_address_field', __( 'Address', 'reales' ), 'reales_p_address_field_render', 'reales_prop_fields_settings', 'reales_prop_fields_section' );
        add_settings_field( 'reales_p_neighborhood_field', __( 'Neighborhood', 'reales' ), 'reales_p_neighborhood_field_render', 'reales_prop_fields_settings', 'reales_prop_fields_section' );
        add_settings_field( 'reales_p_zip_field', __( 'Zip Code', 'reales' ), 'reales_p_zip_field_render', 'reales_prop_fields_settings', 'reales_prop_fields_section' );
        add_settings_field( 'reales_p_state_field', __( 'County/State', 'reales' ), 'reales_p_state_field_render', 'reales_prop_fields_settings', 'reales_prop_fields_section' );
        add_settings_field( 'reales_p_country_field', __( 'Country', 'reales' ), 'reales_p_country_field_render', 'reales_prop_fields_settings', 'reales_prop_fields_section' );
        add_settings_field( 'reales_p_area_field', __( 'Area', 'reales' ), 'reales_p_area_field_render', 'reales_prop_fields_settings', 'reales_prop_fields_section' );
        add_settings_field( 'reales_p_bedrooms_field', __( 'Bedrooms', 'reales' ), 'reales_p_bedrooms_field_render', 'reales_prop_fields_settings', 'reales_prop_fields_section' );
        add_settings_field( 'reales_p_bathrooms_field', __( 'Bathrooms', 'reales' ), 'reales_p_bathrooms_field_render', 'reales_prop_fields_settings', 'reales_prop_fields_section' );
        add_settings_field( 'reales_p_plans_field', __( 'Floor Plans', 'reales' ), 'reales_p_plans_field_render', 'reales_prop_fields_settings', 'reales_prop_fields_section' );
        add_settings_field( 'reales_p_video_field', __( 'Video', 'reales' ), 'reales_p_video_field_render', 'reales_prop_fields_settings', 'reales_prop_fields_section' );
    }
endif;

if( !function_exists('reales_prop_fields_section_callback') ): 
    function reales_prop_fields_section_callback() { 
        echo '';
    }
endif;

if( !function_exists('reales_p_id_field_render') ): 
    function reales_p_id_field_render() { 
        $options = get_option( 'reales_prop_fields_settings' );

        $value_select = '<select id="reales_prop_fields_settings[reales_p_id_field]" name="reales_prop_fields_settings[reales_p_id_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_p_id_field']) && $options['reales_p_id_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_p_id_field']) && $options['reales_p_id_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_p_price_field_render') ): 
    function reales_p_price_field_render() { 
        $options = get_option( 'reales_prop_fields_settings' );

        $value_select = '<select id="reales_prop_fields_settings[reales_p_price_field]" name="reales_prop_fields_settings[reales_p_price_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_p_price_field']) && $options['reales_p_price_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_p_price_field']) && $options['reales_p_price_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;

        $r_value_select = '<select id="reales_prop_fields_settings[reales_p_price_r_field]" name="reales_prop_fields_settings[reales_p_price_r_field]">';
        $r_value_select .= '<option value="no"';
        if(isset($options['reales_p_price_r_field']) && $options['reales_p_price_r_field'] == 'no') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('not required', 'reales') . '</option>';
        $r_value_select .= '<option value="required"';
        if(isset($options['reales_p_price_r_field']) && $options['reales_p_price_r_field'] == 'required') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('required', 'reales') . '</option>';
        $r_value_select .= '</select>';

        print $r_value_select;
    }
endif;

if( !function_exists('reales_p_description_field_render') ): 
    function reales_p_description_field_render() { 
        $options = get_option( 'reales_prop_fields_settings' );

        $value_select = '<select id="reales_prop_fields_settings[reales_p_description_field]" name="reales_prop_fields_settings[reales_p_description_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_p_description_field']) && $options['reales_p_description_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_p_description_field']) && $options['reales_p_description_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;

        $r_value_select = '<select id="reales_prop_fields_settings[reales_p_description_r_field]" name="reales_prop_fields_settings[reales_p_description_r_field]">';
        $r_value_select .= '<option value="no"';
        if(isset($options['reales_p_description_r_field']) && $options['reales_p_description_r_field'] == 'no') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('not required', 'reales') . '</option>';
        $r_value_select .= '<option value="required"';
        if(isset($options['reales_p_description_r_field']) && $options['reales_p_description_r_field'] == 'required') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('required', 'reales') . '</option>';
        $r_value_select .= '</select>';

        print $r_value_select;
    }
endif;

if( !function_exists('reales_p_category_field_render') ): 
    function reales_p_category_field_render() { 
        $options = get_option( 'reales_prop_fields_settings' );

        $value_select = '<select id="reales_prop_fields_settings[reales_p_category_field]" name="reales_prop_fields_settings[reales_p_category_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_p_category_field']) && $options['reales_p_category_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_p_category_field']) && $options['reales_p_category_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;

        $r_value_select = '<select id="reales_prop_fields_settings[reales_p_category_r_field]" name="reales_prop_fields_settings[reales_p_category_r_field]">';
        $r_value_select .= '<option value="no"';
        if(isset($options['reales_p_category_r_field']) && $options['reales_p_category_r_field'] == 'no') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('not required', 'reales') . '</option>';
        $r_value_select .= '<option value="required"';
        if(isset($options['reales_p_category_r_field']) && $options['reales_p_category_r_field'] == 'required') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('required', 'reales') . '</option>';
        $r_value_select .= '</select>';

        print $r_value_select;
    }
endif;

if( !function_exists('reales_p_type_field_render') ): 
    function reales_p_type_field_render() { 
        $options = get_option( 'reales_prop_fields_settings' );

        $value_select = '<select id="reales_prop_fields_settings[reales_p_type_field]" name="reales_prop_fields_settings[reales_p_type_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_p_type_field']) && $options['reales_p_type_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_p_type_field']) && $options['reales_p_type_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;

        $r_value_select = '<select id="reales_prop_fields_settings[reales_p_type_r_field]" name="reales_prop_fields_settings[reales_p_type_r_field]">';
        $r_value_select .= '<option value="no"';
        if(isset($options['reales_p_type_r_field']) && $options['reales_p_type_r_field'] == 'no') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('not required', 'reales') . '</option>';
        $r_value_select .= '<option value="required"';
        if(isset($options['reales_p_type_r_field']) && $options['reales_p_type_r_field'] == 'required') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('required', 'reales') . '</option>';
        $r_value_select .= '</select>';

        print $r_value_select;
    }
endif;

if( !function_exists('reales_p_city_field_render') ): 
    function reales_p_city_field_render() { 
        $options = get_option( 'reales_prop_fields_settings' );

        $value_select = '<select id="reales_prop_fields_settings[reales_p_city_field]" name="reales_prop_fields_settings[reales_p_city_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_p_city_field']) && $options['reales_p_city_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_p_city_field']) && $options['reales_p_city_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;

        $r_value_select = '<select id="reales_prop_fields_settings[reales_p_city_r_field]" name="reales_prop_fields_settings[reales_p_city_r_field]">';
        $r_value_select .= '<option value="no"';
        if(isset($options['reales_p_city_r_field']) && $options['reales_p_city_r_field'] == 'no') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('not required', 'reales') . '</option>';
        $r_value_select .= '<option value="required"';
        if(isset($options['reales_p_city_r_field']) && $options['reales_p_city_r_field'] == 'required') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('required', 'reales') . '</option>';
        $r_value_select .= '</select>';

        print $r_value_select;

        $t_value_select = '<select id="reales_prop_fields_settings[reales_p_city_t_field]" name="reales_prop_fields_settings[reales_p_city_t_field]">';
        $t_value_select .= '<option value="google"';
        if(isset($options['reales_p_city_t_field']) && $options['reales_p_city_t_field'] == 'google') {
            $t_value_select .= 'selected="selected"';
        }
        $t_value_select .= '>' . __('google autocomplete', 'reales') . '</option>';
        $t_value_select .= '<option value="list"';
        if(isset($options['reales_p_city_t_field']) && $options['reales_p_city_t_field'] == 'list') {
            $t_value_select .= 'selected="selected"';
        }
        $t_value_select .= '>' . __('custom list', 'reales') . '</option>';
        $t_value_select .= '</select>';

        print $t_value_select;
    }
endif;

if( !function_exists('reales_p_coordinates_field_render') ): 
    function reales_p_coordinates_field_render() { 
        $options = get_option( 'reales_prop_fields_settings' );

        $value_select = '<select id="reales_prop_fields_settings[reales_p_coordinates_field]" name="reales_prop_fields_settings[reales_p_coordinates_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_p_coordinates_field']) && $options['reales_p_coordinates_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_p_coordinates_field']) && $options['reales_p_coordinates_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;

        $r_value_select = '<select id="reales_prop_fields_settings[reales_p_coordinates_r_field]" name="reales_prop_fields_settings[reales_p_coordinates_r_field]">';
        $r_value_select .= '<option value="no"';
        if(isset($options['reales_p_coordinates_r_field']) && $options['reales_p_coordinates_r_field'] == 'no') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('not required', 'reales') . '</option>';
        $r_value_select .= '<option value="required"';
        if(isset($options['reales_p_coordinates_r_field']) && $options['reales_p_coordinates_r_field'] == 'required') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('required', 'reales') . '</option>';
        $r_value_select .= '</select>';

        print $r_value_select;
    }
endif;

if( !function_exists('reales_p_address_field_render') ): 
    function reales_p_address_field_render() { 
        $options = get_option( 'reales_prop_fields_settings' );

        $value_select = '<select id="reales_prop_fields_settings[reales_p_address_field]" name="reales_prop_fields_settings[reales_p_address_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_p_address_field']) && $options['reales_p_address_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_p_address_field']) && $options['reales_p_address_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;

        $r_value_select = '<select id="reales_prop_fields_settings[reales_p_address_r_field]" name="reales_prop_fields_settings[reales_p_address_r_field]">';
        $r_value_select .= '<option value="no"';
        if(isset($options['reales_p_address_r_field']) && $options['reales_p_address_r_field'] == 'no') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('not required', 'reales') . '</option>';
        $r_value_select .= '<option value="required"';
        if(isset($options['reales_p_address_r_field']) && $options['reales_p_address_r_field'] == 'required') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('required', 'reales') . '</option>';
        $r_value_select .= '</select>';

        print $r_value_select;
    }
endif;

if( !function_exists('reales_p_neighborhood_field_render') ): 
    function reales_p_neighborhood_field_render() { 
        $options = get_option( 'reales_prop_fields_settings' );

        $value_select = '<select id="reales_prop_fields_settings[reales_p_neighborhood_field]" name="reales_prop_fields_settings[reales_p_neighborhood_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_p_neighborhood_field']) && $options['reales_p_neighborhood_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_p_neighborhood_field']) && $options['reales_p_neighborhood_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;

        $r_value_select = '<select id="reales_prop_fields_settings[reales_p_neighborhood_r_field]" name="reales_prop_fields_settings[reales_p_neighborhood_r_field]">';
        $r_value_select .= '<option value="no"';
        if(isset($options['reales_p_neighborhood_r_field']) && $options['reales_p_neighborhood_r_field'] == 'no') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('not required', 'reales') . '</option>';
        $r_value_select .= '<option value="required"';
        if(isset($options['reales_p_neighborhood_r_field']) && $options['reales_p_neighborhood_r_field'] == 'required') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('required', 'reales') . '</option>';
        $r_value_select .= '</select>';

        print $r_value_select;
    }
endif;

if( !function_exists('reales_p_zip_field_render') ): 
    function reales_p_zip_field_render() { 
        $options = get_option( 'reales_prop_fields_settings' );

        $value_select = '<select id="reales_prop_fields_settings[reales_p_zip_field]" name="reales_prop_fields_settings[reales_p_zip_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_p_zip_field']) && $options['reales_p_zip_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_p_zip_field']) && $options['reales_p_zip_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;

        $r_value_select = '<select id="reales_prop_fields_settings[reales_p_zip_r_field]" name="reales_prop_fields_settings[reales_p_zip_r_field]">';
        $r_value_select .= '<option value="no"';
        if(isset($options['reales_p_zip_r_field']) && $options['reales_p_zip_r_field'] == 'no') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('not required', 'reales') . '</option>';
        $r_value_select .= '<option value="required"';
        if(isset($options['reales_p_zip_r_field']) && $options['reales_p_zip_r_field'] == 'required') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('required', 'reales') . '</option>';
        $r_value_select .= '</select>';

        print $r_value_select;
    }
endif;

if( !function_exists('reales_p_state_field_render') ): 
    function reales_p_state_field_render() { 
        $options = get_option( 'reales_prop_fields_settings' );

        $value_select = '<select id="reales_prop_fields_settings[reales_p_state_field]" name="reales_prop_fields_settings[reales_p_state_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_p_state_field']) && $options['reales_p_state_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_p_state_field']) && $options['reales_p_state_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;

        $r_value_select = '<select id="reales_prop_fields_settings[reales_p_state_r_field]" name="reales_prop_fields_settings[reales_p_state_r_field]">';
        $r_value_select .= '<option value="no"';
        if(isset($options['reales_p_state_r_field']) && $options['reales_p_state_r_field'] == 'no') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('not required', 'reales') . '</option>';
        $r_value_select .= '<option value="required"';
        if(isset($options['reales_p_state_r_field']) && $options['reales_p_state_r_field'] == 'required') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('required', 'reales') . '</option>';
        $r_value_select .= '</select>';

        print $r_value_select;
    }
endif;

if( !function_exists('reales_p_country_field_render') ): 
    function reales_p_country_field_render() { 
        $options = get_option( 'reales_prop_fields_settings' );

        $value_select = '<select id="reales_prop_fields_settings[reales_p_country_field]" name="reales_prop_fields_settings[reales_p_country_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_p_country_field']) && $options['reales_p_country_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_p_country_field']) && $options['reales_p_country_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;

        $r_value_select = '<select id="reales_prop_fields_settings[reales_p_country_r_field]" name="reales_prop_fields_settings[reales_p_country_r_field]">';
        $r_value_select .= '<option value="no"';
        if(isset($options['reales_p_country_r_field']) && $options['reales_p_country_r_field'] == 'no') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('not required', 'reales') . '</option>';
        $r_value_select .= '<option value="required"';
        if(isset($options['reales_p_country_r_field']) && $options['reales_p_country_r_field'] == 'required') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('required', 'reales') . '</option>';
        $r_value_select .= '</select>';

        print $r_value_select;
    }
endif;

if( !function_exists('reales_p_area_field_render') ): 
    function reales_p_area_field_render() { 
        $options = get_option( 'reales_prop_fields_settings' );

        $value_select = '<select id="reales_prop_fields_settings[reales_p_area_field]" name="reales_prop_fields_settings[reales_p_area_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_p_area_field']) && $options['reales_p_area_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_p_area_field']) && $options['reales_p_area_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;

        $r_value_select = '<select id="reales_prop_fields_settings[reales_p_area_r_field]" name="reales_prop_fields_settings[reales_p_area_r_field]">';
        $r_value_select .= '<option value="no"';
        if(isset($options['reales_p_area_r_field']) && $options['reales_p_area_r_field'] == 'no') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('not required', 'reales') . '</option>';
        $r_value_select .= '<option value="required"';
        if(isset($options['reales_p_area_r_field']) && $options['reales_p_area_r_field'] == 'required') {
            $r_value_select .= 'selected="selected"';
        }
        $r_value_select .= '>' . __('required', 'reales') . '</option>';
        $r_value_select .= '</select>';

        print $r_value_select;
    }
endif;

if( !function_exists('reales_p_bedrooms_field_render') ): 
    function reales_p_bedrooms_field_render() { 
        $options = get_option( 'reales_prop_fields_settings' );

        $value_select = '<select id="reales_prop_fields_settings[reales_p_bedrooms_field]" name="reales_prop_fields_settings[reales_p_bedrooms_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_p_bedrooms_field']) && $options['reales_p_bedrooms_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_p_bedrooms_field']) && $options['reales_p_bedrooms_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_p_bathrooms_field_render') ): 
    function reales_p_bathrooms_field_render() { 
        $options = get_option( 'reales_prop_fields_settings' );

        $value_select = '<select id="reales_prop_fields_settings[reales_p_bathrooms_field]" name="reales_prop_fields_settings[reales_p_bathrooms_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_p_bathrooms_field']) && $options['reales_p_bathrooms_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_p_bathrooms_field']) && $options['reales_p_bathrooms_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_p_plans_field_render') ): 
    function reales_p_plans_field_render() { 
        $options = get_option( 'reales_prop_fields_settings' );

        $value_select = '<select id="reales_prop_fields_settings[reales_p_plans_field]" name="reales_prop_fields_settings[reales_p_plans_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_p_plans_field']) && $options['reales_p_plans_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_p_plans_field']) && $options['reales_p_plans_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_p_video_field_render') ): 
    function reales_p_video_field_render() { 
        $options = get_option( 'reales_prop_fields_settings' );

        $value_select = '<select id="reales_prop_fields_settings[reales_p_video_field]" name="reales_prop_fields_settings[reales_p_video_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_p_video_field']) && $options['reales_p_video_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_p_video_field']) && $options['reales_p_video_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

?>
<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if( !function_exists('reales_admin_search') ): 
    function reales_admin_search() {
        add_settings_section( 'reales_search_section', __( 'Search Area Fields', 'reales' ), 'reales_search_section_callback', 'reales_search_settings' );
        add_settings_field( 'reales_s_id_field', __( 'ID', 'reales' ), 'reales_s_id_field_render', 'reales_search_settings', 'reales_search_section' );
        add_settings_field( 'reales_s_keywords_field', __( 'Keywords', 'reales' ), 'reales_s_keywords_field_render', 'reales_search_settings', 'reales_search_section' );
        add_settings_field( 'reales_s_country_field', __( 'Country', 'reales' ), 'reales_s_country_field_render', 'reales_search_settings', 'reales_search_section' );
        add_settings_field( 'reales_s_state_field', __( 'County/State', 'reales' ), 'reales_s_state_field_render', 'reales_search_settings', 'reales_search_section' );
        add_settings_field( 'reales_s_city_field', __( 'City', 'reales' ), 'reales_s_city_field_render', 'reales_search_settings', 'reales_search_section' );
        add_settings_field( 'reales_s_neighborhood_field', __( 'Neighborhood', 'reales' ), 'reales_s_neighborhood_field_render', 'reales_search_settings', 'reales_search_section' );
        add_settings_field( 'reales_s_category_field', __( 'Category', 'reales' ), 'reales_s_category_field_render', 'reales_search_settings', 'reales_search_section' );
        add_settings_field( 'reales_s_type_field', __( 'Type', 'reales' ), 'reales_s_type_field_render', 'reales_search_settings', 'reales_search_section' );
        add_settings_field( 'reales_s_price_field', __( 'Price', 'reales' ), 'reales_s_price_field_render', 'reales_search_settings', 'reales_search_section' );
        add_settings_field( 'reales_s_area_field', __( 'Area', 'reales' ), 'reales_s_area_field_render', 'reales_search_settings', 'reales_search_section' );
        add_settings_field( 'reales_s_bedrooms_field', __( 'Bedrooms', 'reales' ), 'reales_s_bedrooms_field_render', 'reales_search_settings', 'reales_search_section' );
        add_settings_field( 'reales_s_bathrooms_field', __( 'Bathrooms', 'reales' ), 'reales_s_bathrooms_field_render', 'reales_search_settings', 'reales_search_section' );
    }
endif;

if( !function_exists('reales_search_section_callback') ): 
    function reales_search_section_callback() { 
        echo '';
    }
endif;

if( !function_exists('reales_s_id_field_render') ): 
    function reales_s_id_field_render() { 
        $options = get_option( 'reales_search_settings' );

        $value_select = '<select id="reales_search_settings[reales_s_id_field]" name="reales_search_settings[reales_s_id_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_s_id_field']) && $options['reales_s_id_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_s_id_field']) && $options['reales_s_id_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_s_keywords_field_render') ): 
    function reales_s_keywords_field_render() { 
        $options = get_option( 'reales_search_settings' );

        $value_select = '<select id="reales_search_settings[reales_s_keywords_field]" name="reales_search_settings[reales_s_keywords_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_s_keywords_field']) && $options['reales_s_keywords_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_s_keywords_field']) && $options['reales_s_keywords_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_s_country_field_render') ): 
    function reales_s_country_field_render() { 
        $options = get_option( 'reales_search_settings' );

        $value_select = '<select id="reales_search_settings[reales_s_country_field]" name="reales_search_settings[reales_s_country_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_s_country_field']) && $options['reales_s_country_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_s_country_field']) && $options['reales_s_country_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_s_state_field_render') ): 
    function reales_s_state_field_render() { 
        $options = get_option( 'reales_search_settings' );

        $value_select = '<select id="reales_search_settings[reales_s_state_field]" name="reales_search_settings[reales_s_state_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_s_state_field']) && $options['reales_s_state_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_s_state_field']) && $options['reales_s_state_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_s_city_field_render') ): 
    function reales_s_city_field_render() { 
        $options = get_option( 'reales_search_settings' );

        $value_select = '<select id="reales_search_settings[reales_s_city_field]" name="reales_search_settings[reales_s_city_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_s_city_field']) && $options['reales_s_city_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_s_city_field']) && $options['reales_s_city_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_s_neighborhood_field_render') ): 
    function reales_s_neighborhood_field_render() { 
        $options = get_option( 'reales_search_settings' );

        $value_select = '<select id="reales_search_settings[reales_s_neighborhood_field]" name="reales_search_settings[reales_s_neighborhood_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_s_neighborhood_field']) && $options['reales_s_neighborhood_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_s_neighborhood_field']) && $options['reales_s_neighborhood_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_s_category_field_render') ): 
    function reales_s_category_field_render() { 
        $options = get_option( 'reales_search_settings' );

        $value_select = '<select id="reales_search_settings[reales_s_category_field]" name="reales_search_settings[reales_s_category_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_s_category_field']) && $options['reales_s_category_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_s_category_field']) && $options['reales_s_category_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_s_type_field_render') ): 
    function reales_s_type_field_render() { 
        $options = get_option( 'reales_search_settings' );

        $value_select = '<select id="reales_search_settings[reales_s_type_field]" name="reales_search_settings[reales_s_type_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_s_type_field']) && $options['reales_s_type_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_s_type_field']) && $options['reales_s_type_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_s_price_field_render') ): 
    function reales_s_price_field_render() { 
        $options = get_option( 'reales_search_settings' );

        $value_select = '<select id="reales_search_settings[reales_s_price_field]" name="reales_search_settings[reales_s_price_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_s_price_field']) && $options['reales_s_price_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_s_price_field']) && $options['reales_s_price_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_s_area_field_render') ): 
    function reales_s_area_field_render() { 
        $options = get_option( 'reales_search_settings' );

        $value_select = '<select id="reales_search_settings[reales_s_area_field]" name="reales_search_settings[reales_s_area_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_s_area_field']) && $options['reales_s_area_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_s_area_field']) && $options['reales_s_area_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_s_bedrooms_field_render') ): 
    function reales_s_bedrooms_field_render() { 
        $options = get_option( 'reales_search_settings' );

        $value_select = '<select id="reales_search_settings[reales_s_bedrooms_field]" name="reales_search_settings[reales_s_bedrooms_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_s_bedrooms_field']) && $options['reales_s_bedrooms_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_s_bedrooms_field']) && $options['reales_s_bedrooms_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_s_bathrooms_field_render') ): 
    function reales_s_bathrooms_field_render() { 
        $options = get_option( 'reales_search_settings' );

        $value_select = '<select id="reales_search_settings[reales_s_bathrooms_field]" name="reales_search_settings[reales_s_bathrooms_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_s_bathrooms_field']) && $options['reales_s_bathrooms_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_s_bathrooms_field']) && $options['reales_s_bathrooms_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

?>
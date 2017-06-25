<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if( !function_exists('reales_admin_filter') ): 
    function reales_admin_filter() {
        add_settings_section( 'reales_filter_section', __( 'Filter Area Fields', 'reales' ), 'reales_filter_section_callback', 'reales_filter_settings' );
        add_settings_field( 'reales_f_id_field', __( 'ID', 'reales' ), 'reales_f_id_field_render', 'reales_filter_settings', 'reales_filter_section' );
        add_settings_field( 'reales_f_keywords_field', __( 'Keywords', 'reales' ), 'reales_f_keywords_field_render', 'reales_filter_settings', 'reales_filter_section' );
        add_settings_field( 'reales_f_country_field', __( 'Country', 'reales' ), 'reales_f_country_field_render', 'reales_filter_settings', 'reales_filter_section' );
        add_settings_field( 'reales_f_state_field', __( 'County/State', 'reales' ), 'reales_f_state_field_render', 'reales_filter_settings', 'reales_filter_section' );
        add_settings_field( 'reales_f_city_field', __( 'City', 'reales' ), 'reales_f_city_field_render', 'reales_filter_settings', 'reales_filter_section' );
        add_settings_field( 'reales_f_neighborhood_field', __( 'Neighborhood', 'reales' ), 'reales_f_neighborhood_field_render', 'reales_filter_settings', 'reales_filter_section' );
        add_settings_field( 'reales_f_category_field', __( 'Category', 'reales' ), 'reales_f_category_field_render', 'reales_filter_settings', 'reales_filter_section' );
        add_settings_field( 'reales_f_type_field', __( 'Type', 'reales' ), 'reales_f_type_field_render', 'reales_filter_settings', 'reales_filter_section' );
        add_settings_field( 'reales_f_price_field', __( 'Price', 'reales' ), 'reales_f_price_field_render', 'reales_filter_settings', 'reales_filter_section' );
        add_settings_field( 'reales_f_area_field', __( 'Area', 'reales' ), 'reales_f_area_field_render', 'reales_filter_settings', 'reales_filter_section' );
        add_settings_field( 'reales_f_bedrooms_field', __( 'Bedrooms', 'reales' ), 'reales_f_bedrooms_field_render', 'reales_filter_settings', 'reales_filter_section' );
        add_settings_field( 'reales_f_bathrooms_field', __( 'Bathrooms', 'reales' ), 'reales_f_bathrooms_field_render', 'reales_filter_settings', 'reales_filter_section' );
        add_settings_field( 'reales_f_amenities_field', __( 'Amenities', 'reales' ), 'reales_f_amenities_field_render', 'reales_filter_settings', 'reales_filter_section' );
    }
endif;

if( !function_exists('reales_filter_section_callback') ): 
    function reales_filter_section_callback() { 
        echo '';
    }
endif;

if( !function_exists('reales_f_id_field_render') ): 
    function reales_f_id_field_render() { 
        $options = get_option( 'reales_filter_settings' );

        $value_select = '<select id="reales_filter_settings[reales_f_id_field]" name="reales_filter_settings[reales_f_id_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_f_id_field']) && $options['reales_f_id_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_f_id_field']) && $options['reales_f_id_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_f_keywords_field_render') ): 
    function reales_f_keywords_field_render() { 
        $options = get_option( 'reales_filter_settings' );

        $value_select = '<select id="reales_filter_settings[reales_f_keywords_field]" name="reales_filter_settings[reales_f_keywords_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_f_keywords_field']) && $options['reales_f_keywords_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_f_keywords_field']) && $options['reales_f_keywords_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_f_country_field_render') ): 
    function reales_f_country_field_render() { 
        $options = get_option( 'reales_filter_settings' );

        $value_select = '<select id="reales_filter_settings[reales_f_country_field]" name="reales_filter_settings[reales_f_country_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_f_country_field']) && $options['reales_f_country_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_f_country_field']) && $options['reales_f_country_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_f_state_field_render') ): 
    function reales_f_state_field_render() { 
        $options = get_option( 'reales_filter_settings' );

        $value_select = '<select id="reales_filter_settings[reales_f_state_field]" name="reales_filter_settings[reales_f_state_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_f_state_field']) && $options['reales_f_state_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_f_state_field']) && $options['reales_f_state_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_f_city_field_render') ): 
    function reales_f_city_field_render() { 
        $options = get_option( 'reales_filter_settings' );

        $value_select = '<select id="reales_filter_settings[reales_f_city_field]" name="reales_filter_settings[reales_f_city_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_f_city_field']) && $options['reales_f_city_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_f_city_field']) && $options['reales_f_city_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;

        ?>
        <label style="display: inline-block; margin-left: 20px;">
            <input type="checkbox" name="reales_filter_settings[reales_h_city_field]" <?php if(isset($options['reales_h_city_field'])) { checked( $options['reales_h_city_field'], 1 ); } ?> value="1">
            <?php echo __('Show in header', 'reales'); ?>
        </label>
        <?php
    }
endif;

if( !function_exists('reales_f_neighborhood_field_render') ): 
    function reales_f_neighborhood_field_render() { 
        $options = get_option( 'reales_filter_settings' );

        $value_select = '<select id="reales_filter_settings[reales_f_neighborhood_field]" name="reales_filter_settings[reales_f_neighborhood_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_f_neighborhood_field']) && $options['reales_f_neighborhood_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_f_neighborhood_field']) && $options['reales_f_neighborhood_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_f_category_field_render') ): 
    function reales_f_category_field_render() { 
        $options = get_option( 'reales_filter_settings' );

        $value_select = '<select id="reales_filte_settings[reales_f_category_field]" name="reales_filter_settings[reales_f_category_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_f_category_field']) && $options['reales_f_category_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_f_category_field']) && $options['reales_f_category_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_f_type_field_render') ): 
    function reales_f_type_field_render() { 
        $options = get_option( 'reales_filter_settings' );

        $value_select = '<select id="reales_filter_settings[reales_f_type_field]" name="reales_filter_settings[reales_f_type_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_f_type_field']) && $options['reales_f_type_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_f_type_field']) && $options['reales_f_type_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_f_price_field_render') ): 
    function reales_f_price_field_render() { 
        $options = get_option( 'reales_filter_settings' );

        $value_select = '<select id="reales_filter_settings[reales_f_price_field]" name="reales_filter_settings[reales_f_price_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_f_price_field']) && $options['reales_f_price_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_f_price_field']) && $options['reales_f_price_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_f_area_field_render') ): 
    function reales_f_area_field_render() { 
        $options = get_option( 'reales_filter_settings' );

        $value_select = '<select id="reales_filter_settings[reales_f_area_field]" name="reales_filter_settings[reales_f_area_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_f_area_field']) && $options['reales_f_area_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_f_area_field']) && $options['reales_f_area_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_f_bedrooms_field_render') ): 
    function reales_f_bedrooms_field_render() { 
        $options = get_option( 'reales_filter_settings' );

        $value_select = '<select id="reales_filter_settings[reales_f_bedrooms_field]" name="reales_filter_settings[reales_f_bedrooms_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_f_bedrooms_field']) && $options['reales_f_bedrooms_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_f_bedrooms_field']) && $options['reales_f_bedrooms_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_f_bathrooms_field_render') ): 
    function reales_f_bathrooms_field_render() { 
        $options = get_option( 'reales_filter_settings' );

        $value_select = '<select id="reales_filter_settings[reales_f_bathrooms_field]" name="reales_filter_settings[reales_f_bathrooms_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_f_bathrooms_field']) && $options['reales_f_bathrooms_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_f_bathrooms_field']) && $options['reales_f_bathrooms_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_f_amenities_field_render') ): 
    function reales_f_amenities_field_render() { 
        $options = get_option( 'reales_filter_settings' );

        $value_select = '<select id="reales_filter_settings[reales_f_amenities_field]" name="reales_filter_settings[reales_f_amenities_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_f_amenities_field']) && $options['reales_f_amenities_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="enabled"';
        if(isset($options['reales_f_amenities_field']) && $options['reales_f_amenities_field'] == 'enabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('enabled', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

?>
<?php
/**
 * Featured properties shortcode
 */
if( !function_exists('reales_single_property_shortcode') ): 
    function reales_single_property_shortcode($attrs, $content = null) {
        extract(shortcode_atts(array(
            'title' => 'Single Property'
        ), $attrs));

        $post_id  = isset($attrs['id']) ? $attrs['id'] : 0;
        $position = isset($attrs['position']) ? $attrs['position'] : 'right';

        $post = get_post($post_id);

        $reales_general_settings     = get_option('reales_general_settings');
        $type                        = wp_get_post_terms($post->ID, 'property_type_category');
        $category                    = wp_get_post_terms($post->ID, 'property_category');
        $address                     = get_post_meta($post->ID, 'property_address', true);
        $city                        = get_post_meta($post->ID, 'property_city', true);
        $state                       = get_post_meta($post->ID, 'property_state', true);
        $neighborhood                = get_post_meta($post->ID, 'property_neighborhood', true);
        $zip                         = get_post_meta($post->ID, 'property_zip', true);
        $country                     = get_post_meta($post->ID, 'property_country', true);
        $bedrooms                    = get_post_meta($post->ID, 'property_bedrooms', true);
        $bathrooms                   = get_post_meta($post->ID, 'property_bathrooms', true);
        $area                        = get_post_meta($post->ID, 'property_area', true);
        $unit                        = isset($reales_general_settings['reales_unit_field']) ? $reales_general_settings['reales_unit_field'] : '';
        $gallery                     = get_post_meta($post->ID, 'property_gallery', true);
        $images                      = explode("~~~", $gallery);
        $currency                    = isset($reales_general_settings['reales_currency_symbol_field']) ? $reales_general_settings['reales_currency_symbol_field'] : '';
        $currency_pos                = isset($reales_general_settings['reales_currency_symbol_pos_field']) ? $reales_general_settings['reales_currency_symbol_pos_field'] : '';
        $price_label                 = get_post_meta($post->ID, 'property_price_label', true);
        $reales_prop_fields_settings = get_option('reales_prop_fields_settings');
        $p_city_t                    = isset($reales_prop_fields_settings['reales_p_city_t_field']) ? $reales_prop_fields_settings['reales_p_city_t_field'] : '';

        $return_string = '<h2 class="centered osLight">' . esc_html($title) . '</h2>';
        $return_string .= '<div class="pb40">';
        $return_string .= '<div class="singlePropertyShort">';
        if($position == 'left') {
            $return_string .= '<div class="spsImage left">';
        } else {
            $return_string .= '<div class="spsImage right">';
        }
        $return_string .= '<img src="' . esc_url($images[1]) . '" alt="' . esc_attr($post->post_title) . '" class="scale" data-scale="best-fill" data-align="center">';

        $return_string .= '<div class="spsPrice">';
        $locale = isset($reales_general_settings['reales_locale_field']) ? $reales_general_settings['reales_locale_field'] : '';
        $decimals = isset($reales_general_settings['reales_decimals_field']) ? $reales_general_settings['reales_decimals_field'] : '';
        $price = get_post_meta($post->ID, 'property_price', true);
        setlocale(LC_MONETARY, $locale);
        if(is_numeric($price)) {
            if($decimals == 1) {
                $price = money_format('%!i', $price);
            } else {
                $price = money_format('%!.0i', $price);
            }
        } else {
            $price_label = '';
            $currency = '';
        }
        if($currency_pos == 'before') {
            $return_string .= '<div class="osLight"><span>' . esc_html($currency) . esc_html($price) . '<small style="font-size:14px;">' . esc_html($price_label) . '</small></span></div>';
        } else {
            $return_string .= '<div class="osLight"><span>' . esc_html($price) . esc_html($currency) . '<small style="font-size:14px;">' . esc_html($price_label) . '</small></span></div>';
        }
        $return_string .= '</div>';

        if($type) {
            $return_string .= '<div class="spsType">' . esc_html($type[0]->name) . '</div>';
        }

        $return_string .= '</div>';
        if($position == 'left') {
            $return_string .= '<div class="spsContent left">';
        } else {
            $return_string .= '<div class="spsContent right">';
        }
        $return_string .= '<div class="spsCategory">' . esc_html($category[0]->name) . '</div>';
        $return_string .= '<h3 class="osLight spsTitle">' . esc_attr($post->post_title) . '</h3>';

        $return_string .= '<div class="spsAddress">';
        if($address != '') {
            $return_string .= esc_html($address) . ', ';
        }
        if($neighborhood != '') {
            $return_string .= esc_html($neighborhood) . ', ';
        }
        if($city != '') {
            if($p_city_t == 'list') {
                $reales_cities_settings = get_option('reales_cities_settings');
                if(is_array($reales_cities_settings) && count($reales_cities_settings) > 0) {
                    uasort($reales_cities_settings, "reales_compare_position");
                    foreach ($reales_cities_settings as $key => $value) {
                        if ($city == $key) {
                            $city = $value['name'];
                        }
                    }
                }
            }

            $return_string .= esc_html($city) . ', ';
        }
        if($address != '' || $neighborhood != '' || $city != '') {
            $return_string .= '<br />';
        }
        if($state != '') {
            $return_string .= esc_html($state) . ', ';
        }
        if($zip != '') {
            $return_string .= esc_html($zip) . ', ';
        }
        if($country != '') {
            $return_string .= esc_html($country);
        }
        $return_string .= '</div>';

        $return_string .= '<a href="' . esc_url(get_permalink($post->ID)) . '" class="btn btn-green btn-o">' . __('View Details', 'reales') . '</a>';

        $return_string .= '<ul class="spsFeatures">';
        if($bedrooms != '') {
            $return_string .= '<li><span class="fa fa-moon-o"></span> ' . esc_html($bedrooms) . ' ' . __('Bedrooms', 'reales') . '</li>';
        }
        if($bathrooms != '') {
            $return_string .= '<li><span class="icon-drop"></span> ' . esc_html($bathrooms) . ' ' . __('Bathrooms', 'reales') . '</li>';
        }
        if($area != '') {
            $return_string .= '<li><span class="icon-frame"></span> ' . esc_html($area) . ' ' . esc_html($unit) . '</li>';
        }
        $return_string .= '</ul>';
        $return_string .= '</div>';

        $return_string .= '<div class="clearfix"></div>';

        $return_string .= '</div>';
        $return_string .= '</div>';

        wp_reset_postdata();
        wp_reset_query();

        return $return_string;
    }
endif;
?>
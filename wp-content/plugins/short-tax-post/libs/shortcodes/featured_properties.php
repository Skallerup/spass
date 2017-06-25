<?php
/**
 * Featured properties shortcode
 */
if( !function_exists('reales_featured_properties_shortcode') ): 
    function reales_featured_properties_shortcode($attrs, $content = null) {
        extract(shortcode_atts(array(
            'title' => 'Featured Properties'
        ), $attrs));

        if(isset($attrs['show']) && is_numeric($attrs['show'])) {
            $show = $attrs['show'];
        } else {
            $show = '3';
        }

        if(isset($attrs['category']) && is_numeric($attrs['category'])) {
            $category = $attrs['category'];
        } else {
            $category = '0';
        }

        if(isset($attrs['type']) && is_numeric($attrs['type'])) {
            $type = $attrs['type'];
        } else {
            $type = '0';
        }

        $args = array(
            'numberposts'      => $show,
            'post_type'        => 'property',
            'order'            => 'DESC',
            'meta_key'         => 'property_featured',
            'meta_value'       => '1',
            'suppress_filters' => false,
            'post_status'      => 'publish');

        if($category != '0' && $type != '0') {
            $args['tax_query'] = array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'property_category',
                    'field'    => 'term_id',
                    'terms'    => $category,
                ),
                array(
                    'taxonomy' => 'property_type_category',
                    'field'    => 'term_id',
                    'terms'    => $type,
                ),
            );
        } else if($category != '0') {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'property_category',
                    'field'    => 'term_id',
                    'terms'    => $category,
                ),
            );
        } else if($type != '0') {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'property_type_category',
                    'field'    => 'term_id',
                    'terms'    => $type,
                ),
            );
        }

        $posts = get_posts($args);

        $reales_prop_fields_settings = get_option('reales_prop_fields_settings');
        $p_city_t = isset($reales_prop_fields_settings['reales_p_city_t_field']) ? $reales_prop_fields_settings['reales_p_city_t_field'] : '';

        $return_string = '<h2 class="centered osLight">' . esc_html($title) . '</h2>';
        $return_string .= '<div class="row pb40">';
        foreach($posts as $post) : setup_postdata($post);
            $gallery = get_post_meta($post->ID, 'property_gallery', true);
            $images = explode("~~~", $gallery);
            $reales_general_settings = get_option('reales_general_settings');
            $currency = isset($reales_general_settings['reales_currency_symbol_field']) ? $reales_general_settings['reales_currency_symbol_field'] : '';
            $currency_pos = isset($reales_general_settings['reales_currency_symbol_pos_field']) ? $reales_general_settings['reales_currency_symbol_pos_field'] : '';
            $price_label = get_post_meta($post->ID, 'property_price_label', true);
            $address = get_post_meta($post->ID, 'property_address', true);
            $city = get_post_meta($post->ID, 'property_city', true);
            $zip = get_post_meta($post->ID, 'property_zip', true);
            $country = get_post_meta($post->ID, 'property_country', true);
            $type =  wp_get_post_terms($post->ID, 'property_type_category');

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

            // aq_resize( $url, $width, $height, $crop, $single, $upscale );
            $img_resize = aq_resize($images[1], 600, 400, true);

            $thumb = '';
            if($img_resize !== false) {
                $thumb = $img_resize;
            } else {
                $thumb = $images[1];
            }

            if(intval($show) % 3 == 0) {
                $return_string .= '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">';
            } else {
                $return_string .= '<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">';
            }
            $return_string .= '<a href="' . esc_url(get_permalink($post->ID)) . '" class="propWidget-2">';
            $return_string .= '<div class="fig">';
            $return_string .= '<div class="featured-label">';
            $return_string .= '<div class="featured-label-left"></div>';
            $return_string .= '<div class="featured-label-content"><span class="fa fa-star"></div>';
            $return_string .= '<div class="featured-label-right"></div>';
            $return_string .= '<div class="clearfix"></div>';
            $return_string .= '</div>';
            $return_string .= '<img src="' . esc_url($thumb) . '" alt="' . esc_attr($post->post_title) . '" class="scale" data-scale="best-fill" data-align="center">';
            $return_string .= '<img src="' . esc_url($thumb) . '" alt="' . esc_attr($post->post_title) . '" class="blur scale" data-scale="best-fill" data-align="center">';

            $return_string .= '<div class="opac"></div>';
            if($currency_pos == 'before') {
                $return_string .= '<div class="priceCap osLight"><span>' . esc_html($currency) . esc_html($price) . '<small style="font-size:14px;">' . esc_html($price_label) . '</small></span></div>';
            } else {
                $return_string .= '<div class="priceCap osLight"><span>' . esc_html($price) . esc_html($currency) . '<small style="font-size:14px;">' . esc_html($price_label) . '</small></span></div>';
            }
            if($type) {
                $return_string .= '<div class="figType">' . esc_html($type[0]->name) . '</div>';
            }
            $return_string .= '<h3 class="osLight">' . esc_html($post->post_title) . '</h3>';
            $return_string .= '<div class="address">';
            if($address != '') {
                $return_string .= esc_html($address) . ', ';
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
            $return_string .= esc_html($country);
            $return_string .= '</div></div>';
            $return_string .= '</a>';
            $return_string .= '</div>';
        endforeach;
        $return_string .= '</div>';

        wp_reset_postdata();
        wp_reset_query();
        return $return_string;
    }
endif;
?>
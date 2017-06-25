<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

class Recent_Properties_Widget extends WP_Widget {
    function Recent_Properties_Widget() {
        $widget_ops = array('classname' => 'recent_properties_sidebar', 'description' => 'Recently listed properties.');
        $control_ops = array('id_base' => 'recent_properties_widget');
        parent::__construct('recent_properties_widget', 'Reales WP Recently Listed Properties', $widget_ops, $control_ops);
    }

    function form($instance) {
        $defaults = array(
            'title'    => '',
            'limit'    => '',
            'category' => 0,
            'type'     => 0
        );
        $instance = wp_parse_args((array) $instance, $defaults);

        $display = '
            <p>
                <label for="' . esc_attr($this->get_field_id('title')) . '">' . __('Title', 'reales') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" value="' . esc_attr($instance['title']) . '" />
            </p>
            <p>
                <label for="' . esc_attr($this->get_field_id('limit')) . '">' . __('Number of properties to show', 'reales') . ':</label>
                <input type="text" size="3" id="' . esc_attr($this->get_field_id('limit')) . '" name="' . esc_attr($this->get_field_name('limit')) . '" value="' . esc_attr($instance['limit']) . '" />
            </p>
        ';

        $cat_taxonomies = array( 
            'property_category'
        );
        $cat_args = array(
            'orderby'    => 'name',
            'order'      => 'ASC',
            'hide_empty' => false
        ); 
        $cat_terms = get_terms($cat_taxonomies, $cat_args);
        $display .= '
            <p>
                <label for="' . esc_attr($this->get_field_id('category')) . '">' . __('Category', 'reales') . ':</label>
                <select id="' . esc_attr($this->get_field_id('category')) . '" name="' . esc_attr($this->get_field_name('category')) . '">
                    <option ' . ($instance['category'] == 0 ? 'selected="selected"' : '') . 'value="0">' . esc_html('All', 'reales') . '</option>
        ';
        foreach ($cat_terms as $cat_term) {
            $display .= '<option ' . ($instance['category'] == $cat_term->term_id ? 'selected="selected"' : '') . 'value="' . esc_attr($cat_term->term_id) . '">' . esc_html($cat_term->name) . '</option>';
        }
        $display .= '
                </select>
            </p>
        ';

        $type_taxonomies = array( 
            'property_type_category'
        );
        $type_args = array(
            'orderby'    => 'name',
            'order'      => 'ASC',
            'hide_empty' => false
        ); 
        $type_terms = get_terms($type_taxonomies, $type_args);
        $display .= '
            <p>
                <label for="' . esc_attr($this->get_field_id('type')) . '">' . __('Type', 'reales') . ':</label>
                <select id="' . esc_attr($this->get_field_id('type')) . '" name="' . esc_attr($this->get_field_name('type')) . '">
                    <option ' . ($instance['type'] == 0 ? 'selected="selected"' : '') . 'value="0">' . esc_html('All', 'reales') . '</option>
        ';
        foreach ($type_terms as $type_term) {
            $display .= '<option ' . ($instance['type'] == $type_term->term_id ? 'selected="selected"' : '') . 'value="' . esc_attr($type_term->term_id) . '">' . esc_html($type_term->name) . '</option>';
        }
        $display .= '
                </select>
            </p>
        ';

        print $display;
    }


    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['limit'] = sanitize_text_field($new_instance['limit']);
        $instance['category'] = sanitize_text_field($new_instance['category']);
        $instance['type']     = sanitize_text_field($new_instance['type']);

        if(function_exists('icl_register_string')) {
            icl_register_string('reales_recent_properties_widget', 'recent_properties_widget_title', sanitize_text_field($new_instance['title']));
            icl_register_string('reales_recent_properties_widget', 'recent_properties_widget_limit', sanitize_text_field($new_instance['limit']));
            icl_register_string('reales_featured_properties_widget', 'featured_properties_widget_category', sanitize_text_field($new_instance['category']));
            icl_register_string('reales_featured_properties_widget', 'featured_properties_widget_type', sanitize_text_field($new_instance['type']));
        }

        return $instance;
    }

    function widget($args, $instance) {
        extract($args);
        $display = '';
        $title = apply_filters('widget_title', $instance['title']);

        print $before_widget;

        if($title) {
            print $before_title . esc_html($title) . $after_title;
        }

        if(isset($instance['limit']) && $instance['limit'] != '') {
            $limit = $instance['limit'];
        } else {
            $limit = 4;
        }

        if(isset($instance['category']) && is_numeric($instance['category'])) {
            $category = $instance['category'];
        } else {
            $category = 0;
        }

        if(isset($instance['type']) && is_numeric($instance['type'])) {
            $type = $instance['type'];
        } else {
            $type = 0;
        }

        $args = array(
            'posts_per_page'   => $instance['limit'],
            'post_type'        => 'property',
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'suppress_filters' => false,
            'post_status'      => 'publish'
        );

        if($category != 0 && $type != 0) {
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
        } else if($category != 0) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'property_category',
                    'field'    => 'term_id',
                    'terms'    => $category,
                ),
            );
        } else if($type != 0) {
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

        $display .= '<div class="propsWidget"><ul class="propList">';
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
            $featured = get_post_meta($post->ID, 'property_featured', true);

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
            $img_resize = aq_resize($images[1], 120, 120, true);

            $thumb = '';
            if($img_resize !== false) {
                $thumb = $img_resize;
            } else {
                $thumb = $images[1];
            }

            $display .= '<li>';
            $display .= '<a href="' . esc_url(get_permalink($post->ID)) . '">';
            $display .= '<div class="image">';
            if($featured == 1) {
                $display .= '<div class="featured-label">';
                $display .= '<div class="featured-label-left"></div>';
                $display .= '<div class="featured-label-content"><span class="fa fa-star"></span></div>';
                $display .= '<div class="featured-label-right"></div>';
                $display .= '<div class="clearfix"></div>';
                $display .= '</div>';
            }
            $display .= '<img src="' . esc_url($thumb) . '" alt="' . esc_attr($title) . '" />';
            $display .= '</div>';
            $display .= '<div class="info text-nowrap">';
            $display .= '<div class="name">' . esc_html($post->post_title) . '</div>';
            $display .= '<div class="address">';
            if($address != '') {
                $display .= esc_html($address) . ', ';
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

                $display .= esc_html($city) . ', ';
            }
            if($zip != '') {
                $display .= esc_html($zip) . ', ';
            }
            if($country != '') {
                $display .= esc_html($country);
            }
            $display .= '</div>';
            if($type) {
                $type_name = $type[0]->name;
            } else {
                $type_name = '';
            }
            if($currency_pos == 'before') {
                $display .= '<div class="price">' . esc_html($currency) . esc_html($price) . ' ' . esc_html($price_label) . ' <span class="badge">' . esc_html($type_name) . '</span></div>';
            } else {
                $display .= '<div class="price">' . esc_html($price) . esc_html($currency) . ' ' . esc_html($price_label) . ' <span class="badge">' . esc_html($type_name) . '</span></div>';
            }
            $display .= '</div>';
            $display .= '<div class="clearfix"></div>';
            $display .= '</a>';
            $display .= '</li>';
        endforeach;

        $display .= '</ul></div>';

        wp_reset_postdata();
        wp_reset_query();
        print $display;
        print $after_widget;
    }

}

?>
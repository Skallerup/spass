<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

/**
 * Get single property
 */
if( !function_exists('reales_get_single_property') ): 
    function reales_get_single_property() {
        check_ajax_referer('app_map_ajax_nonce', 'security');

        $single_id = isset($_POST['single_id']) ? sanitize_text_field($_POST['single_id']) : '';

        $args = array(
            'p' => $single_id,
            'posts_per_page' => 1,
            'post_type' => 'property',
            'post_status' => 'publish'
        );


        $query = new WP_Query($args);

        $props = array();
        $reales_general_settings = get_option('reales_general_settings');

        while($query->have_posts()) {
            $query->the_post();

            $post_id = get_the_ID();
            $prop = new stdClass();

            $prop->id = $post_id;
            $prop->title = get_the_title();
            $prop->link = get_permalink($post_id);
            $prop->lat = get_post_meta($post_id, 'property_lat', true);
            $prop->lng = get_post_meta($post_id, 'property_lng', true);
            $prop->address = get_post_meta($post_id, 'property_address', true);
            $prop->state = get_post_meta($post_id, 'property_state', true);
            $prop->zip = get_post_meta($post_id, 'property_zip', true);
            $prop->country = get_post_meta($post_id, 'property_country', true);
            $prop->price = get_post_meta($post_id, 'property_price', true);
            $prop->currency = isset($reales_general_settings['reales_currency_symbol_field']) ? $reales_general_settings['reales_currency_symbol_field'] : '';
            $prop->currency_pos = isset($reales_general_settings['reales_currency_symbol_pos_field']) ? $reales_general_settings['reales_currency_symbol_pos_field'] : '';
            $prop->price_label = get_post_meta($post_id, 'property_price_label', true);
            $prop->area = get_post_meta($post_id, 'property_area', true);
            $prop->unit = isset($reales_general_settings['reales_unit_field']) ? $reales_general_settings['reales_unit_field'] : '';
            $prop->bedrooms = get_post_meta($post_id, 'property_bedrooms', true);
            $prop->bathrooms = get_post_meta($post_id, 'property_bathrooms', true);
            $prop->type =  wp_get_post_terms($post_id, 'property_type_category');
            $prop->featured = get_post_meta($post_id, 'property_featured', true);

            $gallery = get_post_meta($post_id, 'property_gallery', true);
            $images = explode("~~~", $gallery);

            // aq_resize( $url, $width, $height, $crop, $single, $upscale );
            $img_resize = aq_resize($images[1], 400, 240, true);

            $thumb = '';
            if($img_resize !== false) {
                $thumb = $img_resize;
            } else {
                $thumb = $images[1];
            }
            $prop->thumb = $thumb;

            $city = get_post_meta($post_id, 'property_city', true);
            $reales_prop_fields_settings = get_option('reales_prop_fields_settings');
            $p_city_t = isset($reales_prop_fields_settings['reales_p_city_t_field']) ? $reales_prop_fields_settings['reales_p_city_t_field'] : '';
            if($p_city_t == 'list') {
                $reales_cities_settings = get_option('reales_cities_settings');
                $prop->city = $city;
                if(is_array($reales_cities_settings) && count($reales_cities_settings) > 0) {
                    uasort($reales_cities_settings, "reales_compare_position");
                    foreach ($reales_cities_settings as $key => $value) {
                        if ($city == $key) {
                            $prop->city = $value['name'];
                        }
                    }
                }
            } else {
                $prop->city = $city;
            }


            array_push($props, $prop);
        }

        wp_reset_postdata();
        wp_reset_query();

        if(count($props) > 0) {
            echo json_encode(array('getprops'=>true, 'props'=>$props));
            exit();
        } else {
            echo json_encode(array('getprops'=>false));
            exit();
        }

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_get_single_property', 'reales_get_single_property' );
add_action( 'wp_ajax_reales_get_single_property', 'reales_get_single_property' );

/**
 * Get searched properties
 */
if( !function_exists('reales_get_searched_properties') ): 
    function reales_get_searched_properties() {
        check_ajax_referer('app_map_ajax_nonce', 'security');

        $search_id                  = isset($_POST['id']) ? sanitize_text_field($_POST['id']) : '';
        $search_keywords            = isset($_POST['keywords']) ? sanitize_text_field($_POST['keywords']) : '';
        $search_country             = isset($_POST['country']) ? sanitize_text_field($_POST['country']) : '';
        $search_state               = isset($_POST['state']) ? sanitize_text_field($_POST['state']) : '';
        $search_city                = isset($_POST['city']) ? stripslashes(sanitize_text_field($_POST['city'])) : '';
        $search_category            = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '0';
        $search_type                = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '0';
        $search_min_price           = isset($_POST['min_price']) ? sanitize_text_field($_POST['min_price']) : '';
        $search_max_price           = isset($_POST['max_price']) ? sanitize_text_field($_POST['max_price']) : '';
        $search_bedrooms            = isset($_POST['bedrooms']) ? sanitize_text_field($_POST['bedrooms']) : '';
        $search_bathrooms           = isset($_POST['bathrooms']) ? sanitize_text_field($_POST['bathrooms']) : '';
        $search_neighborhood        = isset($_POST['neighborhood']) ? sanitize_text_field($_POST['neighborhood']) : '';
        $search_min_area            = isset($_POST['min_area']) ? sanitize_text_field($_POST['min_area']) : '';
        $search_max_area            = isset($_POST['max_area']) ? sanitize_text_field($_POST['max_area']) : '';
        $featured                   = isset($_POST['featured']) ? sanitize_text_field($_POST['featured']) : '';
        $search_amenities           = isset($_POST['amenities']) ? array_map('reales_sanitize_item', $_POST['amenities']) : '';
        $search_custom_fields       = isset($_POST['custom_fields']) ? $_POST['custom_fields'] : '';
        $reales_appearance_settings = get_option('reales_appearance_settings');
        $posts_per_page_setting     = isset($reales_appearance_settings['reales_properties_per_page_field']) ? $reales_appearance_settings['reales_properties_per_page_field'] : '';
        $posts_per_page             = $posts_per_page_setting != '' ? $posts_per_page_setting : 10;
        $the_page                   = isset($_POST['page']) ? sanitize_text_field($_POST['page']) : 0;
        $page                       = ($the_page == 0) ? 1 : $the_page;
        $sort                       = isset($_POST['sort']) ? sanitize_text_field($_POST['sort']) : 'newest';

        $args = array(
            'posts_per_page' => $posts_per_page,
            'paged'          => $page,
            's'              => $search_keywords,
            'post_type'      => 'property',
            'post_status'    => 'publish'
        );

        $args['meta_query'] = array('relation' => 'AND');

        if($sort == 'newest') {
            $args['meta_key'] = 'property_featured';
            $args['orderby'] = array('meta_value_num' => 'DESC', 'date' => 'DESC', 'ID' => 'DESC');
        } else if($sort == 'price_lo') {
            $args['meta_key'] = 'property_price';
            $args['orderby'] = array('meta_value_num' => 'ASC', 'date' => 'DESC', 'ID' => 'DESC');
        } else if($sort == 'price_hi') {
            $args['meta_key'] = 'property_price';
            $args['orderby'] = array('meta_value_num' => 'DESC', 'date' => 'DESC', 'ID' => 'DESC');
        } else if($sort == 'bedrooms') {
            $args['meta_key'] = 'property_bedrooms';
            $args['orderby'] = array('meta_value_num' => 'DESC', 'date' => 'DESC', 'ID' => 'DESC');
        } else if($sort == 'bathrooms') {
            $args['meta_key'] = 'property_bathrooms';
            $args['orderby'] = array('meta_value_num' => 'DESC', 'date' => 'DESC', 'ID' => 'DESC');
        } else if($sort == 'area') {
            $args['meta_key'] = 'property_area';
            $args['orderby'] = array('meta_value_num' => 'DESC', 'date' => 'DESC', 'ID' => 'DESC');
        }

        if($search_id != '') {
            $args['p'] = $search_id;
        }

        if($search_category != '0' && $search_type != '0') {
            $args['tax_query'] = array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'property_category',
                    'field'    => 'term_id',
                    'terms'    => $search_category,
                ),
                array(
                    'taxonomy' => 'property_type_category',
                    'field'    => 'term_id',
                    'terms'    => $search_type,
                ),
            );
        } else if($search_category != '0') {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'property_category',
                    'field'    => 'term_id',
                    'terms'    => $search_category,
                ),
            );
        } else if($search_type != '0') {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'property_type_category',
                    'field'    => 'term_id',
                    'terms'    => $search_type,
                ),
            );
        }

        if($search_country != '') {
            array_push($args['meta_query'], array(
                'key'     => 'property_country',
                'value'   => $search_country,
            ));
        }

        if($featured != '') {
            array_push($args['meta_query'], array(
                'key'     => 'property_featured',
                'value'   => $featured,
            ));
        }

        if($search_state != '') {
            array_push($args['meta_query'], array(
                'key'     => 'property_state',
                'value'   => $search_state,
            ));
        }

        if($search_city != '') {
            array_push($args['meta_query'], array(
                'key'     => 'property_city',
                'value'   => $search_city,
            ));
        }

        if($search_min_price != '' && $search_min_price != '' && is_numeric($search_min_price) && is_numeric($search_max_price)) {
            array_push($args['meta_query'], array(
                'key'     => 'property_price',
                'value'   => array($search_min_price, $search_max_price),
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC'
            ));
        } else if($search_min_price != '' && is_numeric($search_min_price)) {
            array_push($args['meta_query'], array(
                'key'     => 'property_price',
                'value'   => $search_min_price,
                'compare' => '>=',
                'type' => 'NUMERIC'
            ));
        } else if($search_max_price != '' && is_numeric($search_max_price)) {
            array_push($args['meta_query'], array(
                'key'     => 'property_price',
                'value'   => $search_max_price,
                'compare' => '<=',
                'type' => 'NUMERIC'
            ));
        }

        if($search_bedrooms != '' && $search_bedrooms != 0) {
            array_push($args['meta_query'], array(
                'key'     => 'property_bedrooms',
                'value'   => $search_bedrooms,
                'compare' => '>=',
                'type'    => 'NUMERIC'
            ));
        }

        if($search_bathrooms != '' && $search_bathrooms != 0) {
            array_push($args['meta_query'], array(
                'key'     => 'property_bathrooms',
                'value'   => $search_bathrooms,
                'compare' => '>=',
                'type'    => 'NUMERIC'
            ));
        }

        if($search_neighborhood != '') {
            array_push($args['meta_query'], array(
                'key'     => 'property_neighborhood',
                'value'   => $search_neighborhood,
                'compare' => 'LIKE'
            ));
        }

        if($search_min_area != '' && $search_min_area != '' && is_numeric($search_min_area) && is_numeric($search_max_area)) {
            array_push($args['meta_query'], array(
                'key'     => 'property_area',
                'value'   => array($search_min_area, $search_max_area),
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC'
            ));
        } else if($search_min_area != '' && is_numeric($search_min_area)) {
            array_push($args['meta_query'], array(
                'key'     => 'property_area',
                'value'   => $search_min_area,
                'compare' => '>=',
                'type' => 'NUMERIC'
            ));
        } else if($search_max_area != '' && is_numeric($search_max_area)) {
            array_push($args['meta_query'], array(
                'key'     => 'property_area',
                'value'   => $search_max_area,
                'compare' => '<=',
                'type' => 'NUMERIC'
            ));
        }

        if(is_array($search_amenities)) {
            foreach($search_amenities as $amnt) {
                array_push($args['meta_query'], array(
                    'key'     => $amnt,
                    'value'   => 1
                ));
            }
        }

        // Custom fields search
        if(is_array($search_custom_fields)) {
            foreach ($search_custom_fields as $field) {
                $operator   = '';
                $value_type = '';

                switch ($field['compare']) {
                    case 'equal':
                        $operator = '==';
                        break;
                    case 'greater':
                        $operator = '>=';
                        break;
                    case 'smaller':
                        $operator = '<=';
                        break;
                    case 'like':
                        $operator = 'LIKE';
                        break;
                }

                switch ($field['type']) {
                    case 'text_field':
                        $value_type = 'CHAR';
                        break;
                    case 'numeric_field':
                        $value_type = 'NUMERIC';
                        break;
                    case 'date_field':
                        $value_type = 'DATE';
                        break;
                    case 'list_field':
                        $value_type = 'CHAR';
                        break;
                }

                if($field['value'] != '') {
                    array_push($args['meta_query'], array(
                        'key'     => $field['name'],
                        'value'   => $field['value'],
                        'compare' => $operator,
                        'type'    => $value_type
                    ));
                }
            }
        }


        $query = new WP_Query($args);

        $props = array();
        $reales_general_settings = get_option('reales_general_settings');

        while($query->have_posts()) {
            $query->the_post();

            $post_id = get_the_ID();
            $prop = new stdClass();

            $prop->id = $post_id;
            $prop->title = get_the_title();
            $prop->link = get_permalink($post_id);
            $prop->lat = get_post_meta($post_id, 'property_lat', true);
            $prop->lng = get_post_meta($post_id, 'property_lng', true);
            $prop->address = get_post_meta($post_id, 'property_address', true);
            $prop->state = get_post_meta($post_id, 'property_state', true);
            $prop->zip = get_post_meta($post_id, 'property_zip', true);
            $prop->country = get_post_meta($post_id, 'property_country', true);
            $prop->price = get_post_meta($post_id, 'property_price', true);
            $prop->currency = isset($reales_general_settings['reales_currency_symbol_field']) ? $reales_general_settings['reales_currency_symbol_field'] : '';
            $prop->currency_pos = isset($reales_general_settings['reales_currency_symbol_pos_field']) ? $reales_general_settings['reales_currency_symbol_pos_field'] : '';
            $prop->price_label = get_post_meta($post_id, 'property_price_label', true);
            $prop->area = get_post_meta($post_id, 'property_area', true);
            $prop->unit = isset($reales_general_settings['reales_unit_field']) ? $reales_general_settings['reales_unit_field'] : '';
            $prop->bedrooms = get_post_meta($post_id, 'property_bedrooms', true);
            $prop->bathrooms = get_post_meta($post_id, 'property_bathrooms', true);
            $prop->featured = get_post_meta($post_id, 'property_featured', true);

            $city = get_post_meta($post_id, 'property_city', true);
            $reales_prop_fields_settings = get_option('reales_prop_fields_settings');
            $p_city_t = isset($reales_prop_fields_settings['reales_p_city_t_field']) ? $reales_prop_fields_settings['reales_p_city_t_field'] : '';
            if($p_city_t == 'list') {
                $reales_cities_settings = get_option('reales_cities_settings');
                $prop->city = $city;
                if(is_array($reales_cities_settings) && count($reales_cities_settings) > 0) {
                    uasort($reales_cities_settings, "reales_compare_position");
                    foreach ($reales_cities_settings as $key => $value) {
                        if ($city == $key) {
                            $prop->city = $value['name'];
                        }
                    }
                }
            } else {
                $prop->city = $city;
            }

            $gallery = get_post_meta($post_id, 'property_gallery', true);
            $images = explode("~~~", $gallery);

            // aq_resize( $url, $width, $height, $crop, $single, $upscale );
            $img_resize = aq_resize($images[1], 400, 240, true);

            $thumb = '';
            if($img_resize !== false) {
                $thumb = $img_resize;
            } else {
                $thumb = $images[1];
            }
            $prop->thumb = $thumb;

            $prop->category =  wp_get_post_terms($post_id, 'property_category');
            $prop->type =  wp_get_post_terms($post_id, 'property_type_category');

            array_push($props, $prop);
        }

        wp_reset_postdata();

        if(count($props) > 0) {
            echo json_encode(array('getprops'=>true, 'props'=>$props));
            exit();
        } else {
            echo json_encode(array('getprops'=>false));
            exit();
        }

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_get_searched_properties', 'reales_get_searched_properties' );
add_action( 'wp_ajax_reales_get_searched_properties', 'reales_get_searched_properties' );

/**
 * Get all properties
 */
if( !function_exists('reales_get_all_properties') ): 
    function reales_get_all_properties() {
        check_ajax_referer('home_map_ajax_nonce', 'security');

        $args = array(
            'posts_per_page'   => -1,
            'post_type'        => 'property',
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'post_status'      => 'publish'
        );
        $props = array();
        $posts = get_posts($args);
        $reales_general_settings = get_option('reales_general_settings');

        foreach($posts as $post) : setup_postdata($post);
            $prop = new stdClass();
            $prop->data = $post;
            $prop->link = get_permalink($post->ID);
            $prop->city = get_post_meta($post->ID, 'property_city', true);
            $prop->lat = get_post_meta($post->ID, 'property_lat', true);
            $prop->lng = get_post_meta($post->ID, 'property_lng', true);
            $prop->address = get_post_meta($post->ID, 'property_address', true);
            $prop->state = get_post_meta($post->ID, 'property_state', true);
            $prop->zip = get_post_meta($post->ID, 'property_zip', true);
            $prop->country = get_post_meta($post->ID, 'property_country', true);
            $prop->price = get_post_meta($post->ID, 'property_price', true);
            $prop->currency = isset($reales_general_settings['reales_currency_symbol_field']) ? $reales_general_settings['reales_currency_symbol_field'] : '';
            $prop->currency_pos = isset($reales_general_settings['reales_currency_symbol_pos_field']) ? $reales_general_settings['reales_currency_symbol_pos_field'] : '';
            $prop->price_label = get_post_meta($post->ID, 'property_price_label', true);
            $prop->area = get_post_meta($post->ID, 'property_area', true);
            $prop->unit = isset($reales_general_settings['reales_unit_field']) ? $reales_general_settings['reales_unit_field'] : '';
            $prop->bedrooms = get_post_meta($post->ID, 'property_bedrooms', true);
            $prop->bathrooms = get_post_meta($post->ID, 'property_bathrooms', true);
            $prop->featured = get_post_meta($post->ID, 'property_featured', true);
            $prop->category =  wp_get_post_terms($post->ID, 'property_category');
            $prop->type =  wp_get_post_terms($post->ID, 'property_type_category');

            $gallery = get_post_meta($post->ID, 'property_gallery', true);
            $images = explode("~~~", $gallery);

            // aq_resize( $url, $width, $height, $crop, $single, $upscale );
            $img_resize = aq_resize($images[1], 400, 240, true);

            $thumb = '';
            if($img_resize !== false) {
                $thumb = $img_resize;
            } else {
                $thumb = $images[1];
            }
            $prop->thumb = $thumb;

            $city = get_post_meta($post->ID, 'property_city', true);
            $reales_prop_fields_settings = get_option('reales_prop_fields_settings');
            $p_city_t = isset($reales_prop_fields_settings['reales_p_city_t_field']) ? $reales_prop_fields_settings['reales_p_city_t_field'] : '';
            if($p_city_t == 'list') {
                $reales_cities_settings = get_option('reales_cities_settings');
                $prop->city = $city;
                if(is_array($reales_cities_settings) && count($reales_cities_settings) > 0) {
                    uasort($reales_cities_settings, "reales_compare_position");
                    foreach ($reales_cities_settings as $key => $value) {
                        if ($city == $key) {
                            $prop->city = $value['name'];
                        }
                    }
                }
            } else {
                $prop->city = $city;
            }

            array_push($props, $prop);
        endforeach;

        wp_reset_postdata();
        if(count($props) > 0) {
            echo json_encode(array('getprops'=>true, 'props'=>$props));
            exit();
        } else {
            echo json_encode(array('getprops'=>false));
            exit();
        }

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_get_all_properties', 'reales_get_all_properties' );
add_action( 'wp_ajax_reales_get_all_properties', 'reales_get_all_properties' );

/**
 * Get my properties
 */
if( !function_exists('reales_get_my_properties') ): 
    function reales_get_my_properties() {
        check_ajax_referer('app_map_ajax_nonce', 'security');

        $agent_id = isset($_POST['agent_id']) ? sanitize_text_field($_POST['agent_id']) : '';
        $reales_appearance_settings = get_option('reales_appearance_settings');

        $posts_per_page_setting = isset($reales_appearance_settings['reales_properties_per_page_field']) ? $reales_appearance_settings['reales_properties_per_page_field'] : '';
        $posts_per_page = $posts_per_page_setting != '' ? $posts_per_page_setting : 10;
        $the_page = isset($_POST['page']) ? sanitize_text_field($_POST['page']) : 0;
        $page = ($the_page == 0) ? 1 : $the_page;

        $args = array(
            'posts_per_page' => $posts_per_page,
            'paged' => $page,
            'post_type' => 'property',
            'post_status' => array('publish', 'pending')
        );

        $args['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key'     => 'property_agent',
                'value'   => $agent_id,
            )
        );


        $query = new WP_Query($args);

        $props = array();
        $reales_general_settings = get_option('reales_general_settings');
        
        while($query->have_posts()) {
            $query->the_post();

            $post_id = get_the_ID();
            $prop = new stdClass();

            $prop->id = $post_id;
            $prop->title = get_the_title();
            $prop->link = get_permalink($post_id);
            $prop->lat = get_post_meta($post_id, 'property_lat', true);
            $prop->lng = get_post_meta($post_id, 'property_lng', true);
            $prop->address = get_post_meta($post_id, 'property_address', true);
            $prop->state = get_post_meta($post_id, 'property_state', true);
            $prop->zip = get_post_meta($post_id, 'property_zip', true);
            $prop->country = get_post_meta($post_id, 'property_country', true);
            $prop->price = get_post_meta($post_id, 'property_price', true);
            $prop->currency = isset($reales_general_settings['reales_currency_symbol_field']) ? $reales_general_settings['reales_currency_symbol_field'] : '';
            $prop->currency_pos = isset($reales_general_settings['reales_currency_symbol_pos_field']) ? $reales_general_settings['reales_currency_symbol_pos_field'] : '';
            $prop->price_label = get_post_meta($post_id, 'property_price_label', true);
            $prop->area = get_post_meta($post_id, 'property_area', true);
            $prop->unit = isset($reales_general_settings['reales_unit_field']) ? $reales_general_settings['reales_unit_field'] : '';
            $prop->bedrooms = get_post_meta($post_id, 'property_bedrooms', true);
            $prop->bathrooms = get_post_meta($post_id, 'property_bathrooms', true);
            $prop->featured = get_post_meta($post_id, 'property_featured', true);

            $city = get_post_meta($post_id, 'property_city', true);
            $reales_prop_fields_settings = get_option('reales_prop_fields_settings');
            $p_city_t = isset($reales_prop_fields_settings['reales_p_city_t_field']) ? $reales_prop_fields_settings['reales_p_city_t_field'] : '';
            if($p_city_t == 'list') {
                $reales_cities_settings = get_option('reales_cities_settings');
                $prop->city = $city;
                if(is_array($reales_cities_settings) && count($reales_cities_settings) > 0) {
                    uasort($reales_cities_settings, "reales_compare_position");
                    foreach ($reales_cities_settings as $key => $value) {
                        if ($city == $key) {
                            $prop->city = $value['name'];
                        }
                    }
                }
            } else {
                $prop->city = $city;
            }

            $gallery = get_post_meta($post_id, 'property_gallery', true);
            $images = explode("~~~", $gallery);

            // aq_resize( $url, $width, $height, $crop, $single, $upscale );
            $img_resize = aq_resize($images[1], 400, 240, true);

            $thumb = '';
            if($img_resize !== false) {
                $thumb = $img_resize;
            } else {
                $thumb = $images[1];
            }
            $prop->thumb = $thumb;

            $prop->category =  wp_get_post_terms($post_id, 'property_category');
            $prop->type =  wp_get_post_terms($post_id, 'property_type_category');

            array_push($props, $prop);
        }

        wp_reset_postdata();

        if(count($props) > 0) {
            echo json_encode(array('getprops'=>true, 'props'=>$props));
            exit();
        } else {
            echo json_encode(array('getprops'=>false));
            exit();
        }

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_get_my_properties', 'reales_get_my_properties' );
add_action( 'wp_ajax_reales_get_my_properties', 'reales_get_my_properties' );

/**
 * Get my favourite properties
 */
if( !function_exists('reales_get_fav_properties') ): 
    function reales_get_fav_properties() {
        check_ajax_referer('app_map_ajax_nonce', 'security');

        $user_id = isset($_POST['user_id']) ? sanitize_text_field($_POST['user_id']) : '';
        $reales_appearance_settings = get_option('reales_appearance_settings');
        $posts_per_page_setting = isset($reales_appearance_settings['reales_properties_per_page_field']) ? $reales_appearance_settings['reales_properties_per_page_field'] : '';
        $posts_per_page = $posts_per_page_setting != '' ? $posts_per_page_setting : 10;
        $the_page = isset($_POST['page']) ? sanitize_text_field($_POST['page']) : 0;
        $page = ($the_page == 0) ? 1 : $the_page;
        $fav = get_user_meta($user_id, 'property_fav', true);

        if($fav && $fav != '') {

            $args = array(
                'post__in' => $fav,
                'posts_per_page' => $posts_per_page,
                'paged' => $page,
                'post_type' => 'property',
                'post_status' => 'publish',
                'ignore_sticky_posts' => true
            );

            $query = new WP_Query($args);

            $props = array();
            $reales_general_settings = get_option('reales_general_settings');

            while($query->have_posts()) {
                $query->the_post();

                $post_id = get_the_ID();
                $prop = new stdClass();

                $prop->id = $post_id;
                $prop->title = get_the_title();
                $prop->link = get_permalink($post_id);
                $prop->lat = get_post_meta($post_id, 'property_lat', true);
                $prop->lng = get_post_meta($post_id, 'property_lng', true);
                $prop->address = get_post_meta($post_id, 'property_address', true);
                $prop->state = get_post_meta($post_id, 'property_state', true);
                $prop->zip = get_post_meta($post_id, 'property_zip', true);
                $prop->country = get_post_meta($post_id, 'property_country', true);
                $prop->price = get_post_meta($post_id, 'property_price', true);
                $prop->currency = isset($reales_general_settings['reales_currency_symbol_field']) ? $reales_general_settings['reales_currency_symbol_field'] : '';
                $prop->currency_pos = isset($reales_general_settings['reales_currency_symbol_pos_field']) ? $reales_general_settings['reales_currency_symbol_pos_field'] : '';
                $prop->price_label = get_post_meta($post_id, 'property_price_label', true);
                $prop->area = get_post_meta($post_id, 'property_area', true);
                $prop->unit = isset($reales_general_settings['reales_unit_field']) ? $reales_general_settings['reales_unit_field'] : '';
                $prop->bedrooms = get_post_meta($post_id, 'property_bedrooms', true);
                $prop->bathrooms = get_post_meta($post_id, 'property_bathrooms', true);
                $prop->featured = get_post_meta($post_id, 'property_featured', true);
                $prop->category =  wp_get_post_terms($post_id, 'property_category');
                $prop->type =  wp_get_post_terms($post_id, 'property_type_category');

                $city = get_post_meta($post_id, 'property_city', true);
                $reales_prop_fields_settings = get_option('reales_prop_fields_settings');
                $p_city_t = isset($reales_prop_fields_settings['reales_p_city_t_field']) ? $reales_prop_fields_settings['reales_p_city_t_field'] : '';
                if($p_city_t == 'list') {
                    $reales_cities_settings = get_option('reales_cities_settings');
                    $prop->city = $city;
                    if(is_array($reales_cities_settings) && count($reales_cities_settings) > 0) {
                        uasort($reales_cities_settings, "reales_compare_position");
                        foreach ($reales_cities_settings as $key => $value) {
                            if ($city == $key) {
                                $prop->city = $value['name'];
                            }
                        }
                    }
                } else {
                    $prop->city = $city;
                }

                $gallery = get_post_meta($post_id, 'property_gallery', true);
                $images = explode("~~~", $gallery);

                // aq_resize( $url, $width, $height, $crop, $single, $upscale );
                $img_resize = aq_resize($images[1], 400, 240, true);

                $thumb = '';
                if($img_resize !== false) {
                    $thumb = $img_resize;
                } else {
                    $thumb = $images[1];
                }
                $prop->thumb = $thumb;

                array_push($props, $prop);
            }

            wp_reset_postdata();

            if(count($props) > 0) {
                echo json_encode(array('getprops'=>true, 'props'=>$props));
                exit();
            } else {
                echo json_encode(array('getprops'=>false));
                exit();
            }
        } else {
            echo json_encode(array('getprops'=>false));
            exit();
        }

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_get_fav_properties', 'reales_get_fav_properties' );
add_action( 'wp_ajax_reales_get_fav_properties', 'reales_get_fav_properties' );

/**
 * Get agent properties
 */
if( !function_exists('reales_get_agent_properties') ): 
    function reales_get_agent_properties() {
        check_ajax_referer('app_map_ajax_nonce', 'security');

        $agent_id = isset($_POST['agent_id']) ? sanitize_text_field($_POST['agent_id']) : '';

        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'property',
            'post_status' => 'publish'
        );

        $args['meta_query'] = array(
            array(
                'key'     => 'property_agent',
                'value'   => $agent_id,
            )
        );


        $query = new WP_Query($args);

        $props = array();
        $reales_general_settings = get_option('reales_general_settings');

        while($query->have_posts()) {
            $query->the_post();

            $post_id = get_the_ID();
            $prop = new stdClass();

            $prop->id = $post_id;
            $prop->title = get_the_title();
            $prop->link = get_permalink($post_id);
            $prop->lat = get_post_meta($post_id, 'property_lat', true);
            $prop->lng = get_post_meta($post_id, 'property_lng', true);
            $prop->address = get_post_meta($post_id, 'property_address', true);
            $prop->state = get_post_meta($post_id, 'property_state', true);
            $prop->zip = get_post_meta($post_id, 'property_zip', true);
            $prop->country = get_post_meta($post_id, 'property_country', true);
            $prop->price = get_post_meta($post_id, 'property_price', true);
            $prop->currency = isset($reales_general_settings['reales_currency_symbol_field']) ? $reales_general_settings['reales_currency_symbol_field'] : '';
            $prop->currency_pos = isset($reales_general_settings['reales_currency_symbol_pos_field']) ? $reales_general_settings['reales_currency_symbol_pos_field'] : '';
            $prop->price_label = get_post_meta($post_id, 'property_price_label', true);
            $prop->area = get_post_meta($post_id, 'property_area', true);
            $prop->unit = isset($reales_general_settings['reales_unit_field']) ? $reales_general_settings['reales_unit_field'] : '';
            $prop->bedrooms = get_post_meta($post_id, 'property_bedrooms', true);
            $prop->bathrooms = get_post_meta($post_id, 'property_bathrooms', true);
            $prop->featured = get_post_meta($post_id, 'property_featured', true);
            $prop->category =  wp_get_post_terms($post_id, 'property_category');
            $prop->type =  wp_get_post_terms($post_id, 'property_type_category');

            $city = get_post_meta($post_id, 'property_city', true);
            $reales_prop_fields_settings = get_option('reales_prop_fields_settings');
            $p_city_t = isset($reales_prop_fields_settings['reales_p_city_t_field']) ? $reales_prop_fields_settings['reales_p_city_t_field'] : '';
            if($p_city_t == 'list') {
                $reales_cities_settings = get_option('reales_cities_settings');
                $prop->city = $city;
                if(is_array($reales_cities_settings) && count($reales_cities_settings) > 0) {
                    uasort($reales_cities_settings, "reales_compare_position");
                    foreach ($reales_cities_settings as $key => $value) {
                        if ($city == $key) {
                            $prop->city = $value['name'];
                        }
                    }
                }
            } else {
                $prop->city = $city;
            }

            $gallery = get_post_meta($post_id, 'property_gallery', true);
            $images = explode("~~~", $gallery);

            // aq_resize( $url, $width, $height, $crop, $single, $upscale );
            $img_resize = aq_resize($images[1], 400, 240, true);

            $thumb = '';
            if($img_resize !== false) {
                $thumb = $img_resize;
            } else {
                $thumb = $images[1];
            }
            $prop->thumb = $thumb;

            array_push($props, $prop);
        }

        wp_reset_postdata();

        if(count($props) > 0) {
            echo json_encode(array('getprops'=>true, 'props'=>$props));
            exit();
        } else {
            echo json_encode(array('getprops'=>false));
            exit();
        }

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_get_agent_properties', 'reales_get_agent_properties' );
add_action( 'wp_ajax_reales_get_agent_properties', 'reales_get_agent_properties' );

if( !function_exists('reales_notify_agent_on_publish') ): 
    function reales_notify_agent_on_publish( $ID, $post ) {
        $author = $post->post_author;
        $name = get_the_author_meta( 'display_name', $author );
        $email = get_the_author_meta( 'user_email', $author );
        $title = $post->post_title;
        $permalink = get_permalink( $ID );
        $edit = get_edit_post_link( $ID, '' );

        $to[] = sprintf( '%s <%s>', $name, $email );
        $message = sprintf ( __('Congratulations, %s! Your property "%s" has been published.', 'reales') . "\n\n", $name, $title );
        $message .= sprintf( __('View: %s', 'reales'), $permalink );
        $headers = 'From: noreply  <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n" .
                'Reply-To: noreply@' . $_SERVER['HTTP_HOST'] . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        wp_mail(
            $to,
            sprintf( __('[%s] Property Published: %s', 'reales'), get_option('blogname'), $title ),
            $message,
            $headers
        );
    }
endif;
$reales_notifications_settings = get_option('reales_notifications_settings');
$notify_agent = isset($reales_notifications_settings['reales_notify_agent_publish_field']) ? $reales_notifications_settings['reales_notify_agent_publish_field'] : '';
if($notify_agent == 1) {
    add_action('publish_property', 'reales_notify_agent_on_publish', 10, 2);
}

if( !function_exists('reales_get_favourites_count') ): 
    function reales_get_favourites_count($id) {
        $users = get_users();
        $favs = 0;

        foreach ($users as $user) {
            $user_fav = get_user_meta($user->data->ID, 'property_fav', true);
            if(is_array($user_fav) && in_array($id, $user_fav)) {
                $favs = $favs + 1;
            }
        }

        return $favs;
    }
endif;

/**
 * Print property
 */
if( !function_exists('reales_print_property') ): 
    function reales_print_property() {
        check_ajax_referer('print_ajax_nonce', 'security');

        $propID = isset($_POST['propID']) ? sanitize_text_field($_POST['propID']) : '';

        // property details
        $title                       = get_the_title($propID);
        $reales_prop_fields_settings = get_option('reales_prop_fields_settings');
        $reales_general_settings     = get_option('reales_general_settings');
        $p_id                        = isset($reales_prop_fields_settings['reales_p_id_field']) ? $reales_prop_fields_settings['reales_p_id_field'] : '';
        $price_label                 = get_post_meta($propID, 'property_price_label', true);
        $price                       = get_post_meta($propID, 'property_price', true);
        $currency                    = isset($reales_general_settings['reales_currency_symbol_field']) ? $reales_general_settings['reales_currency_symbol_field'] : '';
        $currency_pos                = isset($reales_general_settings['reales_currency_symbol_pos_field']) ? $reales_general_settings['reales_currency_symbol_pos_field'] : '';
        $locale                      = isset($reales_general_settings['reales_locale_field']) ? $reales_general_settings['reales_locale_field'] : '';
        $decimals                    = isset($reales_general_settings['reales_decimals_field']) ? $reales_general_settings['reales_decimals_field'] : '';
        $category                    = wp_get_post_terms($propID, 'property_category');
        $type                        = wp_get_post_terms($propID, 'property_type_category');
        $gallery                     = get_post_meta($propID, 'property_gallery', true);
        $images                      = explode("~~~", $gallery);
        $address                     = get_post_meta($propID, 'property_address', true);
        $city                        = get_post_meta($propID, 'property_city', true);
        $p_city_t                    = isset($reales_prop_fields_settings['reales_p_city_t_field']) ? $reales_prop_fields_settings['reales_p_city_t_field'] : '';
        $state                       = get_post_meta($propID, 'property_state', true);
        $neighborhood                = get_post_meta($propID, 'property_neighborhood', true);
        $zip                         = get_post_meta($propID, 'property_zip', true);
        $country                     = get_post_meta($propID, 'property_country', true);
        $bedrooms                    = get_post_meta($propID, 'property_bedrooms', true);
        $bathrooms                   = get_post_meta($propID, 'property_bathrooms', true);
        $area                        = get_post_meta($propID, 'property_area', true);
        $unit                        = isset($reales_general_settings['reales_unit_field']) ? $reales_general_settings['reales_unit_field'] : '';
        $page_data                   = get_page($propID);
        $reales_amenity_settings     = get_option('reales_amenity_settings');
        $reales_fields_settings      = get_option('reales_fields_settings');


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

        print '<html><head>';
        print '<link href="' . get_stylesheet_uri() . '" rel="stylesheet" type="text/css" /></head>';
        print '<script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>';
        print '<script>$(window).load(function(){ print(); });</script>';
        print '<body class="printBody">';
        print '<h1 class="printPageTitle">' . get_bloginfo('name') . '</h1>';
        print '<h2 class="printTitle">' . $title . '</h2>';
        if($p_id != '' && $p_id == 'enabled') {
            print '<p class="printSmall">' . __('Property ID', 'reales') . ': ' . $propID . '</p>';
        }
        print '<div class="printSmall">';
        if($category) { 
            print esc_html($category[0]->name);
        }
        print ' | ';
        if($type) {
            print esc_html($type[0]->name);
        }
        print '</div>';
        print '<div class="printPrice">' . __('Price', 'reales') . ': ';
        if($currency_pos == 'before') {
            print esc_html($currency) . esc_html($price) . ' ' . esc_html($price_label);
        } else {
            print esc_html($price) . esc_html($currency) . ' ' . esc_html($price_label);
        }
        print '</div>';
        print '<div class="printPropertyImage"><img src="' . esc_url($images[1]) . '"></div>';
        print '<h3 class="printSubtitle">' . __('Address', 'reales') . '</h3>';
        print '<div class="printAddress">';
        if($address != '') {
            print esc_html($address) . ', ';
        }
        if($neighborhood != '') {
            print esc_html($neighborhood) . ', ';
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

            echo esc_html($city) . ', ';
        }
        if($address != '' || $neighborhood != '' || $city != '') {
            print '<br />';
        }
        if($state != '') {
            print esc_html($state) . ', ';
        }
        if($zip != '') {
            print esc_html($zip) . ', ';
        }
        if($country != '') {
            print esc_html($country);
        }
        print '</div>';
        print '<h3 class="printSubtitle">' . __('Main features', 'reales') . '</h3>';
        print '<div class="printFeatures">';
        if($bedrooms != '') {
            print esc_html($bedrooms) . ' ' . __('Bedrooms', 'reales') . '<br>';
        }
        if($bathrooms != '') {
            print esc_html($bathrooms) . ' ' . __('Bathrooms', 'reales') . '<br>';
        }
        if($area != '') {
            print esc_html($area) . ' ' . esc_html($unit);
        }
        print '</div>';
        print '<h3 class="printSubtitle">' . __('Description', 'reales') . '</h3>';
        print '<div class="printDescription">';
        print $page_data->post_content;
        print '</div>';
        print '<h3 class="printSubtitle">' . __('Amenities', 'reales') . '</h3>';
        print '<div class="printAmenities">';
        if(is_array($reales_amenity_settings) && count($reales_amenity_settings) > 0) {
            uasort($reales_amenity_settings, "reales_compare_position");
            $amenities_count = 0;
            foreach($reales_amenity_settings as $key => $value) {
                $am_label = $value['label'];
                if(function_exists('icl_translate')) {
                    $am_label = icl_translate('reales', 'reales_property_amenity_' . $value['label'], $value['label']);
                }
                if(get_post_meta($propID, $key, true) == 1) {
                    print esc_html($am_label) . '<br>';
                    $amenities_count++;
                }
            }
            if($amenities_count == 0) {
                esc_html_e('No amenities.', 'reales');
            }
        }
        print '</div>';
        print '<h3 class="printSubtitle">' . __('Additional Information', 'reales') . '</h3>';
        print '<div class="printAdditionalInfo">';
        if(is_array($reales_fields_settings)) {
            uasort($reales_fields_settings, "reales_compare_position");
            $fields_no = 0;
            foreach($reales_fields_settings as $key => $value) {
                $cf_label = $value['label'];
                if(function_exists('icl_translate')) {
                    $cf_label = icl_translate('reales', 'reales_property_field_' . $value['label'], $value['label']);
                }
                $field_value = get_post_meta($propID, $key, true);
                if($field_value != '') {
                    if($value['type'] == 'list_field') {
                        $list = explode(',', $value['list']);
                        print '<strong>' . esc_html($cf_label) . '</strong>:' . ' ' . esc_html($list[$field_value]) . '<br>';
                    } else {
                        print '<strong>' . esc_html($cf_label) . '</strong>:' . ' ' . esc_html($field_value) . '<br>';
                    }
                    $fields_no++;
                }
            }
            if($fields_no == 0) {
                esc_html_e('No additional information.', 'reales');
            }
        }
        print '</div>';

        // agent details
        $agentID = get_post_meta($propID, 'property_agent', true);
        
        if($agentID != '') {
            $agent        = get_post($agentID);
            $agent_avatar = get_post_meta($agentID, 'agent_avatar', true);
            $agent_email  = get_post_meta($agentID, 'agent_email', true);
            $agent_phone  = get_post_meta($agentID, 'agent_phone', true);
            $agent_mobile = get_post_meta($agentID, 'agent_mobile', true);
            $agent_skype  = get_post_meta($agentID, 'agent_skype', true);
            $agent_agency = get_post_meta($agentID, 'agent_agency', true);

            if($agent_avatar != '') {
                $avatar = $agent_avatar;
            } else {
                $avatar = get_template_directory_uri() . '/images/avatar.png';
            }

            print '<h3 class="printSubtitle">' . __('Agent', 'reales') . '</h3>';
            print '<div class="printAvatar"><img src="' . esc_url($avatar) . '"></div>';
            print '<strong>' . __('Agency', 'reales') . ': </strong>' . esc_html($agent_agency) . '<br>';
            print '<strong>' . __('Name', 'reales') . ': </strong>' . esc_html($agent->post_title) . '<br>';
            print '<strong>' . __('Phone', 'reales') . ': </strong>' . esc_html($agent_phone) . '<br>';
            print '<strong>' . __('Mobile', 'reales') . ': </strong>' . esc_html($agent_mobile) . '<br>';
            print '<strong>' . __('Skype', 'reales') . ': </strong>' . esc_html($agent_skype) . '<br>';
            print '<strong>' . __('Email', 'reales') . ': </strong>' . esc_html($agent_email) . '<br>';

            wp_reset_postdata();
            wp_reset_query();
        }

        print '</body></html>';

        exit();

        die();
    }
endif;
add_action( 'wp_ajax_nopriv_reales_print_property', 'reales_print_property' );
add_action( 'wp_ajax_reales_print_property', 'reales_print_property' );
?>
<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if( !function_exists('reales_search_properties') ): 
    function reales_search_properties() {
        $search_id                  = isset($_GET['search_id']) ? sanitize_text_field($_GET['search_id']) : '';
        $search_keywords            = isset($_GET['search_keywords']) ? sanitize_text_field($_GET['search_keywords']) : '';
        $search_country             = isset($_GET['search_country']) ? sanitize_text_field($_GET['search_country']) : '';
        $search_state               = isset($_GET['search_state']) ? sanitize_text_field($_GET['search_state']) : '';
        $search_city                = isset($_GET['search_city']) ? stripslashes(sanitize_text_field($_GET['search_city'])) : '';
        $search_category            = isset($_GET['search_category']) ? sanitize_text_field($_GET['search_category']) : '0';
        $search_type                = isset($_GET['search_type']) ? sanitize_text_field($_GET['search_type']) : '0';
        $search_min_price           = isset($_GET['search_min_price']) ? sanitize_text_field($_GET['search_min_price']) : '';
        $search_max_price           = isset($_GET['search_max_price']) ? sanitize_text_field($_GET['search_max_price']) : '';
        $search_bedrooms            = isset($_GET['search_bedrooms']) ? sanitize_text_field($_GET['search_bedrooms']) : '';
        $search_bathrooms           = isset($_GET['search_bathrooms']) ? sanitize_text_field($_GET['search_bathrooms']) : '';
        $search_neighborhood        = isset($_GET['search_neighborhood']) ? stripslashes(sanitize_text_field($_GET['search_neighborhood'])) : '';
        $search_min_area            = isset($_GET['search_min_area']) ? sanitize_text_field($_GET['search_min_area']) : '';
        $search_max_area            = isset($_GET['search_max_area']) ? sanitize_text_field($_GET['search_max_area']) : '';
        $featured                   = isset($_GET['featured']) ? sanitize_text_field($_GET['featured']) : '';
        $reales_appearance_settings = get_option('reales_appearance_settings');
        $posts_per_page_setting     = isset($reales_appearance_settings['reales_properties_per_page_field']) ? $reales_appearance_settings['reales_properties_per_page_field'] : '';
        $posts_per_page             = $posts_per_page_setting != '' ? $posts_per_page_setting : 10;
        $sort                       = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'newest';

        global $paged;

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'posts_per_page' => $posts_per_page,
            'paged'          => $paged,
            's'              => $search_keywords,
            'post_type'      => 'property',
            'post_status'    => 'publish'
        );

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

        $args['meta_query'] = array('relation' => 'AND');

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
                'type' => 'NUMERIC'
            ));
        }

        if($search_bathrooms != '' && $search_bathrooms != 0) {
            array_push($args['meta_query'], array(
                'key'     => 'property_bathrooms',
                'value'   => $search_bathrooms,
                'compare' => '>=',
                'type' => 'NUMERIC'
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

        $reales_amenity_settings = get_option('reales_amenity_settings');

        if(is_array($reales_amenity_settings) && count($reales_amenity_settings) > 0) {
            uasort($reales_amenity_settings, "reales_compare_position");
            foreach ($reales_amenity_settings as $key => $value) {
                if (isset($_GET[$key]) && esc_html($_GET[$key]) == 1) {
                    array_push($args['meta_query'], array(
                        'key'     => $key,
                        'value'   => 1
                    ));
                }
            }
        }

        // Custom fields search
        $reales_fields_settings = get_option('reales_fields_settings');
        if(is_array($reales_fields_settings)) {
            uasort($reales_fields_settings, "reales_compare_position");
            foreach ($reales_fields_settings as $key => $value) {
                if ($value['search'] == 'yes') {
                    $search_field     = isset($_GET[$key]) ? sanitize_text_field($_GET[$key]) : '';
                    $comparison       = $key . '_comparison';
                    $comparison_value = isset($_GET[$comparison]) ? sanitize_text_field($_GET[$comparison]) : '';
                    $operator         = '';
                    $value_type       = '';

                    switch ($comparison_value) {
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

                    switch ($value['type']) {
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

                    if($search_field != '') {
                        array_push($args['meta_query'], array(
                            'key'     => $key,
                            'value'   => $search_field,
                            'compare' => $operator,
                            'type'    => $value_type
                        ));
                    }
                }
            }
        }

        $query = new WP_Query($args);
        wp_reset_postdata();
        return $query;
    }
endif;

if( !function_exists('reales_get_search_link') ): 
    function reales_get_search_link() {
        $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'property-search-results.php'
        ));

        if($pages) {
            foreach ($pages as $page) {
                $search_submit = get_permalink($page->ID);
            }
        } else {
            $search_submit = '';
        }

        return $search_submit;
    }
endif;

?>
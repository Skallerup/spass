<?php
/**
 * @package WordPress
 * @subpackage Reales
 */
?>

<div class="similar">
    <h3><?php esc_html_e('Similar Properties', 'reales'); ?></h3>
    <?php
    $orig_post = $post;

    $orig_city = get_post_meta($post->ID, 'property_city', true);
    $orig_category =  wp_get_post_terms($post->ID, 'property_category', array('fields' => 'ids'));
    $orig_type =  wp_get_post_terms($post->ID, 'property_type_category', array('fields' => 'ids'));

    $exclude_ids = array($post->ID);
    $args = array(
        'posts_per_page'   => 4,
        'post_type'        => 'property',
        'suppress_filters' => false,
        'post_status'      => 'publish',
        'post__not_in'     => $exclude_ids
    );

    if($orig_type && $orig_category) {
        $args['tax_query'] = array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'property_category',
                'field'    => 'term_id',
                'terms'    => $orig_category[0],
            ),
            array(
                'taxonomy' => 'property_type_category',
                'field'    => 'term_id',
                'terms'    => $orig_type[0],
            ),
        );
    }

    $args['meta_query'] = array(
        array(
            'key'     => 'property_city',
            'value'   => $orig_city,
        )
    );

    $my_query = new wp_query($args);

    $reales_prop_fields_settings = get_option('reales_prop_fields_settings');
    $p_city_t = isset($reales_prop_fields_settings['reales_p_city_t_field']) ? $reales_prop_fields_settings['reales_p_city_t_field'] : '';

    if($my_query->have_posts() && $orig_type && $orig_category) { ?>
    <div class="row">
        <?php while( $my_query->have_posts() ) {
            $my_query->the_post();

            $s_id = get_the_ID();
            $s_link = get_permalink($s_id);
            $s_title = get_the_title($s_id);
            $reales_general_settings = get_option('reales_general_settings');
            $s_currency = isset($reales_general_settings['reales_currency_symbol_field']) ? $reales_general_settings['reales_currency_symbol_field'] : '';
            $s_currency_pos = isset($reales_general_settings['reales_currency_symbol_pos_field']) ? $reales_general_settings['reales_currency_symbol_pos_field'] : '';
            $s_price_label = get_post_meta($s_id, 'property_price_label', true);
            $s_address = get_post_meta($s_id, 'property_address', true);
            $s_city = get_post_meta($s_id, 'property_city', true);
            $s_state = get_post_meta($s_id, 'property_state', true);
            $s_neighborhood = get_post_meta($s_id, 'property_neighborhood', true);
            $s_zip = get_post_meta($s_id, 'property_zip', true);
            $s_country = get_post_meta($s_id, 'property_country', true);
            $s_type =  wp_get_post_terms($s_id, 'property_type_category');
            $s_featured = get_post_meta($s_id, 'property_featured', true);

            $s_locale = isset($reales_general_settings['reales_locale_field']) ? $reales_general_settings['reales_locale_field'] : '';
            $s_decimals = isset($reales_general_settings['reales_decimals_field']) ? $reales_general_settings['reales_decimals_field'] : '';
            $s_price = get_post_meta($s_id, 'property_price', true);
            setlocale(LC_MONETARY, $s_locale);
            if(is_numeric($s_price)) {
                if($s_decimals == 1) {
                    $s_price = money_format('%!i', $s_price);
                } else {
                    $s_price = money_format('%!.0i', $s_price);
                }
            } else {
                $s_price_label = '';
                $s_currency = '';
            }

            $s_gallery = get_post_meta($s_id, 'property_gallery', true);
            $s_images = explode("~~~", $s_gallery);

            // aq_resize( $url, $width, $height, $crop, $single, $upscale );
            $s_img_resize = aq_resize($s_images[1], 120, 120, true);

            $s_thumb = '';
            if($s_img_resize !== false) {
                $s_thumb = $s_img_resize;
            } else {
                $s_thumb = $s_images[1];
            }
        ?>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <a href="<?php echo esc_url($s_link); ?>" class="similarProp">
                <?php if($s_featured == 1) { ?>
                    <div class="featured-label">
                        <div class="featured-label-left"></div>
                        <div class="featured-label-content"><span class="fa fa-star"></span></div>
                        <div class="featured-label-right"></div>
                        <div class="clearfix"></div>
                    </div>
                <?php } ?>
                <div class="image"><img src="<?php echo esc_url($s_thumb); ?>" alt="<?php echo esc_attr($s_title); ?>"></div>
                <div class="info text-nowrap">
                    <div class="name"><?php echo esc_html($s_title); ?></div>
                    <div class="address">
                        <?php 
                        if($s_address != '') {
                            echo esc_html($s_address) . ', ';
                        }
                        if($s_neighborhood != '') {
                            echo esc_html($s_neighborhood) . ', ';
                        }
                        if($s_city != '') {
                            if($p_city_t == 'list') {
                                $reales_cities_settings = get_option('reales_cities_settings');
                                if(is_array($reales_cities_settings) && count($reales_cities_settings) > 0) {
                                    uasort($reales_cities_settings, "reales_compare_position");
                                    foreach ($reales_cities_settings as $key => $value) {
                                        if ($s_city == $key) {
                                            $s_city = $value['name'];
                                        }
                                    }
                                }
                            }

                            echo esc_html($s_city) . ', ';
                        }
                        if($s_state != '') {
                            echo esc_html($s_state) . ', ';
                        }
                        if($s_zip != '') {
                            echo esc_html($s_zip) . ', ';
                        }
                        if($s_country != '') {
                            echo esc_html($s_country);
                        }
                        ?>
                    </div>
                    <?php if($s_type) {
                        $s_type_name = $s_type[0]->name;
                    } else {
                        $s_type_name = '';
                    } ?>
                    <?php if($s_currency_pos == 'before') { ?>
                    <div class="price"><?php echo esc_html($s_currency) . esc_html($s_price) . ' ' . esc_html($s_price_label) . ' '; ?><span class="badge"><?php echo esc_html($s_type_name); ?></span></div>
                    <?php } else { ?>
                    <div class="price"><?php echo esc_html($s_price) . esc_html($s_currency) . ' ' . esc_html($s_price_label) . ' '; ?><span class="badge"><?php echo esc_html($s_type_name); ?></span></div>
                    <?php } ?>
                </div>
                <div class="clearfix"></div>
            </a>
        </div>
        <?php } ?>
    </div>

    <?php } else {
        print '<div class="noProp">' . __('No similar properties found.', 'reales') . '</div>';
    }

    $post = $orig_post;
    wp_reset_query();
    ?>
</div>

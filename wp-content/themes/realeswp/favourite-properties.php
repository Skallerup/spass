<?php
/*
Template Name: Favourite Properties
*/

/**
 * @package WordPress
 * @subpackage Reales
 */


$current_user = wp_get_current_user();
if (!is_user_logged_in()) {
    wp_redirect(home_url());
}

global $post;
get_header();
$reales_appearance_settings = get_option('reales_appearance_settings','');
$show_bc = isset($reales_appearance_settings['reales_breadcrumbs_field']) ? $reales_appearance_settings['reales_breadcrumbs_field'] : '';
$searched_posts = reales_search_fav_properties($current_user->ID);
if($searched_posts) {
    $total_p = $searched_posts->found_posts;
} else {
    $total_p = 0;
}
$users = get_users();
?>

<div id="wrapper">

    <div id="mapFavView">
        <div class="mapPlaceholder"><span class="fa fa-spin fa-spinner"></span> <?php esc_html_e('Loading map...', 'reales'); ?></div>
    </div>
    <?php wp_nonce_field('app_map_ajax_nonce', 'securityAppMap', true); ?>
    <div id="content">
        <?php get_template_part('templates/city_form'); ?>
        <div class="resultsList">
            <?php if($show_bc != '') {
                reales_breadcrumbs();
            } ?>
            <h1 class="pull-left"><?php echo esc_html($post->post_title); ?></h1>
            <input type="hidden" id="user_id" name="user_id" value="<?php echo esc_attr($current_user->ID); ?>">
            <div class="pull-right search_prop_calc_top"><?php echo esc_html($total_p . __(' Properties found', 'reales')); ?></div>
            <div class="clearfix"></div>
            <div class="row">
            <?php
            if($searched_posts) {
                while ( $searched_posts->have_posts() ) {
                    $searched_posts->the_post();
                    $prop_id = get_the_ID();

                    $gallery = get_post_meta($prop_id, 'property_gallery', true);
                    $images = explode("~~~", $gallery);
                    $reales_general_settings = get_option('reales_general_settings');
                    $currency = isset($reales_general_settings['reales_currency_symbol_field']) ? $reales_general_settings['reales_currency_symbol_field'] : '';
                    $currency_pos = isset($reales_general_settings['reales_currency_symbol_pos_field']) ? $reales_general_settings['reales_currency_symbol_pos_field'] : '';
                    $price_label = get_post_meta($prop_id, 'property_price_label', true);
                    $address = get_post_meta($prop_id, 'property_address', true);
                    $city = get_post_meta($prop_id, 'property_city', true);
                    $state = get_post_meta($prop_id, 'property_state', true);
                    $neighborhood = get_post_meta($prop_id, 'property_neighborhood', true);
                    $zip = get_post_meta($prop_id, 'property_zip', true);
                    $country = get_post_meta($prop_id, 'property_country', true);
                    $type =  wp_get_post_terms($prop_id, 'property_type_category');
                    $bedrooms = get_post_meta($prop_id, 'property_bedrooms', true);
                    $bathrooms = get_post_meta($prop_id, 'property_bathrooms', true);
                    $area = get_post_meta($prop_id, 'property_area', true);
                    $unit = isset($reales_general_settings['reales_unit_field']) ? $reales_general_settings['reales_unit_field'] : '';
                    $featured = get_post_meta($prop_id, 'property_featured', true);

                    $locale = isset($reales_general_settings['reales_locale_field']) ? $reales_general_settings['reales_locale_field'] : '';
                    $decimals = isset($reales_general_settings['reales_decimals_field']) ? $reales_general_settings['reales_decimals_field'] : '';
                    $price = get_post_meta($prop_id, 'property_price', true);
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
                ?>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <a href="<?php echo esc_url(get_permalink($prop_id)); ?>" class="card" id="card-<?php echo esc_attr($prop_id); ?>">
                            <div class="figure">
                                <?php if($featured == 1) { ?>
                                    <div class="featured-label">
                                        <div class="featured-label-left"></div>
                                        <div class="featured-label-content"><span class="fa fa-star"></span></div>
                                        <div class="featured-label-right"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                <?php } ?>
                                <div class="img" style="background-image:url(<?php echo esc_url($thumb); ?>);"></div>
                                <div class="figCaption">
                                    <?php if($currency_pos == 'before') { ?>
                                    <div><?php echo esc_html($currency) . esc_html($price) . ' ' . esc_html($price_label); ?></div>
                                    <?php } else { ?>
                                    <div><?php echo esc_html($price) . esc_html($currency) . ' ' . esc_html($price_label); ?></div>
                                    <?php } ?>
                                    <span><span class="icon-eye"></span> <?php echo esc_html(reales_get_post_views($prop_id, '')); ?></span>
                                    <?php
                                    $favs = reales_get_favourites_count($prop_id);
                                    ?>
                                    <span><span class="icon-heart"></span> <?php echo esc_html($favs); ?></span>
                                    <span><span class="icon-bubble"></span> <?php comments_number('0', '1', '%'); ?></span>
                                </div>
                                <div class="figView"><span class="icon-eye"></span></div>
                                <?php if($type) { ?>
                                    <div class="figType"><?php echo esc_html($type[0]->name); ?></div>
                                <?php } ?>
                            </div>
                            <h2><?php the_title(); ?></h2>
                            <?php
                            $reales_prop_fields_settings = get_option('reales_prop_fields_settings');
                            $p_city_t = isset($reales_prop_fields_settings['reales_p_city_t_field']) ? $reales_prop_fields_settings['reales_p_city_t_field'] : '';

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
                            ?>
                            <div class="cardAddress"><?php echo esc_html($address) . ', ' . esc_html($neighborhood) . ', ' . esc_html($city) . '<br />' . esc_html($state) . ' ' . esc_html($zip) . ', ' . esc_html($country); ?></div>
                            <ul class="cardFeat">
                                <?php if($bedrooms != '') { ?>
                                    <li><span class="fa fa-moon-o"></span> <?php echo esc_html($bedrooms); ?></li>
                                <?php } ?>
                                <?php if($bathrooms != '') { ?>
                                    <li><span class="icon-drop"></span> <?php echo esc_html($bathrooms); ?></li>
                                <?php } ?>
                                <?php if($area != '') { ?>
                                    <li><span class="icon-frame"></span> <?php echo esc_html($area) . ' ' . esc_html($unit); ?></li>
                                <?php } ?>
                            </ul>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                <?php }
            } ?>
            </div>
            <div class="pull-left">
                <?php if($searched_posts) { reales_pagination($searched_posts->max_num_pages); } ?>
            </div>
            <div class="pull-right search_prop_calc">
                <?php
                $reales_appearance_settings = get_option('reales_appearance_settings');
                $per_p_setting = isset($reales_appearance_settings['reales_properties_per_page_field']) ? $reales_appearance_settings['reales_properties_per_page_field'] : '';
                $per_p = $per_p_setting != '' ? intval($per_p_setting) : 10;
                $page_no = (get_query_var('paged')) ? get_query_var('paged') : 1;

                $from_p = ($page_no == 1) ? 1 : $per_p * ($page_no - 1) + 1;
                $to_p = ($total_p - ($page_no - 1) * $per_p > $per_p) ? $per_p * $page_no : $total_p;
                echo esc_html($from_p) . ' - ' . esc_html($to_p) . __(' of ', 'reales') . esc_html($total_p) . __(' Properties found', 'reales');
                ?>
            </div>
            <div class="clearfix"></div>
        </div>

        <?php get_template_part('templates/mapview_footer'); ?>
    </div>

</div>

<?php
get_template_part('templates/app_footer');
?>
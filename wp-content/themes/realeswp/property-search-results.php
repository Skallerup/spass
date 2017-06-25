<?php
/*
Template Name: Property Search Results
*/

/**
 * @package WordPress
 * @subpackage Reales
 */

global $post;
get_header();
$reales_appearance_settings = get_option('reales_appearance_settings','');
$show_bc = isset($reales_appearance_settings['reales_breadcrumbs_field']) ? $reales_appearance_settings['reales_breadcrumbs_field'] : '';
$show_type_label = isset($reales_appearance_settings['reales_type_label_field']) ? $reales_appearance_settings['reales_type_label_field'] : '';
$nomap = isset($reales_appearance_settings['reales_nomap_field']) ? $reales_appearance_settings['reales_nomap_field'] : '';
$sidebar_position = isset($reales_appearance_settings['reales_sidebar_field']) ?  $reales_appearance_settings['reales_sidebar_field'] : '';
$sort = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'newest';
$searched_posts = reales_search_properties();
$total_p = $searched_posts->found_posts;
$users = get_users();
?>

<?php if($nomap != '1') { ?>
<div id="wrapper">
<?php } else { ?>
<style>
    body.page-template-property-search-results {
        overflow: auto !important;
    }
</style>
<div>
<?php } ?>

    <?php if($nomap != '1') { ?>
    <div id="mapView">
        <div class="mapPlaceholder"><span class="fa fa-spin fa-spinner"></span> <?php esc_html_e('Loading map...', 'reales'); ?></div>
    </div>
    <?php } ?>
    <?php wp_nonce_field('app_map_ajax_nonce', 'securityAppMap', true); ?>



    <?php if($nomap != '1') { ?>
    <div id="content">
    <?php } else { ?>
    <div class="page-wrapper no-map">
        <div class="page-content">
    <?php } ?>

        <?php get_template_part('templates/filter_properties'); ?>

        <?php if($nomap == '1') { ?>
            <div class="row">
                <?php if($sidebar_position == 'left') { ?>
                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        <div id="mapView">
                            <div class="mapPlaceholder"><span class="fa fa-spin fa-spinner"></span> <?php esc_html_e('Loading map...', 'reales'); ?></div>
                        </div>
                        <?php get_sidebar(); ?>
                    </div>
                <?php } ?>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
        <?php } ?>

        <div class="resultsList">
            <?php if($show_bc != '') {
                reales_breadcrumbs();
            } ?>
            
            <?php if(is_user_logged_in()) { ?>
            <a href="#" class="btn btn-green pull-right" id="save-search" data-toggle="modal" data-target="#save-search-modal"><?php echo esc_html_e('Save Search', 'reales'); ?></a>
            <?php } ?>

            <?php if($nomap != '1') { ?>
                <h1 class="pull-left"><?php echo esc_html($post->post_title); ?></h1>
                <div class="pull-right sort">
            <?php } else { ?>
                <div class="pull-left sort">
            <?php } ?>

                <div class="form-group">
                    <?php esc_html_e('Sort by:', 'reales'); ?>&nbsp;&nbsp;
                    <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-white dropdown-toggle">
                        <span class="dropdown-label"><?php esc_html_e('Newest', 'reales'); ?></span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-select sorter">
                        <?php 
                        $reales_prop_fields_settings = get_option('reales_prop_fields_settings');
                        $p_price                     = isset($reales_prop_fields_settings['reales_p_price_field']) ? $reales_prop_fields_settings['reales_p_price_field'] : '';
                        $p_bedrooms                  = isset($reales_prop_fields_settings['reales_p_bedrooms_field']) ? $reales_prop_fields_settings['reales_p_bedrooms_field'] : '';
                        $p_bathrooms                 = isset($reales_prop_fields_settings['reales_p_bathrooms_field']) ? $reales_prop_fields_settings['reales_p_bathrooms_field'] : '';
                        $p_area                      = isset($reales_prop_fields_settings['reales_p_area_field']) ? $reales_prop_fields_settings['reales_p_area_field'] : '';
                        ?>
                        <li class="active"><input type="radio" name="sort" value="newest" <?php if(!$sort || $sort == '' || $sort == 'newest') { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);"><?php esc_html_e('Newest', 'reales'); ?></a></li>
                        <?php if($p_price != '' && $p_price == 'enabled') { ?>
                            <li><input type="radio" name="sort" value="price_lo" <?php if($sort && $sort != '' && $sort == 'price_lo') { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);"><?php esc_html_e('Price (Lo-Hi)', 'reales'); ?></a></li>
                            <li><input type="radio" name="sort" value="price_hi" <?php if($sort && $sort != '' && $sort == 'price_hi') { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);"><?php esc_html_e('Price (Hi-Lo)', 'reales'); ?></a></li>
                        <?php } ?>
                        <?php if($p_bedrooms != '' && $p_bedrooms == 'enabled') { ?>
                            <li><input type="radio" name="sort" value="bedrooms" <?php if($sort && $sort != '' && $sort == 'bedrooms') { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);"><?php esc_html_e('Bedrooms', 'reales'); ?></a></li>
                        <?php } ?>
                        <?php if($p_bathrooms != '' && $p_bathrooms == 'enabled') { ?>
                            <li><input type="radio" name="sort" value="bathrooms" <?php if($sort && $sort != '' && $sort == 'bathrooms') { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);"><?php esc_html_e('Bathrooms', 'reales'); ?></a></li>
                        <?php } ?>
                        <?php if($p_area != '' && $p_area == 'enabled') { ?>
                            <li><input type="radio" name="sort" value="area" <?php if($sort && $sort != '' && $sort == 'area') { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);"><?php esc_html_e('Area', 'reales'); ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
            <?php
            if($searched_posts->have_posts()) {
                while ( $searched_posts->have_posts() ) {
                    $searched_posts->the_post();

                    $prop_id                 = get_the_ID();
                    $gallery                 = get_post_meta($prop_id, 'property_gallery', true);
                    $images                  = explode("~~~", $gallery);
                    $reales_general_settings = get_option('reales_general_settings');
                    $currency                = isset($reales_general_settings['reales_currency_symbol_field']) ? $reales_general_settings['reales_currency_symbol_field'] : '';
                    $currency_pos            = isset($reales_general_settings['reales_currency_symbol_pos_field']) ? $reales_general_settings['reales_currency_symbol_pos_field'] : '';
                    $price_label             = get_post_meta($prop_id, 'property_price_label', true);
                    $address                 = get_post_meta($prop_id, 'property_address', true);
                    $city                    = get_post_meta($prop_id, 'property_city', true);
                    $state                   = get_post_meta($prop_id, 'property_state', true);
                    $neighborhood            = get_post_meta($prop_id, 'property_neighborhood', true);
                    $zip                     = get_post_meta($prop_id, 'property_zip', true);
                    $country                 = get_post_meta($prop_id, 'property_country', true);
                    $type                    = wp_get_post_terms($prop_id, 'property_type_category');
                    $bedrooms                = get_post_meta($prop_id, 'property_bedrooms', true);
                    $bathrooms               = get_post_meta($prop_id, 'property_bathrooms', true);
                    $area                    = get_post_meta($prop_id, 'property_area', true);
                    $unit                    = isset($reales_general_settings['reales_unit_field']) ? $reales_general_settings['reales_unit_field'] : '';
                    $featured                = get_post_meta($prop_id, 'property_featured', true);

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
                            <div class="cardAddress">
                                <?php 
                                if($address != '') {
                                    echo esc_html($address) . ', ';
                                }
                                if($neighborhood != '') {
                                    echo esc_html($neighborhood) . ', ';
                                }
                                $p_city_t = isset($reales_prop_fields_settings['reales_p_city_t_field']) ? $reales_prop_fields_settings['reales_p_city_t_field'] : '';
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

                                    echo esc_html($city);
                                }
                                if($address != '' || $neighborhood != '' || $city != '') {
                                    echo '<br />';
                                }
                                if($state != '') {
                                    echo esc_html($state) . ', ';
                                }
                                if($zip != '') {
                                    echo esc_html($zip) . ', ';
                                }
                                echo esc_html($country);
                                ?>
                            </div>
                            <ul class="cardFeat">
                                <?php if($bedrooms !== '') { ?>
                                    <li><span class="fa fa-moon-o"></span> <?php echo esc_html($bedrooms); ?></li>
                                <?php } ?>
                                <?php if($bathrooms !== '') { ?>
                                    <li><span class="icon-drop"></span> <?php echo esc_html($bathrooms); ?></li>
                                <?php } ?>
                                <?php if($area !== '') { ?>
                                    <li><span class="icon-frame"></span> <?php echo esc_html($area) . ' ' . esc_html($unit); ?></li>
                                <?php } ?>
                            </ul>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                <?php } 
            } else { ?>
                <div style="height: 300px;"></div>
            <?php } ?>
            </div>
            <div class="pull-left">
                <?php reales_pagination($searched_posts->max_num_pages); ?>
            </div>
            <div class="pull-right search_prop_calc">
                <?php
                $reales_appearance_settings = get_option('reales_appearance_settings');
                $per_p_field = isset($reales_appearance_settings['reales_properties_per_page_field']) ? $reales_appearance_settings['reales_properties_per_page_field'] : '';
                $per_p = $per_p_field != '' ? intval($per_p_field) : 10;
                $page_no = (get_query_var('paged')) ? get_query_var('paged') : 1;

                $from_p = ($page_no == 1) ? 1 : $per_p * ($page_no - 1) + 1;
                $to_p = ($total_p - ($page_no - 1) * $per_p > $per_p) ? $per_p * $page_no : $total_p;
                echo esc_html($from_p) . ' - ' . esc_html($to_p) . __(' of ', 'reales') . esc_html($total_p) . __(' Properties found', 'reales');
                ?>
            </div>
            <div class="clearfix"></div>
        </div>

        <?php if($nomap == '1') { ?>
            </div>
            <?php if($sidebar_position == 'right') { ?>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div id="mapView">
                        <div class="mapPlaceholder"><span class="fa fa-spin fa-spinner"></span> <?php esc_html_e('Loading map...', 'reales'); ?></div>
                    </div>
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>
            </div>
        <?php } ?>
    
    <?php if($nomap != '1') {
        get_template_part('templates/mapview_footer'); ?>
    </div>
    <?php } else { ?>
    </div></div>
    <?php } ?>

</div>

<div class="modal fade" id="save-search-modal" role="dialog" aria-labelledby="save-search-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-close"></span></button>
                <h4 class="modal-title" id="save-search-label"><?php esc_html_e('Save Search', 'reales') ?></h4>
            </div>
            <div class="modal-body">
                <form id="save-search-form">
                    <div class="save-search-message" id="save-search-message"></div>
                    <div class="form-group">
                        <label for="save-search-name"><?php esc_html_e('Name', 'reales'); ?></label>
                        <input type="text" id="save-search-name" name="save-search-name" placeholder="<?php esc_html_e('Enter a name for your search', 'reales'); ?>" class="form-control">
                        <?php $current_user = wp_get_current_user(); ?>
                        <input type="hidden" id="save-search-user" name="save-search-user" value="<?php echo esc_attr($current_user->ID); ?>">
                    </div>
                    <?php wp_nonce_field('savesearch_ajax_nonce', 'securitySaveSearch', true); ?>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-gray"><?php esc_html_e('Cancel', 'reales'); ?></a>
                <a href="javascript:void(0);" class="btn btn-green" id="save-search-btn"><?php esc_html_e('Save', 'reales'); ?></a>
            </div>
        </div>
    </div>
</div>

<?php
if($nomap != '1') {
    get_template_part('templates/app_footer');
} else {
    get_footer();
}
?>
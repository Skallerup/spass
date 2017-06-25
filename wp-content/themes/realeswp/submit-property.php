<?php
/*
Template Name: Submit Property
*/

/**
 * @package WordPress
 * @subpackage Reales
 */


$current_user = wp_get_current_user();
if (!is_user_logged_in() || reales_check_user_agent($current_user->ID) === false) {
    wp_redirect(home_url());
}

global $post;
get_header();
$cat_taxonomies = array( 
    'property_category'
);
$cat_args = array(
    'orderby'           => 'name', 
    'order'             => 'ASC',
    'hide_empty'        => false
); 
$cat_terms = get_terms($cat_taxonomies, $cat_args);
$type_taxonomies = array( 
    'property_type_category'
);
$type_args = array(
    'orderby'           => 'name', 
    'order'             => 'ASC',
    'hide_empty'        => false
);
$type_terms = get_terms($type_taxonomies, $type_args);
$reales_general_settings = get_option('reales_general_settings');
$reales_amenity_settings = get_option('reales_amenity_settings');
$reales_fields_settings = get_option('reales_fields_settings');
$reales_prop_fields_settings = get_option('reales_prop_fields_settings');
$p_price = isset($reales_prop_fields_settings['reales_p_price_field']) ? $reales_prop_fields_settings['reales_p_price_field'] : '';
$p_price_r = isset($reales_prop_fields_settings['reales_p_price_r_field']) ? $reales_prop_fields_settings['reales_p_price_r_field'] : '';
$p_description = isset($reales_prop_fields_settings['reales_p_description_field']) ? $reales_prop_fields_settings['reales_p_description_field'] : '';
$p_description_r = isset($reales_prop_fields_settings['reales_p_description_r_field']) ? $reales_prop_fields_settings['reales_p_description_r_field'] : '';
$p_category = isset($reales_prop_fields_settings['reales_p_category_field']) ? $reales_prop_fields_settings['reales_p_category_field'] : '';
$p_category_r = isset($reales_prop_fields_settings['reales_p_category_r_field']) ? $reales_prop_fields_settings['reales_p_category_r_field'] : '';
$p_type = isset($reales_prop_fields_settings['reales_p_type_field']) ? $reales_prop_fields_settings['reales_p_type_field'] : '';
$p_type_r = isset($reales_prop_fields_settings['reales_p_type_r_field']) ? $reales_prop_fields_settings['reales_p_type_r_field'] : '';
$p_city = isset($reales_prop_fields_settings['reales_p_city_field']) ? $reales_prop_fields_settings['reales_p_city_field'] : '';
$p_city_r = isset($reales_prop_fields_settings['reales_p_city_r_field']) ? $reales_prop_fields_settings['reales_p_city_r_field'] : '';
$p_city_t = isset($reales_prop_fields_settings['reales_p_city_t_field']) ? $reales_prop_fields_settings['reales_p_city_t_field'] : '';
$p_coordinates = isset($reales_prop_fields_settings['reales_p_coordinates_field']) ? $reales_prop_fields_settings['reales_p_coordinates_field'] : '';
$p_coordinates_r = isset($reales_prop_fields_settings['reales_p_coordinates_r_field']) ? $reales_prop_fields_settings['reales_p_coordinates_r_field'] : '';
$p_address = isset($reales_prop_fields_settings['reales_p_address_field']) ? $reales_prop_fields_settings['reales_p_address_field'] : '';
$p_address_r = isset($reales_prop_fields_settings['reales_p_address_r_field']) ? $reales_prop_fields_settings['reales_p_address_r_field'] : '';
$p_neighborhood = isset($reales_prop_fields_settings['reales_p_neighborhood_field']) ? $reales_prop_fields_settings['reales_p_neighborhood_field'] : '';
$p_neighborhood_r = isset($reales_prop_fields_settings['reales_p_neighborhood_r_field']) ? $reales_prop_fields_settings['reales_p_neighborhood_r_field'] : '';
$p_zip = isset($reales_prop_fields_settings['reales_p_zip_field']) ? $reales_prop_fields_settings['reales_p_zip_field'] : '';
$p_zip_r = isset($reales_prop_fields_settings['reales_p_zip_r_field']) ? $reales_prop_fields_settings['reales_p_zip_r_field'] : '';
$p_state = isset($reales_prop_fields_settings['reales_p_state_field']) ? $reales_prop_fields_settings['reales_p_state_field'] : '';
$p_state_r = isset($reales_prop_fields_settings['reales_p_state_r_field']) ? $reales_prop_fields_settings['reales_p_state_r_field'] : '';
$p_country = isset($reales_prop_fields_settings['reales_p_country_field']) ? $reales_prop_fields_settings['reales_p_country_field'] : '';
$p_country_r = isset($reales_prop_fields_settings['reales_p_country_r_field']) ? $reales_prop_fields_settings['reales_p_country_r_field'] : '';
$p_area = isset($reales_prop_fields_settings['reales_p_area_field']) ? $reales_prop_fields_settings['reales_p_area_field'] : '';
$p_area_r = isset($reales_prop_fields_settings['reales_p_area_r_field']) ? $reales_prop_fields_settings['reales_p_area_r_field'] : '';
$p_bedrooms = isset($reales_prop_fields_settings['reales_p_bedrooms_field']) ? $reales_prop_fields_settings['reales_p_bedrooms_field'] : '';
$p_bathrooms = isset($reales_prop_fields_settings['reales_p_bathrooms_field']) ? $reales_prop_fields_settings['reales_p_bathrooms_field'] : '';
$p_plans = isset($reales_prop_fields_settings['reales_p_plans_field']) ? $reales_prop_fields_settings['reales_p_plans_field'] : '';
$p_video = isset($reales_prop_fields_settings['reales_p_video_field']) ? $reales_prop_fields_settings['reales_p_video_field'] : '';

if (isset($_GET['edit_id'])) {
    $edit_id = sanitize_text_field($_GET['edit_id']);
    
    $args = array(
        'p' => $edit_id,
        'post_type' => 'property',
        'post_status' => array('publish', 'pending')
    );

    $query = new WP_Query($args);

    while($query->have_posts()) {
        $query->the_post();

        $edit_title = get_the_title($edit_id);
        $edit_link = get_permalink($edit_id);
        $edit_content = get_the_content($edit_id);
        $edit_category =  wp_get_post_terms($edit_id, 'property_category');
        $edit_category_id = $edit_category ? $edit_category[0]->term_id : '';
        $edit_type =  wp_get_post_terms($edit_id, 'property_type_category', true);
        $edit_type_id = $edit_type ? $edit_type[0]->term_id : '';
        $edit_city = get_post_meta($edit_id, 'property_city', true);
        $edit_lat = get_post_meta($edit_id, 'property_lat', true);
        $edit_lng = get_post_meta($edit_id, 'property_lng', true);
        $edit_address = get_post_meta($edit_id, 'property_address', true);
        $edit_neighborhood = get_post_meta($edit_id, 'property_neighborhood', true);
        $edit_zip = get_post_meta($edit_id, 'property_zip', true);
        $edit_state = get_post_meta($edit_id, 'property_state', true);
        $edit_country = get_post_meta($edit_id, 'property_country', true);
        $edit_price = (get_post_meta($edit_id, 'property_price', true) != '') ? get_post_meta($edit_id, 'property_price', true) : '';
        $edit_price_label = get_post_meta($edit_id, 'property_price_label', true);
        $edit_area = get_post_meta($edit_id, 'property_area', true);
        $edit_bedrooms = get_post_meta($edit_id, 'property_bedrooms', true);
        $edit_bathrooms = get_post_meta($edit_id, 'property_bathrooms', true);
        $edit_gallery = get_post_meta($edit_id, 'property_gallery', true);
        $edit_plans = get_post_meta($edit_id, 'property_plans', true);
        $edit_video_source = get_post_meta($edit_id, 'property_video_source', true);
        $edit_video_id = get_post_meta($edit_id, 'property_video_id', true);
    }
    wp_reset_postdata();
    wp_reset_query();
} else {
    $edit_id = '';
}

$display_form = true;
?>

<div id="wrapper">

    <div id="mapNewView" class="mob-min">
        <div class="mapPlaceholder"><span class="fa fa-spin fa-spinner"></span> <?php esc_html_e('Loading map...', 'reales'); ?></div>
    </div>
    <div id="content" class="mob-max">
        <?php get_template_part('templates/city_form'); ?>
        <div class="rightContainer">
            <h1><?php echo esc_html($post->post_title); ?></h1>
            <?php
            $reales_membership_settings = get_option('reales_membership_settings');
            $pay_type                   = isset($reales_membership_settings['reales_paid_field']) ? $reales_membership_settings['reales_paid_field'] : '';
            $pay_currency               = isset($reales_membership_settings['reales_payment_currency_field']) ? $reales_membership_settings['reales_payment_currency_field'] : '';
            $standard_price             = isset($reales_membership_settings['reales_submission_price_field']) ? $reales_membership_settings['reales_submission_price_field'] : 'FREE';
            $featured_price             = isset($reales_membership_settings['reales_featured_price_field']) ? $reales_membership_settings['reales_featured_price_field'] : 'FREE';
            $standard_unlim             = isset($reales_membership_settings['reales_free_submissions_unlim_field']) ? $reales_membership_settings['reales_free_submissions_unlim_field'] : '';
            $agent_id                   = reales_get_agent_by_userid($current_user->ID);
            $agent_payment              = get_post_meta($agent_id, 'agent_payment', true);
            ?>
            <?php if($pay_type == 'listing' && $agent_payment != '1') { ?>
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <div class="icon"><span class="fa fa-info-circle"></span></div>
                    <strong><?php echo __('Please note that this is a paid submission.', 'reales'); ?></strong>
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                </div>
                <div class="submitPriceInfo">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="price-plan">
                                <div class="price-plan-title"><?php esc_html_e('Standard property', 'reales'); ?></div>
                                <div class="price-plan-price">
                                    <?php if($standard_unlim != '' && $standard_unlim == 1) { ?>
                                        <div class="price-plan-price-sum"><?php esc_html_e('Free', 'reales'); ?></div>
                                    <?php } else { ?>
                                        <div class="price-plan-price-sum"><?php echo esc_html($standard_price); ?><span> <?php echo esc_html($pay_currency); ?></span></div>
                                    <?php } ?>
                                </div>
                                <?php if($standard_unlim != '' && $standard_unlim == 1) { ?>
                                    <div class="price-plan-features"><span><?php esc_html_e('Free included', 'reales'); ?>: <strong><?php esc_html_e('unlimited', 'reales'); ?></strong></span></div>
                                <?php } else { 
                                    $standard_free_left = get_post_meta($agent_id, 'agent_free_listings', true); ?>
                                    <div class="price-plan-features"><span><?php esc_html_e('Free submissions left', 'reales'); ?>: <strong><?php if($standard_free_left == '' || $standard_free_left <= 0){ echo '0'; } else { echo esc_html($standard_free_left); } ?></strong></span></div>
                                    <input type="hidden" name="standard_free_left" id="standard_free_left" value="<?php echo esc_html($standard_free_left); ?>">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="price-plan">
                                <div class="price-plan-title"><?php esc_html_e('Featured property', 'reales'); ?></div>
                                <div class="price-plan-price">
                                    <div class="price-plan-price-sum">+ <?php echo esc_html($featured_price); ?><span> <?php echo esc_html($pay_currency); ?></span></div>
                                </div>
                                <?php $featured_free_left = get_post_meta($agent_id, 'agent_free_featured_listings', true); ?>
                                <div class="price-plan-features"><span><?php esc_html_e('Free submissions left', 'reales'); ?>: <strong><?php if($featured_free_left == '' || $featured_free_left <= 0){ echo '0'; } else { echo esc_html($featured_free_left); } ?></strong></span></div>
                                <input type="hidden" name="featured_free_left" id="featured_free_left" value="<?php echo esc_html($featured_free_left); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if($pay_type == 'membership' && $agent_payment != '1') {
                $plan_id                = get_post_meta($agent_id, 'agent_plan', true);
                $plan_listings          = get_post_meta($agent_id, 'agent_plan_listings', true);
                $plan_unlimited         = get_post_meta($agent_id, 'agent_plan_unlimited', true);
                $plan_activation        = strtotime(get_post_meta($agent_id, 'agent_plan_activation', true));
                $plan_time_unit         = get_post_meta($plan_id, 'membership_billing_time_unit', true);
                $plan_period            = get_post_meta($plan_id, 'membership_period', true);

                $seconds = 0;
                switch($plan_time_unit) {
                    case 'day':
                        $seconds = 60 * 60 * 24;
                    break;
                    case 'week':
                        $seconds = 60 * 60 * 24 * 7;
                    break;
                    case 'month':
                        $seconds = 60 * 60 * 24 * 30;
                    break;
                    case 'year':
                        $seconds = 60 * 60 * 24 * 365;
                    break;
                }

                $time_frame = $seconds * $plan_period;
                $expiration_date = $plan_activation + $time_frame;
                $expiration_date = date('Y-m-d', $expiration_date);
                $today = getdate();

                $no_listings = false;
                $expired = false;

                if(intval($plan_listings) <= 0) {
                    $display_form = false;
                    $no_listings = true;
                }
                if($plan_unlimited == '1') {
                    $display_form = true;
                    $no_listings = false;
                }
                if($today[0] > strtotime($expiration_date)) {
                    $display_form = false;
                    $expired = true;
                }
                if($edit_id != '') {
                    $display_form = true;
                    $expired = false;
                    $no_listings = false;
                }
            } ?>

            <?php if($display_form == true) { ?>
                <form id="submitProperty" name="submitProperty" method="post" action="" enctype="multipart/form-data">
                    <?php wp_nonce_field('submit_property_ajax_nonce', 'securitySubmitProperty', true); ?>
                    <input type="hidden" id="current_user" name="current_user" value="<?php echo esc_attr($current_user->ID); ?>">
                    <input type="hidden" id="new_id" name="new_id" value="<?php echo esc_attr($edit_id); ?>">
                    <input type="hidden" id="new_lat_h" name="new_lat_h" value="<?php echo isset($edit_lat) ? esc_attr($edit_lat) : ''; ?>">
                    <input type="hidden" id="new_lng_h" name="new_lng_h" value="<?php echo isset($edit_lng) ? esc_attr($edit_lng) : ''; ?>">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label><?php esc_html_e('Title', 'reales'); ?> <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="new_title" name="new_title" placeholder="<?php esc_html_e('Enter property title', 'reales'); ?>" value="<?php echo isset($edit_title) ? esc_attr($edit_title) : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <?php if($p_description != '' && $p_description == 'enabled') { ?>
                        <div class="form-group" id="isDesc">
                            <label><?php esc_html_e('Description', 'reales'); ?> 
                            <?php if($p_description_r != '' && $p_description_r == 'required') { ?>
                                <span class="text-red">*</span>
                            <?php } ?>
                            </label>
                            <?php 
                            $html_content = isset($edit_content) ? $edit_content : '';
                            $settings = array(
                                'teeny' => true
                            );
                            wp_editor($html_content, 'new_content', $settings);
                            ?>
                            <?php do_shortcode( sprintf( '[embed]%s[/embed]', get_post_meta( $post->ID, 'video_url', true ) ) ); ?>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <?php if($p_category != '' && $p_category == 'enabled') { ?>
                                <div class="form-group fg-inline">
                                    <label><?php esc_html_e('Category', 'reales'); ?> 
                                    <?php if($p_category_r != '' && $p_category_r == 'required') { ?>
                                        <span class="text-red">*</span>
                                    <?php } ?>
                                    </label>
                                    <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                        <span class="dropdown-label"><?php esc_html_e('Category', 'reales'); ?></span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-select">
                                        <li class="active"><input type="radio" name="new_category" value="0" <?php if(!isset($edit_category_id) || (isset($edit_category_id) && $edit_category_id == '') || (isset($edit_category_id) && $edit_category_id == 0)) { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);"><?php esc_html_e('Category', 'reales'); ?></a></li>
                                        <?php foreach($cat_terms as $cat_term) { ?>
                                        <li><input type="radio" name="new_category" value="<?php echo esc_attr($cat_term->term_id); ?>" <?php if(isset($edit_category_id) && $edit_category_id == $cat_term->term_id) { echo 'checked="checked"'; } ?>><a href="javascript:void(0);"><?php echo esc_html($cat_term->name); ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>
                            <?php if($p_type != '' && $p_type == 'enabled') { ?>
                                <div class="form-group fg-inline">
                                    <label><?php esc_html_e('Type', 'reales'); ?> 
                                    <?php if($p_type_r != '' && $p_type_r == 'required') { ?>
                                        <span class="text-red">*</span>
                                    <?php } ?>
                                    </label>
                                    <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                        <span class="dropdown-label"><?php esc_html_e('Type', 'reales'); ?></span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-select">
                                        <li class="active"><input type="radio" name="new_type" value="0" <?php if(!isset($edit_type_id) || (isset($edit_type_id) && $edit_type_id == '') || (isset($edit_type_id) && $edit_type_id == 0)) { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);"><?php esc_html_e('Type', 'reales'); ?></a></li>
                                        <?php foreach($type_terms as $type_term) { ?>
                                        <li><input type="radio" name="new_type" value="<?php echo esc_attr($type_term->term_id); ?>" <?php if(isset($edit_type_id) && $edit_type_id == $type_term->term_id) { echo 'checked="checked"'; } ?>><a href="javascript:void(0);"><?php echo esc_html($type_term->name); ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php if($p_city != '' && $p_city == 'enabled') { ?>
                        <div class="form-group">
                            <label><?php esc_html_e('City', 'reales'); ?> 
                            <?php if($p_city_r != '' && $p_city_r == 'required') { ?>
                                <span class="text-red">*</span>
                            <?php } ?>
                            </label>
                            <?php if($p_city_t == 'list') {
                                $reales_cities_settings = get_option('reales_cities_settings');

                                print '<select id="new_city" name="new_city" class="form-control">
                                            <option value="">' . __('Select a city', 'reales') . '</option>';
                                if(is_array($reales_cities_settings) && count($reales_cities_settings) > 0) {
                                    uasort($reales_cities_settings, "reales_compare_position");

                                    foreach ($reales_cities_settings as $key => $value) {
                                        print '<option value="' . $key . '"';
                                        if (isset($edit_city) && $edit_city != '' && $edit_city == $key) {
                                            print ' selected ';
                                        }
                                        print '>' . $value['name'] . '</option>';
                                    }
                                }
                                print '</select>';
                            } else { ?>
                                <input class="form-control auto" type="text" id="new_city" name="new_city" placeholder="<?php esc_html_e('Enter a city name', 'reales'); ?>" value="<?php echo isset($edit_city) ? esc_attr($edit_city) : ''; ?>" autocomplete="off">
                            <?php } ?>
                            <p class="help-block"><?php esc_html_e('You can drag the marker to property position', 'reales'); ?></p>
                        </div>
                    <?php } ?>
                    <?php if($p_coordinates != '' && $p_coordinates == 'enabled') { ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label><?php esc_html_e('Latitude', 'reales'); ?> 
                                    <?php if($p_coordinates_r != '' && $p_coordinates_r == 'required') { ?>
                                        <span class="text-red">*</span>
                                    <?php } ?>
                                    </label>
                                    <input type="text" class="form-control" id="new_lat" name="new_lat" placeholder="<?php esc_html_e('Enter latitude', 'reales'); ?>" value="<?php echo isset($edit_lat) ? esc_attr($edit_lat) : ''; ?>">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label><?php esc_html_e('Longitude', 'reales'); ?> 
                                    <?php if($p_coordinates_r != '' && $p_coordinates_r == 'required') { ?>
                                        <span class="text-red">*</span>
                                    <?php } ?>
                                    </label>
                                    <input type="text" class="form-control" id="new_lng" name="new_lng" placeholder="<?php esc_html_e('Enter longitude', 'reales'); ?>" value="<?php echo isset($edit_lng) ? esc_attr($edit_lng) : ''; ?>">
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <?php if($p_address != '' && $p_address == 'enabled') { ?>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label><?php esc_html_e('Address', 'reales'); ?> 
                                    <?php if($p_address_r != '' && $p_address_r == 'required') { ?>
                                        <span class="text-red">*</span>
                                    <?php } ?>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="new_address" name="new_address" placeholder="<?php esc_html_e('Enter address', 'reales'); ?>" value="<?php echo isset($edit_address) ? esc_attr($edit_address) : ''; ?>">
                                        <div class="input-group-addon" id="addressPinBtn" title="<?php esc_html_e('Place pin by address', 'reales'); ?>"><span class="icon-pointer"></span></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if($p_neighborhood != '' && $p_neighborhood == 'enabled') { ?>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label><?php esc_html_e('Neighborhood', 'reales'); ?> 
                                    <?php if($p_neighborhood_r != '' && $p_neighborhood_r == 'required') { ?>
                                        <span class="text-red">*</span>
                                    <?php } ?>
                                    </label>
                                    <input type="text" class="form-control" id="new_neighborhood" name="new_neighborhood" placeholder="<?php esc_html_e('Enter neighborhood', 'reales'); ?>" value="<?php echo isset($edit_neighborhood) ? esc_attr($edit_neighborhood) : ''; ?>">
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <?php if($p_zip != '' && $p_zip == 'enabled') { ?>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label><?php esc_html_e('Zip Code', 'reales'); ?> 
                                    <?php if($p_zip_r != '' && $p_zip_r == 'required') { ?>
                                        <span class="text-red">*</span>
                                    <?php } ?>
                                    </label>
                                    <input type="text" class="form-control" id="new_zip" name="new_zip" placeholder="<?php esc_html_e('Enter zip code', 'reales'); ?>" value="<?php echo isset($edit_zip) ? esc_attr($edit_zip) : ''; ?>">
                                </div>
                            </div>
                        <?php } ?>
                        <?php if($p_state != '' && $p_state == 'enabled') { ?>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label><?php esc_html_e('County/State', 'reales'); ?> 
                                    <?php if($p_state_r != '' && $p_state_r == 'required') { ?>
                                        <span class="text-red">*</span>
                                    <?php } ?>
                                    </label>
                                    <input type="text" class="form-control" id="new_state" name="new_state" placeholder="<?php esc_html_e('Enter county/state', 'reales'); ?>" value="<?php echo isset($edit_state) ? esc_attr($edit_state) : ''; ?>">
                                </div>
                            </div>
                        <?php } ?>
                        <?php if($p_country != '' && $p_country == 'enabled') { ?>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label><?php esc_html_e('Country', 'reales'); ?> 
                                    <?php if($p_country_r != '' && $p_country_r == 'required') { ?>
                                        <span class="text-red">*</span>
                                    <?php } ?>
                                    </label>
                                    <?php
                                    $country_default = isset($reales_general_settings['reales_country_field']) ? $reales_general_settings['reales_country_field'] : '';
                                    if(isset($edit_country) && $edit_country != '') {
                                        print reales_new_country_list($edit_country);
                                    } else {
                                        print reales_new_country_list($country_default);
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <?php if($p_price != '' && $p_price == 'enabled') { ?>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <?php $currency = isset($reales_general_settings['reales_currency_symbol_field']) ? $reales_general_settings['reales_currency_symbol_field'] : ''; ?>
                                    <label><?php esc_html_e('Price', 'reales'); ?> 
                                    <?php if($p_price_r != '' && $p_price_r == 'required') { ?>
                                        <span class="text-red">*</span>
                                    <?php } ?>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><?php echo esc_html($currency); ?></div>
                                        <input type="text" class="form-control" id="new_price" name="new_price" placeholder="<?php esc_html_e('Enter price', 'reales'); ?>" value="<?php echo isset($edit_price) ? esc_attr($edit_price) : ''; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label><?php esc_html_e('Price Label (e.g. "per month")', 'reales'); ?></label>
                                    <input type="text" class="form-control" id="new_price_label" name="new_price_label" placeholder="<?php esc_html_e('Enter price label', 'reales'); ?>" value="<?php echo isset($edit_price_label) ? esc_attr($edit_price_label) : ''; ?>">
                                </div>
                            </div>
                        <?php } ?>
                        <?php if($p_area != '' && $p_area == 'enabled') { ?>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <?php $unit = isset($reales_general_settings['reales_unit_field']) ? $reales_general_settings['reales_unit_field'] : ''; ?>
                                    <label><?php esc_html_e('Area', 'reales'); ?> 
                                    <?php if($p_area_r != '' && $p_area_r == 'required') { ?>
                                        <span class="text-red">*</span>
                                    <?php } ?>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="new_area" name="new_area" placeholder="<?php esc_html_e('Enter area', 'reales'); ?>" value="<?php echo isset($edit_area) ? esc_attr($edit_area) : ''; ?>">
                                        <div class="input-group-addon"><?php echo esc_html($unit); ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <?php if($p_bedrooms != '' && $p_bedrooms == 'enabled') { ?>
                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label><?php esc_html_e('Bedrooms', 'reales'); ?></label>
                                    <div class="volume">
                                        <a href="javascript:void(0);" class="btn btn-gray btn-round-left"><span class="fa fa-angle-left"></span></a>
                                        <input type="text" class="form-control" readonly="readonly" name="new_bedrooms" id="new_bedrooms" value="<?php if(isset($edit_bedrooms) && $edit_bedrooms != '') { echo esc_attr($edit_bedrooms); } else { echo '0'; } ?>">
                                        <a href="javascript:void(0);" class="btn btn-gray btn-round-right"><span class="fa fa-angle-right"></span></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if($p_bathrooms != '' && $p_bathrooms == 'enabled') { ?>
                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label><?php esc_html_e('Bathrooms', 'reales'); ?></label>
                                    <div class="volume-half">
                                        <a href="javascript:void(0);" class="btn btn-gray btn-round-left"><span class="fa fa-angle-left"></span></a>
                                        <input type="text" class="form-control" readonly="readonly" name="new_bathrooms" id="new_bathrooms" value="<?php if(isset($edit_bathrooms) && $edit_bathrooms != '') { echo esc_attr($edit_bathrooms); } else { echo '0'; } ?>">
                                        <a href="javascript:void(0);" class="btn btn-gray btn-round-right"><span class="fa fa-angle-right"></span></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <?php
                    $reales_amenity_settings = get_option('reales_amenity_settings');

                    if(is_array($reales_amenity_settings) && count($reales_amenity_settings) > 0) {
                        uasort($reales_amenity_settings, "reales_compare_position");
                        print '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="form-group"><label>'. __('Amenities', 'reales') .'</label>';
                        print '<div class="row" id="new_amenities">';
                        foreach ($reales_amenity_settings as $key => $value) {
                            print '
                                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                    <div class="checkbox custom-checkbox">
                                        <label><input type="checkbox" name="' . esc_attr($key) . '" value="1" ';
                            if(isset($edit_id) && $edit_id != '') {
                                if(get_post_meta($edit_id, $key, true) == 1) {
                                    print ' checked ';
                                }
                            }
                            print           '><span class="fa fa-check"></span> ' . esc_html($value['label']) . '</label>
                                    </div>
                                </div>';
                        }
                        print '</div>';
                        print '</div></div></div>';
                    }
                    ?>

                    <?php
                    if(is_array($reales_fields_settings)) {
                        uasort($reales_fields_settings, "reales_compare_position");
                        print '<div class="row">';
                        foreach ($reales_fields_settings as $key => $value) {
                            print '<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>' . $value['label'];
                            $val_man = isset($value['mandatory']) ? $value['mandatory'] : '';
                            $val_label = isset($value['label']) ? $value['label'] : '';
                            if($val_man == 'yes') {
                                print ' <span class="text-red">*</span>';
                            }
                            print   '</label>';
                                    $field_value = isset($edit_id) ? esc_attr(get_post_meta($edit_id, $key, true)) : -1;
                                    if($value['type'] == 'date_field') {
                                        print '<input type="text" name="' . $key . '" id="' . $key . '" class="form-control datePicker customField" data-mandatory="' . esc_attr($val_man) . '" data-label="' . esc_attr($val_label) . '" value="' . $field_value . '" />';
                                    } else if($value['type'] == 'list_field') {
                                        $list = explode(',', $value['list']);
                                        print '<select name="' . $key . '" id="' . $key . '" class="form-control customField" data-mandatory="' . esc_attr($val_man) . '" data-label="' . esc_attr($val_label) . '">';
                                        print '<option value="">' . __('Select', 'reales') . '</option>';
                                        for($i = 0; $i < count($list); $i++) {
                                            print '<option value="' . $i . '"';
                                            if($field_value != '' && $field_value == $i) {
                                                print ' selected';
                                            }
                                            print '>' . $list[$i] . '</option>';
                                        }
                                        print '</select>';
                                    } else {
                                        print '<input type="text" name="' . $key . '" id="' . $key . '" class="form-control customField" data-mandatory="' . esc_attr($val_man) . '" data-label="' . esc_attr($val_label) . '" value="' . $field_value . '" />';
                                    }
                            print '</div>
                            </div>';
                        }
                        print '</div>';
                    }
                    ?>

                    <?php if($p_plans != '' && $p_plans == 'enabled') { ?>
                        <input type="hidden" name="edit_plans" id="edit_plans" value="<?php echo isset($edit_plans) ? esc_attr($edit_plans) : ''; ?>">
                        <?php get_template_part('templates/floor_plans_upload'); ?>
                    <?php } ?>

                    <?php if($p_video != '' && $p_video == 'enabled') { ?>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                <div class="form-group fg-inline">
                                    <label><?php esc_html_e('Video source', 'reales'); ?></label>
                                    <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                        <span class="dropdown-label"><?php esc_html_e('none', 'reales'); ?></span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-select">
                                        <li class="active"><input type="radio" name="new_video_source" value="" <?php if(!isset($edit_video_source) || (isset($edit_video_source) && $edit_video_source == '')) { echo 'checked="checked"'; } ?> ><a href="javascript:void(0);"><?php esc_html_e('none', 'reales'); ?></a></li>
                                        <li><input type="radio" name="new_video_source" value="youtube" <?php if(isset($edit_video_source) && $edit_video_source == 'youtube') { echo 'checked="checked"'; } ?>><a href="javascript:void(0);"><?php esc_html_e('youtube', 'reales'); ?></a></li>
                                        <li><input type="radio" name="new_video_source" value="vimeo" <?php if(isset($edit_video_source) && $edit_video_source == 'vimeo') { echo 'checked="checked"'; } ?>><a href="javascript:void(0);"><?php esc_html_e('vimeo', 'reales'); ?></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                <div class="formField">
                                    <label><?php esc_html_e('Video ID', 'reales'); ?></label>
                                    <input type="text" class="form-control" id="new_video_id" name="new_video_id" placeholder="<?php esc_html_e('Enter video ID', 'reales'); ?>" value="<?php echo isset($edit_video_id) ? esc_attr($edit_video_id) : ''; ?>">
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <input type="hidden" name="edit_gallery" id="edit_gallery" value="<?php echo isset($edit_gallery) ? esc_attr($edit_gallery) : ''; ?>">
                    <?php get_template_part('templates/gallery_upload'); ?>

                    <?php
                    $reales_captcha_settings = get_option('reales_captcha_settings');
                    $show_captcha = isset($reales_captcha_settings['reales_captcha_submit_field']) ? $reales_captcha_settings['reales_captcha_submit_field'] : false;
                    $site_key = isset($reales_captcha_settings['reales_captcha_site_key_field']) ? $reales_captcha_settings['reales_captcha_site_key_field'] : '';
                    $secret_key = isset($reales_captcha_settings['reales_captcha_secret_key_field']) ? $reales_captcha_settings['reales_captcha_secret_key_field'] : '';

                    if($show_captcha && $site_key != '' && $secret_key != '') {
                    ?>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="<?php echo esc_attr($site_key); ?>"></div>
                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <a href="javascript:void(0);" class="btn btn-green" id="submitPropertyBtn"><span class="fa fa-save"></span> <?php if(isset($edit_id) && $edit_id != '') { esc_html_e('Update Property', 'reales'); } else { esc_html_e('Submit Property', 'reales'); } ?></a>
                        <?php if(isset($edit_id) && $edit_id != '') { ?>
                            <?php if(get_post_status($edit_id) == 'publish') { ?>
                                <a href="<?php echo isset($edit_link) ? esc_url($edit_link) : '#'; ?>" class="btn btn-o btn-green" id="viewPropertyBtn"><span class="fa fa-eye"></span> <?php esc_html_e('View Property', 'reales'); ?></a>
                            <?php } ?>
                            <a href="javascript:void(0);" class="btn btn-o btn-red" id="deletePropertyBtn"><span class="fa fa-trash-o"></span> <?php esc_html_e('Delete Property', 'reales'); ?></a>
                        <?php } else { ?>
                            <a href="javascript:void(0);" class="btn btn-o btn-green" id="viewPropertyBtn" style="display:none;"><span class="fa fa-eye"></span> <?php esc_html_e('View Property', 'reales'); ?></a>
                            <a href="javascript:void(0);" class="btn btn-o btn-red" id="deletePropertyBtn" style="display:none;"><span class="fa fa-trash-o"></span> <?php esc_html_e('Delete Property', 'reales'); ?></a>
                        <?php } ?>
                    </div>
                </form>
            <?php } else if($expired == true) { ?>
                <div class="alert alert-danger fade in" role="alert">
                    <div class="icon"><span class="fa fa-ban"></span></div>
                    <strong><?php echo __('Your membership plan expired.', 'reales'); ?></strong><br />
                    <?php echo __('Please renew your membership plan if you want to submit new listings.', 'reales'); ?>
                </div>
            <?php } else { ?>
                <div class="alert alert-danger fade in" role="alert">
                    <div class="icon"><span class="fa fa-ban"></span></div>
                    <strong><?php echo __('You ran out of available submissions.', 'reales'); ?></strong><br />
                    <?php echo __('Please upgrade your membership plan if you want to submit new listings.', 'reales'); ?>
                </div>
            <?php } ?>
        </div>

        <?php get_template_part('templates/mapview_footer'); ?>
    </div>

</div>

<div class="modal fade" id="propertyModal" role="dialog" aria-labelledby="propertyLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div id="save_response"></div>
            </div>
        </div>
    </div>
</div>

<?php
get_template_part('templates/app_footer');
?>
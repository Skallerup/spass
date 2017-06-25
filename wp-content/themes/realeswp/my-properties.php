<?php
/*
Template Name: My Properties
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
$reales_appearance_settings = get_option('reales_appearance_settings','');
$show_bc                    = isset($reales_appearance_settings['reales_breadcrumbs_field']) ? $reales_appearance_settings['reales_breadcrumbs_field'] : '';
$reales_membership_settings = get_option('reales_membership_settings','');
$payment_type               = isset($reales_membership_settings['reales_paid_field']) ? $reales_membership_settings['reales_paid_field'] : '';
$payment_currency           = isset($reales_membership_settings['reales_payment_currency_field']) ? $reales_membership_settings['reales_payment_currency_field'] : '';
$standard_price             = isset($reales_membership_settings['reales_submission_price_field']) ? $reales_membership_settings['reales_submission_price_field'] : 'FREE';
$featured_price             = isset($reales_membership_settings['reales_featured_price_field']) ? $reales_membership_settings['reales_featured_price_field'] : 'FREE';
$agent_id                   = reales_get_agent_by_userid($current_user->ID);
$searched_posts             = reales_search_my_properties($agent_id);
$agent_payment              = get_post_meta($agent_id, 'agent_payment', true);
$total_p                    = $searched_posts->found_posts;
$users                      = get_users();
?>

<div id="wrapper">

    <div id="mapMyView">
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
            <input type="hidden" id="agent_id" name="agent_id" value="<?php echo esc_attr($agent_id); ?>">
            <div class="pull-right search_prop_calc_top"><?php echo esc_html($total_p) . __(' Properties found', 'reales') ?></div>
            <div class="clearfix"></div>

            <?php if($payment_type == 'listing' && $agent_payment != '1') { ?>
                <input type="hidden" id="s_price" name="s_price" value="<?php echo esc_attr($standard_price); ?>">
                <input type="hidden" id="f_price" name="f_price" value="<?php echo esc_attr($featured_price); ?>">
            <?php } ?>

            <div class="properties-list">
            <?php
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
                $category                = wp_get_post_terms($prop_id, 'property_category');
                $bedrooms                = get_post_meta($prop_id, 'property_bedrooms', true);
                $bathrooms               = get_post_meta($prop_id, 'property_bathrooms', true);
                $area                    = get_post_meta($prop_id, 'property_area', true);
                $unit                    = isset($reales_general_settings['reales_unit_field']) ? $reales_general_settings['reales_unit_field'] : '';
                $featured                = get_post_meta($prop_id, 'property_featured', true);

                $locale = isset($reales_general_settings['reales_locale_field']) ? $reales_general_settings['reales_locale_field'] : '';
                $decimals = isset($reales_general_settings['reales_decimals_field']) ? $reales_general_settings['reales_decimals_field'] : '';
                $price  = get_post_meta($prop_id, 'property_price', true);
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
                $img_resize = aq_resize($images[1], 240, 240, true);

                $thumb = '';
                if($img_resize !== false) {
                    $thumb = $img_resize;
                } else {
                    $thumb = $images[1];
                }
            ?>

                <div class="properties-list-item" id="card-<?php echo esc_attr($prop_id); ?>">
                    <div class="row no-margin">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 no-padding">
                            <div class="img">
                                <span style="background-image:url(<?php echo esc_url($thumb); ?>);"></span>
                                <div class="figCaption">
                                    <div></div>
                                    <span><span class="icon-eye"></span> <?php echo esc_html(reales_get_post_views($prop_id, '')); ?></span>
                                    <?php
                                    $favs = reales_get_favourites_count($prop_id);
                                    ?>
                                    <span><span class="icon-heart"></span> <?php echo esc_html($favs); ?></span>
                                    <span><span class="icon-bubble"></span> <?php comments_number('0', '1', '%'); ?></span>
                                </div>
                                <?php if($type) { ?>
                                    <div class="figType"><?php echo esc_html($type[0]->name); ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 no-padding">
                            <div class="properties-list-item-details">
                                <?php if($featured == 1) { ?>
                                    <div class="featured"><span class="fa fa-star"></span></div>
                                <?php } ?>
                                <h2><a href="<?php echo esc_url(get_permalink($prop_id)); ?>"><?php the_title(); ?></a></h2>
                                <div class="op-btn">
                                    <?php
                                    $args = array(
                                        'post_type' => 'page',
                                        'post_status' => 'publish',
                                        'meta_key' => '_wp_page_template',
                                        'meta_value' => 'submit-property.php'
                                    );

                                    $query = new WP_Query($args);

                                    while($query->have_posts()) {
                                        $query->the_post();
                                        $page_id = get_the_ID();
                                        $page_link = get_permalink($page_id);
                                    }
                                    wp_reset_postdata();
                                    wp_reset_query(); ?>

                                    <a href="<?php echo esc_url($page_link) . '?edit_id=' . esc_attr($prop_id); ?>" class="btn btn-xs btn-icon btn-green" title="<?php esc_html_e('Edit Property', 'reales'); ?>"><span class="icon-pencil"></span></a>
                                    <a href="javascript:void(0);" data-del="<?php echo esc_attr($prop_id); ?>" class="btn btn-xs btn-icon btn-red delMyProperty" title="<?php esc_html_e('Delete Property', 'reales'); ?>"><span class="fa fa-trash-o"></span></a>
                                </div>
                                <?php if($currency_pos == 'before') { ?>
                                    <div class="price"><?php echo esc_html($currency) . ' ' . esc_html($price) . ' ' . esc_html($price_label); ?></div>
                                <?php } else { ?>
                                    <div class="price"><?php echo esc_html($price) . ' ' . esc_html($currency) . ' ' . esc_html($price_label); ?></div>
                                <?php } ?>
                                <div class="listCategory">
                                    <?php if($category) { echo esc_html($category[0]->name); } ?>
                                </div>
                                <div class="property-status">
                                    <?php if(get_post_status($prop_id) == 'publish') { ?>
                                        <span class="label label-success"><?php echo esc_html_e('Published', 'reales'); ?></span>
                                    <?php } else { ?>
                                        <span class="label label-warning"><?php echo esc_html_e('Pending for Approval', 'reales'); ?></span>
                                    <?php } ?>

                                    <?php if($payment_type == 'listing') {
                                        $payment_status = get_post_meta($prop_id, 'payment_status', true);
                                        if($payment_status == 'paid') { ?>
                                            <span class="label label-success"><?php echo esc_html_e('Paid', 'reales'); ?></span>
                                        <?php } else { ?>
                                            <span class="label label-danger"><?php echo esc_html_e('Payment Required', 'reales'); ?></span>
                                        <?php }
                                    } ?>
                                </div>
                                <?php if($payment_type == 'listing') { 
                                    $payment_status = get_post_meta($prop_id, 'payment_status', true);
                                    $featured_free_left = get_post_meta($agent_id, 'agent_free_featured_listings', true);
                                    $ffl_int = intval($featured_free_left); ?>
                                    <div class="row payment-row" style="padding: 10px 0;">

                                        <?php if($payment_status == 'paid') { ?>

                                            <?php if($ffl_int > 0 || $agent_payment == '1') { ?>

                                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="prices">&nbsp;</div>
                                                    <?php if($featured == 1) { ?>
                                                        <div class="prices">&nbsp;</div>
                                                    <?php } else { ?>
                                                        <div class="checkbox custom-checkbox prices" style="margin-bottom: 0;"><label><input type="checkbox" class="myFeaturedFree" value="1"><span class="fa fa-check"></span> <?php _e('Set as Featured', 'reales'); ?> <?php if($agent_payment != '1') { ?>(<strong><?php echo esc_html($ffl_int) . ' ' . __('free left', 'reales'); ?></strong>) <?php } ?></label></div>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="text-align: right;">
                                                    <?php wp_nonce_field('upgrade_property_ajax_nonce', 'securityUpgradeProperty', true); ?>
                                                    <a href="javascript:void(0);" class="btn btn-green upgradeBtn" style="display: none;" data-id="<?php echo esc_html($prop_id); ?>" data-agent-id="<?php echo esc_html($agent_id); ?>"><?php esc_html_e('Upgrade to Featured', 'reales'); ?></a>
                                                </div>

                                            <?php } else { ?>

                                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                    <div class="prices">&nbsp;</div>
                                                    <?php if($featured == 1) { ?>
                                                        <div class="prices">&nbsp;</div>
                                                    <?php } else { ?>
                                                        <div class="checkbox custom-checkbox prices" style="margin-bottom: 0;"><label><input type="checkbox" class="myFeatured" value="1"><span class="fa fa-check"></span> <?php _e('Set as Featured', 'reales'); ?> (<strong>+ <?php echo esc_html($featured_price) . ' ' . esc_html($payment_currency); ?></strong>)</label></div>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="text-align: right;">
                                                    <input type="hidden" class="pay-featured" value="1">
                                                    <a href="javascript:void(0);" class="btn btn-paypal payBtn" style="display: none;" data-id="<?php echo esc_attr($prop_id); ?>" data-featured="" data-upgrade="1"><span class="fa fa-paypal"></span> <?php esc_html_e('Pay with PayPal', 'reales'); ?> <span class="pay-total"><?php echo esc_html($featured_price); ?></span> <strong><?php echo esc_html($payment_currency); ?></strong></a>
                                                </div>

                                            <?php } ?>

                                        <?php } else { ?>

                                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                <?php if($featured == 1) { ?>
                                                    <div class="prices">&nbsp;</div>
                                                <?php } ?>
                                                <div class="prices"><?php esc_html_e('Submission price', 'reales'); ?>:<strong> <?php echo esc_html($standard_price) . ' ' . esc_html($payment_currency); ?></strong></div>
                                                <?php if($featured != 1) { ?>
                                                    <?php if($ffl_int > 0) { ?>
                                                        <div class="checkbox custom-checkbox prices" style="margin-bottom: 0;"><label><input type="checkbox" class="myFeaturedFree" value="1"><span class="fa fa-check"></span> <?php _e('Set as Featured', 'reales'); ?> (<strong><?php echo esc_html($ffl_int) . ' ' . __('free left', 'reales'); ?></strong>)</label></div>
                                                    <?php } else { ?>
                                                        <div class="checkbox custom-checkbox prices" style="margin-bottom: 0;"><label><input type="checkbox" class="myFeatured" value="1"><span class="fa fa-check"></span> <?php _e('Set as Featured', 'reales'); ?> (<strong>+ <?php echo esc_html($featured_price) . ' ' . esc_html($payment_currency); ?></strong>)</label></div>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="text-align: right;">
                                                <a href="javascript:void(0);" class="btn btn-paypal payBtn" data-id="<?php echo esc_attr($prop_id); ?>" data-featured="" data-upgrade=""><span class="fa fa-paypal"></span> <?php esc_html_e('Pay with PayPal', 'reales'); ?> <span class="pay-total"><?php echo esc_html($standard_price); ?></span> <strong><?php echo esc_html($payment_currency); ?></strong></a>
                                            </div>

                                        <?php } ?>

                                    </div>
                                <?php } ?>

                                <?php if($payment_type == 'membership') { 
                                    $featured_plan_left = get_post_meta($agent_id, 'agent_plan_featured', true);
                                    $fpl_int = intval($featured_plan_left); 

                                    if($agent_payment == '1') {
                                        $fpl_int = 1;
                                    } ?>
                                    
                                    <?php if($featured != 1 && $fpl_int > 0) { ?>
                                        <?php wp_nonce_field('featured_property_ajax_nonce', 'securityFeaturedProperty', true); ?>
                                        <div class="prices">&nbsp;</div>
                                        <div style="text-align: right; padding-bottom: 10px;">
                                            <a href="javascript:void(0);" class="btn btn-green featuredBtn" data-id="<?php echo esc_attr($prop_id); ?>" data-agent-id="<?php echo esc_attr($agent_id); ?>"><?php esc_html_e('Set as Featured', 'reales'); ?></a>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
            </div>
            <div class="pull-left">
                <?php reales_pagination($searched_posts->max_num_pages); ?>
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
            <?php wp_nonce_field('submit_property_ajax_nonce', 'securitySubmitProperty', true); ?>
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
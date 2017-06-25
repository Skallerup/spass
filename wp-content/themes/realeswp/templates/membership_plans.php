<?php
/**
 * @package WordPress
 * @subpackage Reales
 */
?>

<?php
global $agent_id;
?>

<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
    <div class="content-sidebar">
        <ul class="sidebar-list">
            <li class="widget-container">
                <h3 class="osLight sidebar-header"><?php echo __('Membership Plans', 'reales'); ?></h3>
                <?php 
                $plan_id = get_post_meta($agent_id, 'agent_plan', true);
                if(!$plan_id || $plan_id == '') { ?>
                    <div class="alert alert-info fade in" role="alert">
                        <div class="icon"><span class="fa fa-info-circle"></span></div>
                        <strong><?php echo __('You don\'t have an active membership plan. You have to choose one in order to submit listings.', 'reales'); ?></strong>
                    </div>
                <?php } else {
                    $plan_name              = get_the_title($plan_id);
                    $plan_listings          = get_post_meta($agent_id, 'agent_plan_listings', true);
                    $plan_featured          = get_post_meta($agent_id, 'agent_plan_featured', true);
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
                    $today = getdate(); ?>

                    <div class="price-plan">
                        <div class="price-plan-title active"><?php esc_html_e('Your Current Membership Plan', 'reales'); ?></div>
                        <div class="price-plan-features active">
                            <div><?php echo __('Type', 'reales') . ': '; ?><strong><?php echo esc_html($plan_name); ?></strong></div>
                            <?php if($today[0] > strtotime($expiration_date)) { ?>
                                <div><?php echo __('Status', 'reales') . ': '; ?><span class="label label-danger"><?php echo __('Expired', 'reales'); ?></span></div>
                            <?php }  else { ?>
                                <div><?php echo __('Status', 'reales') . ': '; ?><span class="label label-success"><?php echo __('Active', 'reales'); ?></span></div>
                                <div><?php echo __('Expires On', 'reales') . ': '; ?><strong><?php echo esc_html($expiration_date); ?></strong></div>
                            <?php } ?>
                            <?php if($plan_unlimited == '1') { ?>
                                <div><?php echo __('Available Listings', 'reales') . ': '; ?><strong><?php echo __('Unlimited', 'reales'); ?></strong></div>
                            <?php }  else { ?>
                                <div><?php echo __('Available Listings', 'reales') . ': '; ?><strong><?php echo esc_html($plan_listings); ?></strong></div>
                            <?php } ?>
                            <div><?php echo __('Available Featured Listings', 'reales') . ': '; ?><strong><?php echo esc_html($plan_featured); ?></strong></div>
                        </div>
                    </div>
                <?php } ?>


                <!-- Get membership plans list -->
                <?php 
                $args = array(
                    'posts_per_page'   => -1,
                    'post_type'        => 'membership',
                    'order'            => 'ASC',
                    'post_status'      => 'publish,',
                    'meta_key'         => 'membership_plan_price',
                    'orderby'          => 'meta_value_num',
                    'suppress_filters' => false,
                );

                $posts = get_posts($args);

                $reales_membership_settings = get_option('reales_membership_settings');
                $currency = isset($reales_membership_settings['reales_payment_currency_field']) ? $reales_membership_settings['reales_payment_currency_field'] : '';

                $return_string = '';

                foreach($posts as $post) : 
                    $membership_billing_time_unit       = get_post_meta($post->ID, 'membership_billing_time_unit', true);
                    $membership_period                  = get_post_meta($post->ID, 'membership_period', true);
                    $membership_submissions_no          = get_post_meta($post->ID, 'membership_submissions_no', true);
                    $membership_unlim_submissions       = get_post_meta($post->ID, 'membership_unlim_submissions', true);
                    $membership_featured_submissions_no = get_post_meta($post->ID, 'membership_featured_submissions_no', true);
                    $membership_plan_price              = get_post_meta($post->ID, 'membership_plan_price', true);
                    $membership_free_plan               = get_post_meta($post->ID, 'membership_free_plan', true);

                    switch($membership_billing_time_unit) {
                        case 'day':
                            $time_unit = __('days', 'reales');
                        break;
                        case 'week':
                            $time_unit = __('weeks', 'reales');
                        break;
                        case 'month':
                            $time_unit = __('months', 'reales');
                        break;
                        case 'year':
                            $time_unit = __('years', 'reales');
                        break;
                    }

                    $return_string .=       '<div class="price-plan">';
                    $return_string .=           '<div class="price-plan-title">' . esc_html($post->post_title) . '</div>';
                    $return_string .=           '<div class="price-plan-price">';
                    if($membership_free_plan == 1) {
                        $return_string .=           '<div class="price-plan-price-sum">' . esc_html('Free', 'reales') . '</div>';
                    } else {
                        $return_string .=           '<div class="price-plan-price-sum">' . esc_html($membership_plan_price) . '<sup> ' . esc_html($currency) . '</sup></div>';
                    }
                    $return_string .=               '<div class="price-plan-price-period">/ ' . esc_html($membership_period) . ' ' . esc_html($time_unit) . '</div>';
                    $return_string .=           '</div>';
                    $return_string .=           '<div class="price-plan-features">';
                    if($membership_unlim_submissions == 1) {
                        $return_string .=           '<span>' . __('Unlimited Listings', 'reales') . '</span>';
                    } else {
                        $return_string .=           '<span>' . esc_html($membership_submissions_no) . ' ' . __('Listings', 'reales') . '</span>';
                    }
                    $return_string .=               '<span>' . esc_html($membership_featured_submissions_no) . ' ' . __('Featured Listings', 'reales') . '</span>';
                    $return_string .=           '</div>';
                    $return_string .=           '<div class="price-plan-pay">';
                    if($membership_free_plan == 1) {
                        $return_string .=           '<a href="javascript:void(0);" class="btn btn-green activatePlanBtn" data-agent-id="' . esc_attr($agent_id) . '" data-id="' . esc_attr($post->ID) . '">' . __('Activate Plan', 'reales') . '</a>';
                    } else {
                        $return_string .=           '<a href="javascript:void(0);" class="btn btn-paypal payPlanBtn" data-id="' . esc_attr($post->ID) . '"><span class="fa fa-paypal"></span> ' . __('Pay with PayPal', 'reales') . '</a>';
                    }
                    $return_string .=           '</div>';
                    $return_string .=       '</div>';
                endforeach;

                print $return_string;

                wp_reset_postdata();
                wp_reset_query();
                ?>
            </li>
        </ul>
    </div>
</div>
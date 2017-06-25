<?php
/**
 * Membership plans shortcode
 */
if( !function_exists('reales_membership_plans_shortcode') ): 
    function reales_membership_plans_shortcode($attrs, $content = null) {
        extract(shortcode_atts(array(
            'title' => 'Membership Plans'
        ), $attrs));

        $args = array(
            'posts_per_page'   => -1,
            'post_type'        => 'membership',
            'order'            => 'ASC',
            'suppress_filters' => false,
            'post_status'      => 'publish,',
            'meta_key'         => 'membership_plan_price',
            'orderby'          => 'meta_value_num'
        );

        $posts = get_posts($args);

        $reales_membership_settings = get_option('reales_membership_settings');
        $currency = isset($reales_membership_settings['reales_payment_currency_field']) ? $reales_membership_settings['reales_payment_currency_field'] : '';

        $return_string = '<h2 class="centered osLight">' . esc_html($title) . '</h2>';
        $return_string .= '<div class="row pb20">';

        foreach($posts as $post) : 
            $membership_billing_time_unit       = get_post_meta($post->ID, 'membership_billing_time_unit', true);
            $membership_period                  = get_post_meta($post->ID, 'membership_period', true);
            $membership_submissions_no          = get_post_meta($post->ID, 'membership_submissions_no', true);
            $membership_unlim_submissions       = get_post_meta($post->ID, 'membership_unlim_submissions', true);
            $membership_featured_submissions_no = get_post_meta($post->ID, 'membership_featured_submissions_no', true);
            $membership_plan_price              = get_post_meta($post->ID, 'membership_plan_price', true);
            $membership_free_plan               = get_post_meta($post->ID, 'membership_free_plan', true);

            if($membership_billing_time_unit == 'day') {
                $time_unit = __('days', 'reales');
            } else if($membership_billing_time_unit == 'week') {
                $time_unit = __('weeks', 'reales');
            } else if($membership_billing_time_unit == 'month') {
                $time_unit = __('months', 'reales');
            } else {
                $time_unit = __('years', 'reales');
            }

            $return_string .=   '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">';
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
            $return_string .=       '</div>';
            $return_string .=   '</div>';
        endforeach;
        $return_string .= '</div>';
        wp_reset_postdata();
        wp_reset_query();

        $return_string .= '<div class="row pb40">';
        $return_string .= '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>';
        $return_string .= '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">';
        if(is_user_logged_in()) {
            $current_user = wp_get_current_user();
            if(reales_check_user_agent($current_user->ID) === true) {
                $args = array(
                    'post_type' => 'page',
                    'post_status' => 'publish',
                    'meta_key' => '_wp_page_template',
                    'meta_value' => 'user-account.php'
                );

                $query = new WP_Query($args);

                while($query->have_posts()) {
                    $query->the_post();
                    $page_id = get_the_ID();
                    $page_link = get_permalink($page_id);
                }
                wp_reset_postdata();
                wp_reset_query();
                $return_string .= '<a href="' . esc_url($page_link) . '" class="btn btn-green btn-block btn-lg">' . __('Choose a membership plan', 'reales') . '</a>';
            } else {
                $return_string .= '<a href="#" data-toggle="modal" data-target="#signup" class="btn btn-green btn-block btn-lg">' . __('Get started now', 'reales') . '</a>';
            }
        } else {
            $return_string .= '<a href="#" data-toggle="modal" data-target="#signup" class="btn btn-green btn-block btn-lg">' . __('Get started now', 'reales') . '</a>';
        }
        $return_string .= '</div>';
        $return_string .= '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>';
        $return_string .= '</div>';


        
        return $return_string;
    }
endif;
?>
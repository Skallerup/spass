<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if( !function_exists('reales_admin_membership') ): 
    function reales_admin_membership() {
        add_settings_section( 'reales_membership_section', __( 'Membership and Payment', 'reales' ), 'reales_membership_section_callback', 'reales_membership_settings' );
        add_settings_field( 'reales_paid_field', __( 'PayPal paid submission', 'reales' ), 'reales_paid_field_render', 'reales_membership_settings', 'reales_membership_section' );
        add_settings_field( 'reales_payment_currency_field', __( 'Payment currency', 'reales' ), 'reales_payment_currency_field_render', 'reales_membership_settings', 'reales_membership_section' );
        add_settings_field( 'reales_submission_price_field', __( 'Property submission price', 'reales' ), 'reales_submission_price_field_render', 'reales_membership_settings', 'reales_membership_section' );
        add_settings_field( 'reales_featured_price_field', __( 'Featured property submission price', 'reales' ), 'reales_featured_price_field_render', 'reales_membership_settings', 'reales_membership_section' );
        add_settings_field( 'reales_free_submissions_no_field', __( 'Number of free submissions', 'reales' ), 'reales_free_submissions_no_field_render', 'reales_membership_settings', 'reales_membership_section' );
        add_settings_field( 'reales_free_submissions_unlim_field', __( 'Unlimited free submissions', 'reales' ), 'reales_free_submissions_unlim_field_render', 'reales_membership_settings', 'reales_membership_section' );
        add_settings_field( 'reales_free_featured_submissions_no_field', __( 'Number of free featured submissions', 'reales' ), 'reales_free_featured_submissions_no_field_render', 'reales_membership_settings', 'reales_membership_section' );
        add_settings_field( 'reales_paypal_api_version_field', __( 'PayPal API version', 'reales' ), 'reales_paypal_api_version_field_render', 'reales_membership_settings', 'reales_membership_section' );
        add_settings_field( 'reales_paypal_client_id_field', __( 'PayPal Client ID', 'reales' ), 'reales_paypal_client_id_field_render', 'reales_membership_settings', 'reales_membership_section' );
        add_settings_field( 'reales_paypal_client_key_field', __( 'PayPal Client Secret Key', 'reales' ), 'reales_paypal_client_key_field_render', 'reales_membership_settings', 'reales_membership_section' );
        add_settings_field( 'reales_paypal_api_username_field', __( 'PayPal API username', 'reales' ), 'reales_paypal_api_username_field_render', 'reales_membership_settings', 'reales_membership_section' );
        add_settings_field( 'reales_paypal_api_password_field', __( 'PayPal API password', 'reales' ), 'reales_paypal_api_password_field_render', 'reales_membership_settings', 'reales_membership_section' );
        add_settings_field( 'reales_paypal_api_signature_field', __( 'PayPal API signature', 'reales' ), 'reales_paypal_api_signature_field_render', 'reales_membership_settings', 'reales_membership_section' );
        add_settings_field( 'reales_paypal_email_field', __( 'PayPal receiving e-mail', 'reales' ), 'reales_paypal_email_field_render', 'reales_membership_settings', 'reales_membership_section' );
    }
endif;

if( !function_exists('reales_membership_section_callback') ): 
    function reales_membership_section_callback() { 
        echo '';
    }
endif;

if( !function_exists('reales_paid_field_render') ): 
    function reales_paid_field_render() { 
        $options = get_option( 'reales_membership_settings' );

        $value_select = '<select id="reales_membership_settings[reales_paid_field]" name="reales_membership_settings[reales_paid_field]">';
        $value_select .= '<option value="disabled"';
        if(isset($options['reales_paid_field']) && $options['reales_paid_field'] == 'disabled') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('disabled', 'reales') . '</option>';
        $value_select .= '<option value="listing"';
        if(isset($options['reales_paid_field']) && $options['reales_paid_field'] == 'listing') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('per listing', 'reales') . '</option>';
        $value_select .= '<option value="membership"';
        if(isset($options['reales_paid_field']) && $options['reales_paid_field'] == 'membership') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('membership', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_payment_currency_field_render') ): 
    function reales_payment_currency_field_render() { 
        $options = get_option( 'reales_membership_settings' );
        $currencies = array('USD','EUR','AUD','BRL','CAD','CZK','DKK','HKD','HUF','ILS','INR','JPY','MYR','MXN','NOK','NZD','PHP','PLN','GBP','SGD','SEK','CHF','TWD','THB','TRY');
        $currency_select = '<select id="reales_membership_settings[reales_payment_currency_field]" name="reales_membership_settings[reales_payment_currency_field]">';

        foreach($currencies as $currency) {
            $currency_select .= '<option value="' . esc_attr($currency) . '"';
            if(isset($options['reales_payment_currency_field']) && $options['reales_payment_currency_field'] == $currency) {
                $currency_select .= 'selected="selected"';
            }
            $currency_select .= '>' . esc_html($currency) . '</option>';
        }

        $currency_select .= '</select>';

        print $currency_select;
    }
endif;

if( !function_exists('reales_submission_price_field_render') ): 
    function reales_submission_price_field_render() {
        $options = get_option( 'reales_membership_settings' );
        ?>
        <input id="reales_membership_settings[reales_submission_price_field]" type="text" size="20" name="reales_membership_settings[reales_submission_price_field]" value="<?php if(isset($options['reales_submission_price_field'])) { echo esc_attr($options['reales_submission_price_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_featured_price_field_render') ): 
    function reales_featured_price_field_render() {
        $options = get_option( 'reales_membership_settings' );
        ?>
        <input id="reales_membership_settings[reales_featured_price_field]" type="text" size="20" name="reales_membership_settings[reales_featured_price_field]" value="<?php if(isset($options['reales_featured_price_field'])) { echo esc_attr($options['reales_featured_price_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_free_submissions_no_field_render') ): 
    function reales_free_submissions_no_field_render() {
        $options = get_option( 'reales_membership_settings' );

        // set free submissions number for all agents
        if(isset($_GET['settings-updated']) && $_GET['settings-updated']) {
            $args = array(
                'post_type'        => 'agent',
                'post_status'      => 'publish'
            );
            $posts = get_posts($args);
            foreach($posts as $post) : setup_postdata($post);
                update_post_meta($post->ID, 'agent_free_listings', $options['reales_free_submissions_no_field']);
            endforeach;
            wp_reset_postdata();
            wp_reset_query();
        }
        ?>
        <input id="reales_membership_settings[reales_free_submissions_no_field]" type="text" size="5" name="reales_membership_settings[reales_free_submissions_no_field]" value="<?php if(isset($options['reales_free_submissions_no_field'])) { echo esc_attr($options['reales_free_submissions_no_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_free_submissions_unlim_field_render') ): 
    function reales_free_submissions_unlim_field_render() {
        $options = get_option( 'reales_membership_settings' );
        ?>
        <input type="checkbox" name="reales_membership_settings[reales_free_submissions_unlim_field]" <?php if(isset($options['reales_free_submissions_unlim_field'])) { checked( $options['reales_free_submissions_unlim_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

if( !function_exists('reales_free_featured_submissions_no_field_render') ): 
    function reales_free_featured_submissions_no_field_render() {
        $options = get_option( 'reales_membership_settings' );

        // set free featured submissions number for all agents
        if(isset($_GET['settings-updated']) && $_GET['settings-updated']) {
            $args = array(
                'post_type'        => 'agent',
                'post_status'      => 'publish'
            );
            $posts = get_posts($args);
            foreach($posts as $post) : setup_postdata($post);
                update_post_meta($post->ID, 'agent_free_featured_listings', $options['reales_free_featured_submissions_no_field']);
            endforeach;
            wp_reset_postdata();
            wp_reset_query();
        }
        ?>
        <input id="reales_membership_settings[reales_free_featured_submissions_no_field]" type="text" size="5" name="reales_membership_settings[reales_free_featured_submissions_no_field]" value="<?php if(isset($options['reales_free_featured_submissions_no_field'])) { echo esc_attr($options['reales_free_featured_submissions_no_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_paypal_api_version_field_render') ): 
    function reales_paypal_api_version_field_render() { 
        $options = get_option( 'reales_membership_settings' );

        $value_select = '<select id="reales_membership_settings[reales_paypal_api_version_field]" name="reales_membership_settings[reales_paypal_api_version_field]">';
        $value_select .= '<option value="test"';
        if(isset($options['reales_paypal_api_version_field']) && $options['reales_paypal_api_version_field'] == 'test') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('test', 'reales') . '</option>';
        $value_select .= '<option value="live"';
        if(isset($options['reales_paypal_api_version_field']) && $options['reales_paypal_api_version_field'] == 'live') {
            $value_select .= 'selected="selected"';
        }
        $value_select .= '>' . __('live', 'reales') . '</option>';
        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_paypal_client_id_field_render') ): 
    function reales_paypal_client_id_field_render() {
        $options = get_option( 'reales_membership_settings' );
        ?>
        <input id="reales_membership_settings[reales_paypal_client_id_field]" type="text" size="40" name="reales_membership_settings[reales_paypal_client_id_field]" value="<?php if(isset($options['reales_paypal_client_id_field'])) { echo esc_attr($options['reales_paypal_client_id_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_paypal_client_key_field_render') ): 
    function reales_paypal_client_key_field_render() {
        $options = get_option( 'reales_membership_settings' );
        ?>
        <input id="reales_membership_settings[reales_paypal_client_key_field]" type="text" size="40" name="reales_membership_settings[reales_paypal_client_key_field]" value="<?php if(isset($options['reales_paypal_client_key_field'])) { echo esc_attr($options['reales_paypal_client_key_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_paypal_api_username_field_render') ): 
    function reales_paypal_api_username_field_render() {
        $options = get_option( 'reales_membership_settings' );
        ?>
        <input id="reales_membership_settings[reales_paypal_api_username_field]" type="text" size="40" name="reales_membership_settings[reales_paypal_api_username_field]" value="<?php if(isset($options['reales_paypal_api_username_field'])) { echo esc_attr($options['reales_paypal_api_username_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_paypal_api_password_field_render') ): 
    function reales_paypal_api_password_field_render() {
        $options = get_option( 'reales_membership_settings' );
        ?>
        <input id="reales_membership_settings[reales_paypal_api_password_field]" type="text" size="40" name="reales_membership_settings[reales_paypal_api_password_field]" value="<?php if(isset($options['reales_paypal_api_password_field'])) { echo esc_attr($options['reales_paypal_api_password_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_paypal_api_signature_field_render') ): 
    function reales_paypal_api_signature_field_render() {
        $options = get_option( 'reales_membership_settings' );
        ?>
        <input id="reales_membership_settings[reales_paypal_api_signature_field]" type="text" size="40" name="reales_membership_settings[reales_paypal_api_signature_field]" value="<?php if(isset($options['reales_paypal_api_signature_field'])) { echo esc_attr($options['reales_paypal_api_signature_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_paypal_email_field_render') ): 
    function reales_paypal_email_field_render() {
        $options = get_option( 'reales_membership_settings' );
        ?>
        <input id="reales_membership_settings[reales_paypal_email_field]" type="text" size="40" name="reales_membership_settings[reales_paypal_email_field]" value="<?php if(isset($options['reales_paypal_email_field'])) { echo esc_attr($options['reales_paypal_email_field']); } ?>" />
        <?php
    }
endif;

?>
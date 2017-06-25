<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if( !function_exists('reales_admin_captcha') ): 
    function reales_admin_captcha() {
        add_settings_section( 'reales_captcha_section', __( 'reCAPTCHA', 'reales' ), 'reales_captcha_section_callback', 'reales_captcha_settings' );
        add_settings_field( 'reales_captcha_site_key_field', __( 'Site Key', 'reales' ), 'reales_captcha_site_key_field_render', 'reales_captcha_settings', 'reales_captcha_section' );
        add_settings_field( 'reales_captcha_secret_key_field', __( 'Secret Key', 'reales' ), 'reales_captcha_secret_key_field_render', 'reales_captcha_settings', 'reales_captcha_section' );
        add_settings_field( 'reales_captcha_contact_field', __( 'Show reCAPTCHA in contact forms', 'reales' ), 'reales_captcha_contact_field_render', 'reales_captcha_settings', 'reales_captcha_section' );
        add_settings_field( 'reales_captcha_submit_field', __( 'Show reCAPTCHA in submit property form', 'reales' ), 'reales_captcha_submit_field_render', 'reales_captcha_settings', 'reales_captcha_section' );
    }
endif;

if( !function_exists('reales_captcha_section_callback') ): 
    function reales_captcha_section_callback() { 
        echo '<p class="help">' . __('reCAPTCHA is a free service to protect your website from spam and abuse. For using it, you need a <b>Site Key</b> and a <b>Secret Key</b> that you can get from ', 'reales') . '<a href="https://www.google.com/recaptcha/admin" target="_blank">' . __('here', 'reales') . '</a></p>';
    }
endif;

if( !function_exists('reales_captcha_site_key_field_render') ): 
    function reales_captcha_site_key_field_render() { 
        $options = get_option( 'reales_captcha_settings' );
        ?>
        <input type="text" size="40" name="reales_captcha_settings[reales_captcha_site_key_field]" value="<?php if(isset($options['reales_captcha_site_key_field'])) { echo esc_attr($options['reales_captcha_site_key_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_captcha_secret_key_field_render') ): 
    function reales_captcha_secret_key_field_render() { 
        $options = get_option( 'reales_captcha_settings' );
        ?>
        <input type="text" size="40" name="reales_captcha_settings[reales_captcha_secret_key_field]" value="<?php if(isset($options['reales_captcha_secret_key_field'])) { echo esc_attr($options['reales_captcha_secret_key_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_captcha_contact_field_render') ): 
    function reales_captcha_contact_field_render() {
        $options = get_option( 'reales_captcha_settings' );
        ?>
        <input type="checkbox" name="reales_captcha_settings[reales_captcha_contact_field]" <?php if(isset($options['reales_captcha_contact_field'])) { checked( $options['reales_captcha_contact_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

if( !function_exists('reales_captcha_submit_field_render') ): 
    function reales_captcha_submit_field_render() {
        $options = get_option( 'reales_captcha_settings' );
        ?>
        <input type="checkbox" name="reales_captcha_settings[reales_captcha_submit_field]" <?php if(isset($options['reales_captcha_submit_field'])) { checked( $options['reales_captcha_submit_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

?>
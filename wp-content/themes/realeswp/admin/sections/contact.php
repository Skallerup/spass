<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if( !function_exists('reales_admin_contact') ): 
    function reales_admin_contact() {
        add_settings_section( 'reales_contact_section', __( 'Contact', 'reales' ), 'reales_contact_section_callback', 'reales_contact_settings' );
        add_settings_field( 'reales_company_name_field',  __( 'Company Name', 'reales' ), 'reales_company_name_field_render', 'reales_contact_settings', 'reales_contact_section' );
        add_settings_field( 'reales_company_email_field',  __( 'E-mail', 'reales' ), 'reales_company_email_field_render', 'reales_contact_settings', 'reales_contact_section' );
        add_settings_field( 'reales_company_phone_field',  __( 'Phone', 'reales' ), 'reales_company_phone_field_render', 'reales_contact_settings', 'reales_contact_section' );
        add_settings_field( 'reales_company_mobile_field',  __( 'Mobile', 'reales' ), 'reales_company_mobile_field_render', 'reales_contact_settings', 'reales_contact_section' );
        add_settings_field( 'reales_company_skype_field',  __( 'Skype', 'reales' ), 'reales_company_skype_field_render', 'reales_contact_settings', 'reales_contact_section' );
        add_settings_field( 'reales_company_address_field',  __( 'Address', 'reales' ), 'reales_company_address_field_render', 'reales_contact_settings', 'reales_contact_section' );
        add_settings_field( 'reales_company_facebook_field',  __( 'Facebook Link', 'reales' ), 'reales_company_facebook_field_render', 'reales_contact_settings', 'reales_contact_section' );
        add_settings_field( 'reales_company_twitter_field',  __( 'Twitter Link', 'reales' ), 'reales_company_twitter_field_render', 'reales_contact_settings', 'reales_contact_section' );
        add_settings_field( 'reales_company_google_field',  __( 'Google+ Link', 'reales' ), 'reales_company_google_field_render', 'reales_contact_settings', 'reales_contact_section' );
        add_settings_field( 'reales_company_linkedin_field',  __( 'LinkedIn Link', 'reales' ), 'reales_company_linkedin_field_render', 'reales_contact_settings', 'reales_contact_section' );
    }
endif;

if( !function_exists('reales_contact_section_callback') ): 
    function reales_contact_section_callback() { 
        echo '';
    }
endif;

if( !function_exists('reales_company_name_field_render') ): 
    function reales_company_name_field_render() {
        $options = get_option( 'reales_contact_settings' );
        ?>
        <input id="reales_contact_settings[reales_company_name_field]" type="text" size="40" name="reales_contact_settings[reales_company_name_field]" value="<?php if(isset($options['reales_company_name_field'])) { echo esc_attr($options['reales_company_name_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_company_email_field_render') ): 
    function reales_company_email_field_render() {
        $options = get_option( 'reales_contact_settings' );
        ?>
        <input id="reales_contact_settings[reales_company_email_field]" type="text" size="40" name="reales_contact_settings[reales_company_email_field]" value="<?php if(isset($options['reales_company_email_field'])) { echo esc_attr($options['reales_company_email_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_company_phone_field_render') ): 
    function reales_company_phone_field_render() {
        $options = get_option( 'reales_contact_settings' );
        ?>
        <input id="reales_contact_settings[reales_company_phone_field]" type="text" size="40" name="reales_contact_settings[reales_company_phone_field]" value="<?php if(isset($options['reales_company_phone_field'])) { echo esc_attr($options['reales_company_phone_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_company_mobile_field_render') ): 
    function reales_company_mobile_field_render() {
        $options = get_option( 'reales_contact_settings' );
        ?>
        <input id="reales_contact_settings[reales_company_mobile_field]" type="text" size="40" name="reales_contact_settings[reales_company_mobile_field]" value="<?php if(isset($options['reales_company_mobile_field'])) { echo esc_attr($options['reales_company_mobile_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_company_skype_field_render') ): 
    function reales_company_skype_field_render() {
        $options = get_option( 'reales_contact_settings' );
        ?>
        <input id="reales_contact_settings[reales_company_skype_field]" type="text" size="40" name="reales_contact_settings[reales_company_skype_field]" value="<?php if(isset($options['reales_company_skype_field'])) { echo esc_attr($options['reales_company_skype_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_company_address_field_render') ): 
    function reales_company_address_field_render() {
        $options = get_option( 'reales_contact_settings' );
        ?>
        <textarea cols='40' rows='5' name="reales_contact_settings[reales_company_address_field]"><?php if(isset($options['reales_company_address_field'])) { echo esc_html($options['reales_company_address_field']); } ?></textarea>
        <?php
    }
endif;

if( !function_exists('reales_company_facebook_field_render') ): 
    function reales_company_facebook_field_render() {
        $options = get_option( 'reales_contact_settings' );
        ?>
        <input id="reales_contact_settings[reales_company_facebook_field]" type="text" size="40" name="reales_contact_settings[reales_company_facebook_field]" value="<?php if(isset($options['reales_company_facebook_field'])) { echo esc_attr($options['reales_company_facebook_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_company_twitter_field_render') ): 
    function reales_company_twitter_field_render() {
        $options = get_option( 'reales_contact_settings' );
        ?>
        <input id="reales_contact_settings[reales_company_twitter_field]" type="text" size="40" name="reales_contact_settings[reales_company_twitter_field]" value="<?php if(isset($options['reales_company_twitter_field'])) { echo esc_attr($options['reales_company_twitter_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_company_google_field_render') ): 
    function reales_company_google_field_render() {
        $options = get_option( 'reales_contact_settings' );
        ?>
        <input id="reales_contact_settings[reales_company_google_field]" type="text" size="40" name="reales_contact_settings[reales_company_google_field]" value="<?php if(isset($options['reales_company_google_field'])) { echo esc_attr($options['reales_company_google_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_company_linkedin_field_render') ): 
    function reales_company_linkedin_field_render() {
        $options = get_option( 'reales_contact_settings' );
        ?>
        <input id="reales_contact_settings[reales_company_linkedin_field]" type="text" size="40" name="reales_contact_settings[reales_company_linkedin_field]" value="<?php if(isset($options['reales_company_linkedin_field'])) { echo esc_attr($options['reales_company_linkedin_field']); } ?>" />
        <?php
    }
endif;

?>
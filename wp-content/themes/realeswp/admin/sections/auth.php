<?php
/**
 * @package WordPress
 * @subpackage Reales
 */


if( !function_exists('reales_admin_auth') ): 
    function reales_admin_auth() {
        add_settings_section( 'reales_auth_section', __( 'Authentication', 'reales' ), 'reales_auth_section_callback', 'reales_auth_settings' );
        add_settings_field( 'reales_fb_login_field', __( 'Allow Facebook Login', 'reales' ), 'reales_fb_login_field_render', 'reales_auth_settings', 'reales_auth_section' );
        add_settings_field( 'reales_fb_id_field', __( 'Facebook App ID', 'reales' ), 'reales_fb_id_field_render', 'reales_auth_settings', 'reales_auth_section' );
        add_settings_field( 'reales_fb_secret_field', __( 'Facebook App Secret', 'reales' ), 'reales_fb_secret_field_render', 'reales_auth_settings', 'reales_auth_section' );
        add_settings_field( 'reales_google_login_field', __( 'Allow Google Signin', 'reales' ), 'reales_google_login_field_render', 'reales_auth_settings', 'reales_auth_section' );
        add_settings_field( 'reales_google_id_field', __( 'Google Client ID', 'reales' ), 'reales_google_id_field_render', 'reales_auth_settings', 'reales_auth_section' );
        add_settings_field( 'reales_google_secret_field', __( 'Google Client Secret', 'reales' ), 'reales_google_secret_field_render', 'reales_auth_settings', 'reales_auth_section' );
        add_settings_field( 'reales_register_agent_field', __( 'Allow users to register as agents', 'reales' ), 'reales_register_agent_field_render', 'reales_auth_settings', 'reales_auth_section' );
        add_settings_field( 'reales_terms_field', __( 'Terms and Conditions page URL', 'reales' ), 'reales_terms_field_render', 'reales_auth_settings', 'reales_auth_section' );
    }
endif;

if( !function_exists('reales_auth_section_callback') ): 
    function reales_auth_section_callback() { 
        echo '';
    }
endif;

if( !function_exists('reales_fb_login_field_render') ): 
    function reales_fb_login_field_render() { 
        $options = get_option( 'reales_auth_settings' );
        ?>
        <input type="checkbox" name="reales_auth_settings[reales_fb_login_field]" <?php if(isset($options['reales_fb_login_field'])) { checked( $options['reales_fb_login_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

if( !function_exists('reales_fb_id_field_render') ): 
    function reales_fb_id_field_render() { 
        $options = get_option( 'reales_auth_settings' );
        ?>
        <input type="text" size="40" name="reales_auth_settings[reales_fb_id_field]" value="<?php if(isset($options['reales_fb_id_field'])) { echo esc_attr($options['reales_fb_id_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_fb_secret_field_render') ): 
    function reales_fb_secret_field_render() { 
        $options = get_option( 'reales_auth_settings' );
        ?>
        <input type="text" size="40" name="reales_auth_settings[reales_fb_secret_field]" value="<?php if(isset($options['reales_fb_secret_field'])) { echo esc_attr($options['reales_fb_secret_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_google_login_field_render') ): 
    function reales_google_login_field_render() { 
        $options = get_option( 'reales_auth_settings' );
        ?>
        <input type="checkbox" name="reales_auth_settings[reales_google_login_field]" <?php if(isset($options['reales_google_login_field'])) { checked( $options['reales_google_login_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

if( !function_exists('reales_google_id_field_render') ): 
    function reales_google_id_field_render() { 
        $options = get_option( 'reales_auth_settings' );
        ?>
        <input type="text" size="40" name="reales_auth_settings[reales_google_id_field]" value="<?php if(isset($options['reales_google_id_field'])) { echo esc_attr($options['reales_google_id_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_google_secret_field_render') ): 
    function reales_google_secret_field_render() { 
        $options = get_option( 'reales_auth_settings' );
        ?>
        <input type="text" size="40" name="reales_auth_settings[reales_google_secret_field]" value="<?php if(isset($options['reales_google_secret_field'])) { echo esc_attr($options['reales_google_secret_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_register_agent_field_render') ): 
    function reales_register_agent_field_render() { 
        $options = get_option( 'reales_auth_settings' );
        ?>
        <input type="checkbox" name="reales_auth_settings[reales_register_agent_field]" <?php if(isset($options['reales_register_agent_field'])) { checked( $options['reales_register_agent_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

if( !function_exists('reales_terms_field_render') ): 
    function reales_terms_field_render() { 
        $options = get_option( 'reales_auth_settings' );
        ?>
        <input type="text" size="40" name="reales_auth_settings[reales_terms_field]" value="<?php if(isset($options['reales_terms_field'])) { echo esc_attr($options['reales_terms_field']); } ?>" />
        <?php
    }
endif;

?>
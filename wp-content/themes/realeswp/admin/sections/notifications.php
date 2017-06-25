<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if( !function_exists('reales_admin_notifications') ): 
    function reales_admin_notifications() {
        add_settings_section( 'reales_notifications_section', __( 'Notifications', 'reales' ), 'reales_notifications_section_callback', 'reales_notifications_settings' );
        add_settings_field( 'reales_notify_agent_publish_field', __( 'Notify agent when properties are published', 'reales' ), 'reales_notify_agent_publish_field_render', 'reales_notifications_settings', 'reales_notifications_section' );
        add_settings_field( 'reales_notify_admin_publish_field', __( 'Notify admin when properties are published', 'reales' ), 'reales_notify_admin_publish_field_render', 'reales_notifications_settings', 'reales_notifications_section' );
    }
endif;

if( !function_exists('reales_notifications_section_callback') ): 
    function reales_notifications_section_callback() { 
        echo '';
    }
endif;

if( !function_exists('reales_notify_agent_publish_field_render') ): 
    function reales_notify_agent_publish_field_render() {
        $options = get_option( 'reales_notifications_settings' );
        ?>
        <input type="checkbox" name="reales_notifications_settings[reales_notify_agent_publish_field]" <?php if(isset($options['reales_notify_agent_publish_field'])) { checked( $options['reales_notify_agent_publish_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

if( !function_exists('reales_notify_admin_publish_field_render') ): 
    function reales_notify_admin_publish_field_render() {
        $options = get_option( 'reales_notifications_settings' );
        ?>
        <input type="checkbox" name="reales_notifications_settings[reales_notify_admin_publish_field]" <?php if(isset($options['reales_notify_admin_publish_field'])) { checked( $options['reales_notify_admin_publish_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

?>
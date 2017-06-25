<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if( !function_exists('reales_admin_css') ): 
    function reales_admin_css() {
        add_settings_section( 'reales_css_section', __( 'Custom CSS', 'reales' ), 'reales_css_section_callback', 'reales_css_settings' );
        add_settings_field( 'reales_custom_css_field', __( 'Custom CSS', 'reales' ), 'reales_custom_css_field_render', 'reales_css_settings', 'reales_css_section' );
    }
endif;

if( !function_exists('reales_css_section_callback') ): 
    function reales_css_section_callback() { 
        echo '';
    }
endif;

if( !function_exists('reales_custom_css_field_render') ): 
    function reales_custom_css_field_render() { 
        $options = get_option( 'reales_css_settings' );
        ?>
        <textarea style="width: 100%;"  rows='20' name='reales_css_settings[reales_custom_css_field]'><?php if(isset($options['reales_custom_css_field'])) { echo esc_html($options['reales_custom_css_field']); } ?></textarea>
        <?php
    }
endif;

?>
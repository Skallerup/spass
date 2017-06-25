<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if( !function_exists('reales_admin_colors') ): 
    function reales_admin_colors() {
        add_settings_section( 'reales_colors_section', __( 'Colors', 'reales' ), 'reales_colors_section_callback', 'reales_colors_settings' );
        add_settings_field( 'reales_main_color_field', __( 'Main color', 'reales' ), 'reales_main_color_field_render', 'reales_colors_settings', 'reales_colors_section' );
        add_settings_field( 'reales_main_color_dark_field', __( 'Main color dark', 'reales' ), 'reales_main_color_dark_field_render', 'reales_colors_settings', 'reales_colors_section' );
        add_settings_field( 'reales_app_side_bg_field', __( 'App sidebar background color', 'reales' ), 'reales_app_side_bg_field_render', 'reales_colors_settings', 'reales_colors_section' );
        add_settings_field( 'reales_app_side_item_active_bg_field', __( 'App sidebar menu item active background color', 'reales' ), 'reales_app_side_item_active_bg_field_render', 'reales_colors_settings', 'reales_colors_section' );
        add_settings_field( 'reales_app_side_sub_bg_field', __( 'App sidebar submenu background color', 'reales' ), 'reales_app_side_sub_bg_field_render', 'reales_colors_settings', 'reales_colors_section' );
        add_settings_field( 'reales_app_side_sub_item_active_bg_field', __( 'App sidebar submenu item active background color', 'reales' ), 'reales_app_side_sub_item_active_bg_field_render', 'reales_colors_settings', 'reales_colors_section' );
        add_settings_field( 'reales_app_side_text_color_field', __( 'App sidebar menu text color', 'reales' ), 'reales_app_side_text_color_field_render', 'reales_colors_settings', 'reales_colors_section' );
        add_settings_field( 'reales_app_side_sub_text_color_field', __( 'App sidebar submenu text color', 'reales' ), 'reales_app_side_sub_text_color_field_render', 'reales_colors_settings', 'reales_colors_section' );
        add_settings_field( 'reales_app_top_item_active_color_field', __( 'Mobile view header icons active color', 'reales' ), 'reales_app_top_item_active_color_field_render', 'reales_colors_settings', 'reales_colors_section' );
        add_settings_field( 'reales_footer_bg_field', __( 'Footer background color', 'reales' ), 'reales_footer_bg_field_render', 'reales_colors_settings', 'reales_colors_section' );
        add_settings_field( 'reales_footer_header_color_field', __( 'Footer headers text color', 'reales' ), 'reales_footer_header_color_field_render', 'reales_colors_settings', 'reales_colors_section' );
        add_settings_field( 'reales_prop_type_badge_bg_field', __( 'Property type badge background color', 'reales' ), 'reales_prop_type_badge_bg_field_render', 'reales_colors_settings', 'reales_colors_section' );
        add_settings_field( 'reales_prop_featured_badge_bg_field', __( 'Property featured badge background color', 'reales' ), 'reales_prop_featured_badge_bg_field_render', 'reales_colors_settings', 'reales_colors_section' );
        add_settings_field( 'reales_fav_icon_color_field', __( 'Favourite icon color', 'reales' ), 'reales_fav_icon_color_field_render', 'reales_colors_settings', 'reales_colors_section' );
        add_settings_field( 'reales_marker_color_field', __( 'Map markers color', 'reales' ), 'reales_marker_color_field_render', 'reales_colors_settings', 'reales_colors_section' );
        add_settings_field( 'reales_prop_pending_label_bg_field', __( 'Property pending badge background color', 'reales' ), 'reales_prop_pending_label_bg_field_render', 'reales_colors_settings', 'reales_colors_section' );
    }
endif;

if( !function_exists('reales_colors_section_callback') ): 
    function reales_colors_section_callback() { 
        echo '';
    }
endif;

if( !function_exists('reales_main_color_field_render') ): 
    function reales_main_color_field_render() { 
        $options = get_option( 'reales_colors_settings' );
        ?>
        <input type="text" class="color-field" name="reales_colors_settings[reales_main_color_field]" value="<?php if(isset($options['reales_main_color_field'])) { echo esc_attr($options['reales_main_color_field']); } ?>">
        <?php
    }
endif;

if( !function_exists('reales_main_color_dark_field_render') ): 
    function reales_main_color_dark_field_render() { 
        $options = get_option( 'reales_colors_settings' );
        ?>
        <input type="text" class="color-field" name="reales_colors_settings[reales_main_color_dark_field]" value="<?php if(isset($options['reales_main_color_dark_field'])) echo esc_attr($options['reales_main_color_dark_field']); ?>">
        <?php
    }
endif;
if( !function_exists('reales_app_side_bg_field_render') ): 
    function reales_app_side_bg_field_render() { 
        $options = get_option( 'reales_colors_settings' );
        ?>
        <input type="text" class="color-field" name="reales_colors_settings[reales_app_side_bg_field]" value="<?php if(isset($options['reales_app_side_bg_field'])) echo esc_attr($options['reales_app_side_bg_field']); ?>">
        <?php
    }
endif;
if( !function_exists('reales_app_side_item_active_bg_field_render') ): 
    function reales_app_side_item_active_bg_field_render() { 
        $options = get_option( 'reales_colors_settings' );
        ?>
        <input type="text" class="color-field" name="reales_colors_settings[reales_app_side_item_active_bg_field]" value="<?php if(isset($options['reales_app_side_item_active_bg_field'])) echo esc_attr($options['reales_app_side_item_active_bg_field']); ?>">
        <?php
    }
endif;
if( !function_exists('reales_app_side_sub_bg_field_render') ): 
    function reales_app_side_sub_bg_field_render() { 
        $options = get_option( 'reales_colors_settings' );
        ?>
        <input type="text" class="color-field" name="reales_colors_settings[reales_app_side_sub_bg_field]" value="<?php if(isset($options['reales_app_side_sub_bg_field'])) echo esc_attr($options['reales_app_side_sub_bg_field']); ?>">
        <?php
    }
endif;
if( !function_exists('reales_app_side_sub_item_active_bg_field_render') ): 
    function reales_app_side_sub_item_active_bg_field_render() { 
        $options = get_option( 'reales_colors_settings' );
        ?>
        <input type="text" class="color-field" name="reales_colors_settings[reales_app_side_sub_item_active_bg_field]" value="<?php if(isset($options['reales_app_side_sub_item_active_bg_field'])) echo esc_attr($options['reales_app_side_sub_item_active_bg_field']); ?>">
        <?php
    }
endif;
if( !function_exists('reales_app_side_text_color_field_render') ): 
    function reales_app_side_text_color_field_render() { 
        $options = get_option( 'reales_colors_settings' );
        ?>
        <input type="text" class="color-field" name="reales_colors_settings[reales_app_side_text_color_field]" value="<?php if(isset($options['reales_app_side_text_color_field'])) echo esc_attr($options['reales_app_side_text_color_field']); ?>">
        <?php
    }
endif;
if( !function_exists('reales_app_side_sub_text_color_field_render') ): 
    function reales_app_side_sub_text_color_field_render() { 
        $options = get_option( 'reales_colors_settings' );
        ?>
        <input type="text" class="color-field" name="reales_colors_settings[reales_app_side_sub_text_color_field]" value="<?php if(isset($options['reales_app_side_sub_text_color_field'])) echo esc_attr($options['reales_app_side_sub_text_color_field']); ?>">
        <?php
    }
endif;
if( !function_exists('reales_app_top_item_active_color_field_render') ): 
    function reales_app_top_item_active_color_field_render() { 
        $options = get_option( 'reales_colors_settings' );
        ?>
        <input type="text" class="color-field" name="reales_colors_settings[reales_app_top_item_active_color_field]" value="<?php if(isset($options['reales_app_top_item_active_color_field'])) echo esc_attr($options['reales_app_top_item_active_color_field']); ?>">
        <?php
    }
endif;
if( !function_exists('reales_footer_bg_field_render') ): 
    function reales_footer_bg_field_render() { 
        $options = get_option( 'reales_colors_settings' );
        ?>
        <input type="text" class="color-field" name="reales_colors_settings[reales_footer_bg_field]" value="<?php if(isset($options['reales_footer_bg_field'])) echo esc_attr($options['reales_footer_bg_field']); ?>">
        <?php
    }
endif;
if( !function_exists('reales_footer_header_color_field_render') ): 
    function reales_footer_header_color_field_render() { 
        $options = get_option( 'reales_colors_settings' );
        ?>
        <input type="text" class="color-field" name="reales_colors_settings[reales_footer_header_color_field]" value="<?php if(isset($options['reales_footer_header_color_field'])) echo esc_attr($options['reales_footer_header_color_field']); ?>">
        <?php
    }
endif;
if( !function_exists('reales_prop_type_badge_bg_field_render') ): 
    function reales_prop_type_badge_bg_field_render() { 
        $options = get_option( 'reales_colors_settings' );
        ?>
        <input type="text" class="color-field" name="reales_colors_settings[reales_prop_type_badge_bg_field]" value="<?php if(isset($options['reales_prop_type_badge_bg_field'])) echo esc_attr($options['reales_prop_type_badge_bg_field']); ?>">
        <?php
    }
endif;
if( !function_exists('reales_prop_featured_badge_bg_field_render') ): 
    function reales_prop_featured_badge_bg_field_render() { 
        $options = get_option( 'reales_colors_settings' );
        ?>
        <input type="text" class="color-field" name="reales_colors_settings[reales_prop_featured_badge_bg_field]" value="<?php if(isset($options['reales_prop_featured_badge_bg_field'])) echo esc_attr($options['reales_prop_featured_badge_bg_field']); ?>">
        <?php
    }
endif;
if( !function_exists('reales_fav_icon_color_field_render') ): 
    function reales_fav_icon_color_field_render() { 
        $options = get_option( 'reales_colors_settings' );
        ?>
        <input type="text" class="color-field" name="reales_colors_settings[reales_fav_icon_color_field]" value="<?php if(isset($options['reales_fav_icon_color_field'])) echo esc_attr($options['reales_fav_icon_color_field']); ?>">
        <?php
    }
endif;
if( !function_exists('reales_marker_color_field_render') ): 
    function reales_marker_color_field_render() { 
        $options = get_option( 'reales_colors_settings' );
        ?>
        <input type="text" class="color-field" name="reales_colors_settings[reales_marker_color_field]" value="<?php if(isset($options['reales_marker_color_field'])) echo esc_attr($options['reales_marker_color_field']); ?>">
        <?php
    }
endif;
if( !function_exists('reales_prop_pending_label_bg_field_render') ): 
    function reales_prop_pending_label_bg_field_render() { 
        $options = get_option( 'reales_colors_settings' );
        ?>
        <input type="text" class="color-field" name="reales_colors_settings[reales_prop_pending_label_bg_field]" value="<?php if(isset($options['reales_prop_pending_label_bg_field'])) echo esc_attr($options['reales_prop_pending_label_bg_field']); ?>">
        <?php
    }
endif;

?>
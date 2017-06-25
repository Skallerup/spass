<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if( !function_exists('reales_admin_appearance') ): 
    function reales_admin_appearance() {
        add_settings_section( 'reales_appearance_section', __( 'Appearance', 'reales' ), 'reales_appearance_section_callback', 'reales_appearance_settings' );
        add_settings_field( 'reales_user_menu_field', __( 'Show user menu in header', 'reales' ), 'reales_user_menu_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_home_header_field', __( 'Homepage header type', 'reales' ), 'reales_home_header_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_autoslide_field', __( 'Custom slider autoslide', 'reales' ), 'reales_autoslide_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_home_rev_alias_field', __( 'Slider Revolution alias', 'reales' ), 'reales_home_rev_alias_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_home_header_video_field', __( 'Homepage header video (mp4)', 'reales' ), 'reales_home_header_video_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_home_header_video_cover_field', __( 'Homepage header video cover', 'reales' ), 'reales_home_header_video_cover_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_shadow_opacity_field', __( 'Header image shadow opacity', 'reales' ), 'reales_shadow_opacity_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_home_caption_field', __( 'Show homepage caption', 'reales' ), 'reales_home_caption_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_home_caption_title_field', __( 'Homepage caption title', 'reales' ), 'reales_home_caption_title_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_home_caption_subtitle_field', __( 'Homepage caption subtitle', 'reales' ), 'reales_home_caption_subtitle_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_home_caption_cta_field', __( 'Show homepage caption cta button', 'reales' ), 'reales_home_caption_cta_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_home_caption_cta_text_field', __( 'Homepage caption cta button text', 'reales' ), 'reales_home_caption_cta_text_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_home_caption_cta_link_field', __( 'Homepage caption cta button link', 'reales' ), 'reales_home_caption_cta_link_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_home_spotlight_field', __( 'Show homepage spotlight section', 'reales' ), 'reales_home_spotlight_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_home_spotlight_title_field', __( 'Homepage spotlight section title', 'reales' ), 'reales_home_spotlight_title_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_home_spotlight_text_field', __( 'Homepage spotlight section text', 'reales' ), 'reales_home_spotlight_text_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_sidebar_field', __( 'Sidebar position', 'reales' ), 'reales_sidebar_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_nomap_field', __( 'Disable side map on properties pages', 'reales' ), 'reales_nomap_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_related_field', __( 'Show related articles on blog post', 'reales' ), 'reales_related_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_leftside_menu_field', __( 'Show left side menu in app view', 'reales' ), 'reales_leftside_menu_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_properties_per_page_field', __( 'Number of properties per page', 'reales' ), 'reales_properties_per_page_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_similar_field', __( 'Show similar properties on property page', 'reales' ), 'reales_similar_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_breadcrumbs_field', __( 'Show breadcrumbs on pages', 'reales' ), 'reales_breadcrumbs_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
        add_settings_field( 'reales_copyright_field', __( 'Copyright text', 'reales' ), 'reales_copyright_field_render', 'reales_appearance_settings', 'reales_appearance_section' );
    }
endif;

if( !function_exists('reales_appearance_section_callback') ): 
    function reales_appearance_section_callback() { 
        echo '';
    }
endif;

if( !function_exists('reales_user_menu_field_render') ): 
    function reales_user_menu_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <input type="checkbox" name="reales_appearance_settings[reales_user_menu_field]" <?php if(isset($options['reales_user_menu_field'])) { checked( $options['reales_user_menu_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

if( !function_exists('reales_home_header_field_render') ): 
    function reales_home_header_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        $headers = array("slideshow", "custom slider", "slider revolution", "video", "google map");
        $header_select = '<select id="reales_appearance_settings[reales_home_header_field]" name="reales_appearance_settings[reales_home_header_field]">';

        foreach($headers as $header) {
            $header_select .= '<option value="' . esc_attr($header) . '"';
            if(isset($options['reales_home_header_field']) && $options['reales_home_header_field'] == $header) {
                $header_select .= 'selected="selected"';
            }
            $header_select .= '>' . esc_html($header) . '</option>';
        }

        $header_select .= '</select>';
        $header_select .= '<p class="help">For Slider Revolution option you need to have the plugin (the theme doesn\'t inlcude the plugin).</p>';

        print $header_select;
    }
endif;

if( !function_exists('reales_autoslide_field_render') ): 
    function reales_autoslide_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <input type="checkbox" name="reales_appearance_settings[autoslide_delay]" style="margin-right: 20px;" <?php if(isset($options['autoslide_delay'])) { checked( $options['autoslide_delay'], 1 ); } ?>  value="1">
        <label class="sliderLabel">
            <?php esc_html_e('Delay time', 'reales');?>:&nbsp;
            <input type="text" size="6" name="reales_appearance_settings[autoslide_delay_time]" value="<?php if(isset($options['autoslide_delay_time'])) { echo esc_attr($options['autoslide_delay_time']); } ?>">
            <i><?php esc_html_e('miliseconds', 'reales'); ?></i>
        </label>
        <?php
    }
endif;

if( !function_exists('reales_home_rev_alias_field_render') ): 
    function reales_home_rev_alias_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <input type="text" size="40" name="reales_appearance_settings[reales_home_rev_alias_field]" value="<?php if(isset($options['reales_home_rev_alias_field'])) { echo esc_attr($options['reales_home_rev_alias_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_home_header_video_field_render') ): 
    function reales_home_header_video_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <input id="homeVideo" type="text" size="40" name="reales_appearance_settings[reales_home_header_video_field]" value="<?php if(isset($options['reales_home_header_video_field'])) { echo esc_attr($options['reales_home_header_video_field']); } ?>" />
        <input id="homeVideoBtn" type="button"  class="button" value="<?php esc_html_e('Browse...','reales') ?>" />
        <?php
    }
endif;

if( !function_exists('reales_home_header_video_cover_field_render') ): 
    function reales_home_header_video_cover_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <input id="homeVideoCover" type="text" size="40" name="reales_appearance_settings[reales_home_header_video_cover_field]" value="<?php if(isset($options['reales_home_header_video_cover_field'])) { echo esc_attr($options['reales_home_header_video_cover_field']); } ?>" />
        <input id="homeVideoCoverBtn" type="button"  class="button" value="<?php esc_html_e('Browse...','reales') ?>" />
        <p class="help">Set video cover for devices that doesn't spport video backgrounds.</p>
        <?php
    }
endif;

if( !function_exists('reales_shadow_opacity_field_render') ): 
    function reales_shadow_opacity_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        $opacities = array("0", "10", "20", "30", "40", "50", "60", "70", "80", "90");
        $opacity_select = '<select id="reales_appearance_settings[reales_shadow_opacity_field]" name="reales_appearance_settings[reales_shadow_opacity_field]">';

        foreach($opacities as $opacity) {
            $opacity_select .= '<option value="' . esc_attr($opacity) . '"';
            if(isset($options['reales_shadow_opacity_field']) && $options['reales_shadow_opacity_field'] == $opacity) {
                $opacity_select .= 'selected="selected"';
            }
            $opacity_select .= '>' . esc_html($opacity) . '</option>';
        }

        $opacity_select .= '</select> %';

        print $opacity_select;
    }
endif;

if( !function_exists('reales_home_caption_field_render') ): 
    function reales_home_caption_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <input type="checkbox" name="reales_appearance_settings[reales_home_caption_field]" <?php if(isset($options['reales_home_caption_field'])) { checked( $options['reales_home_caption_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

if( !function_exists('reales_home_caption_title_field_render') ): 
    function reales_home_caption_title_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <input type="text" size="40" name="reales_appearance_settings[reales_home_caption_title_field]" value="<?php if(isset($options['reales_home_caption_title_field'])) { echo esc_attr($options['reales_home_caption_title_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_home_caption_subtitle_field_render') ): 
    function reales_home_caption_subtitle_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <input type="text" size="40" name="reales_appearance_settings[reales_home_caption_subtitle_field]" value="<?php if(isset($options['reales_home_caption_subtitle_field'])) { echo esc_attr($options['reales_home_caption_subtitle_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_home_caption_cta_field_render') ): 
    function reales_home_caption_cta_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <input type="checkbox" name="reales_appearance_settings[reales_home_caption_cta_field]" <?php if(isset($options['reales_home_caption_cta_field'])) { checked( $options['reales_home_caption_cta_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

if( !function_exists('reales_home_caption_cta_text_field_render') ): 
    function reales_home_caption_cta_text_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <input type="text" size="40" name="reales_appearance_settings[reales_home_caption_cta_text_field]" value="<?php if(isset($options['reales_home_caption_cta_text_field'])) { echo esc_attr($options['reales_home_caption_cta_text_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_home_caption_cta_link_field_render') ): 
    function reales_home_caption_cta_link_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <input type="text" size="40" name="reales_appearance_settings[reales_home_caption_cta_link_field]" value="<?php if(isset($options['reales_home_caption_cta_link_field'])) { echo esc_attr($options['reales_home_caption_cta_link_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_home_spotlight_field_render') ): 
    function reales_home_spotlight_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <input type="checkbox" name="reales_appearance_settings[reales_home_spotlight_field]" <?php if(isset($options['reales_home_spotlight_field'])) { checked( $options['reales_home_spotlight_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

if( !function_exists('reales_home_spotlight_title_field_render') ): 
    function reales_home_spotlight_title_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <input type="text" size="40" name="reales_appearance_settings[reales_home_spotlight_title_field]" value="<?php if(isset($options['reales_home_spotlight_title_field'])) { echo esc_attr($options['reales_home_spotlight_title_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_home_spotlight_text_field_render') ): 
    function reales_home_spotlight_text_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <textarea cols='40' rows='5' name='reales_appearance_settings[reales_home_spotlight_text_field]'><?php if(isset($options['reales_home_spotlight_text_field'])) { echo esc_html($options['reales_home_spotlight_text_field']); } ?></textarea>
        <?php
    }
endif;

if( !function_exists('reales_sidebar_field_render') ): 
    function reales_sidebar_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        $sidebars = array("left", "right");
        $sidebar_select = '<select id="reales_appearance_settings[reales_sidebar_field]" name="reales_appearance_settings[reales_sidebar_field]">';

        foreach($sidebars as $sidebar) {
            $sidebar_select .= '<option value="' . esc_attr($sidebar) . '"';
            if(isset($options['reales_sidebar_field']) && $options['reales_sidebar_field'] == $sidebar) {
                $sidebar_select .= 'selected="selected"';
            }
            $sidebar_select .= '>' . esc_html($sidebar) . '</option>';
        }

        $sidebar_select .= '</select>';

        print $sidebar_select;
    }
endif;

if( !function_exists('reales_nomap_field_render') ): 
    function reales_nomap_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <input type="checkbox" name="reales_appearance_settings[reales_nomap_field]" <?php if(isset($options['reales_nomap_field'])) { checked( $options['reales_nomap_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

if( !function_exists('reales_related_field_render') ): 
    function reales_related_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <input type="checkbox" name="reales_appearance_settings[reales_related_field]" <?php if(isset($options['reales_related_field'])) { checked( $options['reales_related_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

if( !function_exists('reales_leftside_menu_field_render') ): 
    function reales_leftside_menu_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <input type="checkbox" name="reales_appearance_settings[reales_leftside_menu_field]" <?php if(isset($options['reales_leftside_menu_field'])) { checked( $options['reales_leftside_menu_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

if( !function_exists('reales_properties_per_page_field_render') ): 
    function reales_properties_per_page_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <input type="text" size="5" name="reales_appearance_settings[reales_properties_per_page_field]" value="<?php if(isset($options['reales_properties_per_page_field'])) { echo esc_attr($options['reales_properties_per_page_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_similar_field_render') ): 
    function reales_similar_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <input type="checkbox" name="reales_appearance_settings[reales_similar_field]" <?php if(isset($options['reales_similar_field'])) { checked( $options['reales_similar_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

if( !function_exists('reales_breadcrumbs_field_render') ): 
    function reales_breadcrumbs_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <input type="checkbox" name="reales_appearance_settings[reales_breadcrumbs_field]" <?php if(isset($options['reales_breadcrumbs_field'])) { checked( $options['reales_breadcrumbs_field'], 1 ); } ?> value="1">
        <?php
    }
endif;

if( !function_exists('reales_copyright_field_render') ): 
    function reales_copyright_field_render() { 
        $options = get_option( 'reales_appearance_settings' );
        ?>
        <textarea cols='40' rows='5' name='reales_appearance_settings[reales_copyright_field]'><?php if(isset($options['reales_copyright_field'])) { echo esc_html($options['reales_copyright_field']); } ?></textarea>
        <?php
    }
endif;

?>
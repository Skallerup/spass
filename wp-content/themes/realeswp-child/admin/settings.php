<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

add_action( 'admin_menu', 'reales_add_admin_menu' );
add_action( 'admin_init', 'reales_settings_init' );

if( !function_exists('reales_add_admin_menu') ): 
    function reales_add_admin_menu() { 
        add_theme_page('Reales WP Settings', 'Reales WP Settings', 'administrator', 'admin/settings.php', 'reales_settings_page');
    }
endif;

if( !function_exists('reales_settings_init') ): 
    function reales_settings_init() {
        wp_enqueue_style('font_awesome', get_template_directory_uri().'/css/font-awesome.css', false, '1.0', 'all');
        wp_enqueue_style('simple_line_icons', get_template_directory_uri().'/css/simple-line-icons.css', false, '1.0', 'all');
        // wp_enqueue_style('tagsinput_style', get_template_directory_uri().'/css/jquery.tagsinput.css', false, '1.0', 'all');
        wp_enqueue_style('reales_settings_style', get_template_directory_uri().'/admin/css/style.css', false, '1.0', 'all');
        wp_enqueue_style('reales_icons_style', get_template_directory_uri().'/css/icons.css', false, '1.0', 'all');
        wp_enqueue_script('media-upload');
        wp_enqueue_style('thickbox');
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('my-upload');
        // wp_enqueue_script('tagsinput', get_template_directory_uri().'/js/jquery.tagsinput.min.js', false, '1.0', true);
        wp_enqueue_script('settings', get_template_directory_uri().'/admin/js/admin.js', array('wp-color-picker'), '1.0', true);

        wp_localize_script('settings', 'settings_vars', 
            array(  
                'amenities_placeholder' => __('Add new', 'reales'),
                'admin_url'             => get_admin_url(),
                'ajaxurl'               => admin_url('admin-ajax.php'),
                'text'                  => __('Text', 'reales'),
                'numeric'               => __('Numeric', 'reales'),
                'date'                  => __('Date', 'reales'),
                'list'                  => __('List', 'reales'),
                'no'                    => __('No', 'reales'),
                'yes'                   => __('Yes', 'reales'),
                'delete'                => __('Delete', 'reales'),
                'equal'                 => __('Equal', 'reales'),
                'greater'               => __('Greater', 'reales'),
                'smaller'               => __('Smaller', 'reales'),
                'like'                  => __('Like', 'reales')
            )
        );

        register_setting( 'reales_general_settings', 'reales_general_settings' );
        register_setting( 'reales_contact_settings', 'reales_contact_settings' );
        register_setting( 'reales_appearance_settings', 'reales_appearance_settings' );
        register_setting( 'reales_slider_settings', 'reales_slider_settings' );
        register_setting( 'reales_gmaps_settings', 'reales_gmaps_settings' );
        register_setting( 'reales_colors_settings', 'reales_colors_settings' );
        register_setting( 'reales_cities_settings', 'reales_cities_settings' );
        register_setting( 'reales_amenity_settings', 'reales_amenity_settings' );
        register_setting( 'reales_prop_fields_settings', 'reales_prop_fields_settings' );
        register_setting( 'reales_fields_settings', 'reales_fields_settings' );
        register_setting( 'reales_search_settings', 'reales_search_settings' );
        register_setting( 'reales_filter_settings', 'reales_filter_settings' );
        register_setting( 'reales_auth_settings', 'reales_auth_settings' );
        register_setting( 'reales_captcha_settings', 'reales_captcha_settings' );
        register_setting( 'reales_membership_settings', 'reales_membership_settings' );
        register_setting( 'reales_notifications_settings', 'reales_notifications_settings' );
        register_setting( 'reales_css_settings', 'reales_css_settings' );
    }
endif;

/**
 * Load media files needed for Uploader
 */
if( !function_exists('reales_load_wp_media_files') ): 
    function reales_load_wp_media_files() {
        wp_enqueue_media();
    }
endif;
add_action('admin_enqueue_scripts', 'reales_load_wp_media_files');

require_once 'sections/general.php';
require_once 'sections/contact.php';
require_once 'sections/appearance.php';
require_once 'sections/slider.php';
require_once 'sections/gmaps.php';
require_once 'sections/colors.php';
require_once 'sections/cities.php';
require_once 'sections/amenities.php';
require_once 'sections/property_fields.php';
require_once 'sections/custom_fields.php';
require_once 'sections/search_fields.php';
require_once 'sections/filter_fields.php';
require_once 'sections/auth.php';
require_once 'sections/captcha.php';
require_once 'sections/membership.php';
require_once 'sections/notifications.php';
require_once 'sections/custom_css.php';

if( !function_exists('reales_settings_page') ): 
    function reales_settings_page() { 
        $allowed_html = array();
        $active_tab = isset($_GET['tab']) ? wp_kses($_GET['tab'], $allowed_html) : 'general_settings';
        $tab = 'reales_general_settings';

        switch ($active_tab) {
            case "general_settings":
                reales_admin_general_settings();
                $tab = 'reales_general_settings';
                break;
            case "contact":
                reales_admin_contact();
                $tab = 'reales_contact_settings';
                break;
            case "appearance":
                reales_admin_appearance();
                $tab = 'reales_appearance_settings';
                break;
            case "slider":
                reales_admin_slider();
                $tab = 'reales_slider_settings';
                break;
            case "gmaps":
                reales_admin_gmaps();
                $tab = 'reales_gmaps_settings';
                break;
            case "colors":
                reales_admin_colors();
                $tab = 'reales_colors_settings';
                break;
            case "cities":
                reales_admin_cities();
                $tab = 'reales_cities_settings';
                break;
            case "amenities":
                reales_admin_amenities();
                $tab = 'reales_amenity_settings';
                break;
            case "property_fields":
                reales_admin_prop_fields();
                $tab = 'reales_prop_fields_settings';
                break;
            case "fields":
                reales_admin_fields();
                $tab = 'reales_fields_settings';
                break;
            case "search":
                reales_admin_search();
                $tab = 'reales_search_settings';
                break;
            case "filter":
                reales_admin_filter();
                $tab = 'reales_filter_settings';
                break;
            case "auth":
                reales_admin_auth();
                $tab = 'reales_auth_settings';
                break;
            case "captcha":
                reales_admin_captcha();
                $tab = 'reales_captcha_settings';
                break;
            case "membership":
                reales_admin_membership();
                $tab = 'reales_membership_settings';
                break;
            case "notifications":
                reales_admin_notifications();
                $tab = 'reales_notifications_settings';
                break;
            case "css":
                reales_admin_css();
                $tab = 'reales_css_settings';
                break;
        }
        ?>

        <div class="reales-wrapper">
            <div class="reales-leftSide">
                <div class="reales-logo"><span class="fa fa-home"></span> Reales WP Settings</div>
                <ul class="reales-tabs">
                    <li class="<?php echo $active_tab == 'general_settings' ? 'reales-tab-active' : '' ?>">
                        <a href="themes.php?page=admin/settings.php&tab=general_settings">
                            <span class="icon-settings reales-tab-icon"></span><span class="reales-tab-link"><?php esc_html_e('General Settings','reales') ?></span>
                        </a>
                    </li>
                    <li class="<?php echo $active_tab == 'contact' ? 'reales-tab-active' : '' ?>">
                        <a href="themes.php?page=admin/settings.php&tab=contact">
                            <span class="icon-envelope reales-tab-icon"></span><span class="reales-tab-link"><?php esc_html_e('Contact','reales') ?></span>
                        </a>
                    </li>
                    <li class="<?php echo $active_tab == 'appearance' ? 'reales-tab-active' : '' ?>">
                        <a href="themes.php?page=admin/settings.php&tab=appearance">
                            <span class="icon-screen-desktop reales-tab-icon"></span><span class="reales-tab-link"><?php esc_html_e('Appearance','reales') ?></span>
                        </a>
                    </li>
                    <li class="<?php echo $active_tab == 'slider' ? 'reales-tab-active' : '' ?>">
                        <a href="themes.php?page=admin/settings.php&tab=slider">
                            <span class="icon-picture reales-tab-icon"></span><span class="reales-tab-link"><?php esc_html_e('Homepage Custom Slider','reales') ?></span>
                        </a>
                    </li>
                    <li class="<?php echo $active_tab == 'gmaps' ? 'reales-tab-active' : '' ?>">
                        <a href="themes.php?page=admin/settings.php&tab=gmaps">
                            <span class="icon-map reales-tab-icon"></span><span class="reales-tab-link"><?php esc_html_e('Google Maps','reales') ?></span>
                        </a>
                    </li>
                    <li class="<?php echo $active_tab == 'colors' ? 'reales-tab-active' : '' ?>">
                        <a href="themes.php?page=admin/settings.php&tab=colors">
                            <span class="icon-drop reales-tab-icon"></span><span class="reales-tab-link"><?php esc_html_e('Colors','reales') ?></span>
                        </a>
                    </li>
                    <li class="<?php echo $active_tab == 'cities' ? 'reales-tab-active' : '' ?>">
                        <a href="themes.php?page=admin/settings.php&tab=cities">
                            <span class="icon-direction reales-tab-icon"></span><span class="reales-tab-link"><?php esc_html_e('Cities','reales') ?></span>
                        </a>
                    </li>
                    <li class="<?php echo $active_tab == 'amenities' ? 'reales-tab-active' : '' ?>">
                        <a href="themes.php?page=admin/settings.php&tab=amenities">
                            <span class="icon-grid reales-tab-icon"></span><span class="reales-tab-link"><?php esc_html_e('Amenities','reales') ?></span>
                        </a>
                    </li>
                    <li class="<?php echo $active_tab == 'property_fields' ? 'reales-tab-active' : '' ?>">
                        <a href="themes.php?page=admin/settings.php&tab=property_fields">
                            <span class="icon-list reales-tab-icon"></span><span class="reales-tab-link"><?php esc_html_e('Property Fields','reales') ?></span>
                        </a>
                    </li>
                    <li class="<?php echo $active_tab == 'fields' ? 'reales-tab-active' : '' ?>">
                        <a href="themes.php?page=admin/settings.php&tab=fields">
                            <span class="icon-plus reales-tab-icon"></span><span class="reales-tab-link"><?php esc_html_e('Property Custom Fields','reales') ?></span>
                        </a>
                    </li>
                    <li class="<?php echo $active_tab == 'search' ? 'reales-tab-active' : '' ?>">
                        <a href="themes.php?page=admin/settings.php&tab=search">
                            <span class="icon-magnifier reales-tab-icon"></span><span class="reales-tab-link"><?php esc_html_e('Search Area Fields','reales') ?></span>
                        </a>
                    </li>
                    <li class="<?php echo $active_tab == 'filter' ? 'reales-tab-active' : '' ?>">
                        <a href="themes.php?page=admin/settings.php&tab=filter">
                            <span class="icon-equalizer reales-tab-icon"></span><span class="reales-tab-link"><?php esc_html_e('Filter Area Fields','reales') ?></span>
                        </a>
                    </li>
                    <li class="<?php echo $active_tab == 'auth' ? 'reales-tab-active' : '' ?>">
                        <a href="themes.php?page=admin/settings.php&tab=auth">
                            <span class="icon-user reales-tab-icon"></span><span class="reales-tab-link"><?php esc_html_e('Authentication','reales') ?></span>
                        </a>
                    </li>
                    <li class="<?php echo $active_tab == 'captcha' ? 'reales-tab-active' : '' ?>">
                        <a href="themes.php?page=admin/settings.php&tab=captcha">
                            <span class="icon-check reales-tab-icon"></span><span class="reales-tab-link"><?php esc_html_e('reCAPTCHA','reales') ?></span>
                        </a>
                    </li>
                    <li class="<?php echo $active_tab == 'membership' ? 'reales-tab-active' : '' ?>">
                        <a href="themes.php?page=admin/settings.php&tab=membership">
                            <span class="icon-credit-card reales-tab-icon"></span><span class="reales-tab-link"><?php esc_html_e('Membership and Payment','reales') ?></span>
                        </a>
                    </li>
                    <li class="<?php echo $active_tab == 'notifications' ? 'reales-tab-active' : '' ?>">
                        <a href="themes.php?page=admin/settings.php&tab=notifications">
                            <span class="icon-bubbles reales-tab-icon"></span><span class="reales-tab-link"><?php esc_html_e('Notifications','reales') ?></span>
                        </a>
                    </li>
                    <li class="<?php echo $active_tab == 'css' ? 'reales-tab-active' : '' ?>">
                        <a href="themes.php?page=admin/settings.php&tab=css">
                            <span class="icon-layers reales-tab-icon"></span><span class="reales-tab-link"><?php esc_html_e('Custom CSS','reales') ?></span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="reales-content">
                <form action='options.php' method='post'>
                    <?php
                    wp_nonce_field('update-options');
                    settings_fields($tab);
                    do_settings_sections($tab);
                    submit_button();
                    ?>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>

        <?php
    }
endif;

?>
<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

$reales_appearance_settings = get_option('reales_appearance_settings','');
$reales_general_settings = get_option('reales_general_settings','');
$leftside_menu = isset($reales_appearance_settings['reales_leftside_menu_field']) ? $reales_appearance_settings['reales_leftside_menu_field'] : ''; ?>
<div id="header">
    <div class="logo">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php
            $logo = isset($reales_general_settings['reales_logo_field']) ? $reales_general_settings['reales_logo_field'] : '';
            $app_logo = isset($reales_general_settings['reales_app_logo_field']) ? $reales_general_settings['reales_app_logo_field'] : '';
            if($logo != '' && $app_logo != '') {
                print '<img src="' . esc_url($app_logo) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="logo-min" />';
                print '<img src="' . esc_url($logo) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="logo-full" />';
            } else {
                print '<span class="fa fa-home marker"></span><span class="logoText">' . esc_html(get_bloginfo('name')) . '</span>';
            }
            ?>
        </a>
    </div>
    <?php if($leftside_menu) { ?>
    <a href="javascript:void(0);" class="navHandler"><span class="fa fa-ellipsis-v"></span></a>
    <?php } ?>
    <a href="javascript:void(0);" class="mapHandler"><span class="icon-map"></span></a>
    <?php 
        $user_menu = isset($reales_appearance_settings['reales_user_menu_field']) ? $reales_appearance_settings['reales_user_menu_field'] : false;
        if($user_menu) {
            get_template_part('templates/user_menu');
        }
    ?>
    <a href="javascript:void(0);" class="top-navHandler visible-xs"><span class="fa fa-bars"></span></a>
    <?php 
    $reales_filter_settings      = get_option('reales_filter_settings');
    $f_city_field                = isset($reales_filter_settings['reales_f_city_field']) ? $reales_filter_settings['reales_f_city_field'] : '';
    $h_city_field                = isset($reales_filter_settings['reales_h_city_field']) ? $reales_filter_settings['reales_h_city_field'] : '';
    $search_city                 = isset($_GET['search_city']) ? stripslashes(sanitize_text_field($_GET['search_city'])) : '';
    $reales_prop_fields_settings = get_option('reales_prop_fields_settings');
    $p_city_t                    = isset($reales_prop_fields_settings['reales_p_city_t_field']) ? $reales_prop_fields_settings['reales_p_city_t_field'] : '';

    if($f_city_field != '' && $f_city_field == 'enabled' && $h_city_field != '' && $p_city_t != 'list') { ?>
        <div class="search">
            <span class="searchIcon icon-magnifier"></span>
            <input type="text" name="header_city" id="header_city" placeholder="<?php esc_html_e('Search by city...', 'reales'); ?>" value="<?php echo esc_attr($search_city); ?>" autocomplete="off">
        </div>
    <?php } ?>
    <div class="top-nav">
        <?php
        wp_nav_menu( array( 'theme_location' => 'primary' ) );
        ?>
    </div>
    <div class="clearfix"></div>
</div>
<?php 
if($leftside_menu) {
    get_template_part('templates/leftside_menu');
}
?>
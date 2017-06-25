<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

$reales_general_settings = get_option('reales_general_settings','');
$reales_appearance_settings = get_option('reales_appearance_settings','');
?>
<div class="home-header">
    <div class="home-logo osLight">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php
            $logo = isset($reales_general_settings['reales_logo_field']) ? $reales_general_settings['reales_logo_field'] : '';
            if($logo != '') {
                print '<img src="' . esc_url($logo) . '" alt="' . esc_attr(get_bloginfo('name')) . '"/>';
            } else {
                print '<span class="fa fa-home"></span> ' . esc_html(get_bloginfo('name'));
            }
            ?>
        </a>
    </div>
    <?php 
        $user_menu = isset($reales_appearance_settings['reales_user_menu_field']) ? $reales_appearance_settings['reales_user_menu_field'] : false;
        if($user_menu) {
            get_template_part('templates/user_menu');
        }
    ?>
    <a href="javascript:void(0);" class="top-navHandler visible-xs"><span class="fa fa-bars"></span></a>
    <div class="top-nav">
        <?php
        wp_nav_menu( array( 'theme_location' => 'primary' ) );
        ?>
    </div>
</div>
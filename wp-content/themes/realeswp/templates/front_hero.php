<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

$reales_appearance_settings = get_option('reales_appearance_settings','');
$home_header = isset($reales_appearance_settings['reales_home_header_field']) ? $reales_appearance_settings['reales_home_header_field'] : '';
$home_header_video = isset($reales_appearance_settings['reales_home_header_video_field']) ? $reales_appearance_settings['reales_home_header_video_field'] : ''; 
$home_header_video_cover = isset($reales_appearance_settings['reales_home_header_video_cover_field']) ? $reales_appearance_settings['reales_home_header_video_cover_field'] : ''; 
$home_header_rev_alias = isset($reales_appearance_settings['reales_home_rev_alias_field']) ? $reales_appearance_settings['reales_home_rev_alias_field'] : ''; 

$reales_gmaps_settings = get_option('reales_gmaps_settings','');
$home_map_lat = isset($reales_gmaps_settings['reales_gmaps_lat_field']) ? $reales_gmaps_settings['reales_gmaps_lat_field'] : '';
$home_map_lng = isset($reales_gmaps_settings['reales_gmaps_lng_field']) ? $reales_gmaps_settings['reales_gmaps_lng_field'] : '';
?>


<div id="hero-container">
    <?php if($home_header == 'slideshow') { ?>
        <div id="slideshow">
            <?php 
            $images = reales_get_slideshow_images();
            $counter = 0;
            foreach ($images as $image) {
                if($counter == 0) {
                    echo "<div style='background-image: url(" . esc_url($image) . ")'></div>";
                } else {
                    echo "<div style='background-image: url(" . esc_url($image) . "); display:none;'></div>";
                }
                $counter++;
            }
            ?>
        </div>
        <div class="slideshowShadow"></div>
    <?php } else if($home_header == 'custom slider') {
        get_template_part('templates/home_slider');
    } else if($home_header == 'slider revolution' && $home_header_rev_alias != '') { ?>
        <?php putRevSlider($home_header_rev_alias); ?>
    <?php } else if($home_header == 'video') { ?>
        <video autoplay id="bgvid" loop muted controls>
            <source src="<?php echo esc_url($home_header_video); ?>" type="video/mp4">
        </video>
        <div class="bgvid-cover" style="background-image: url('<?php echo esc_url($home_header_video_cover); ?>');"></div>
        <div class="slideshowShadow"></div>
    <?php } else { ?>
        <div id="homeMap" data-lat="<?php echo esc_attr($home_map_lat); ?>" data-lng="<?php echo esc_attr($home_map_lng); ?>"></div>
        <?php wp_nonce_field('home_map_ajax_nonce', 'securityHomeMap', true);
    }

?>
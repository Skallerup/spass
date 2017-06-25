<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

$reales_slider_settings     = get_option('reales_slider_settings');
$reales_appearance_settings = get_option('reales_appearance_settings');
$slider_auto                = isset($reales_appearance_settings['autoslide_delay']) ? $reales_appearance_settings['autoslide_delay'] : '';
$slider_auto_time           = isset($reales_appearance_settings['autoslide_delay_time']) ? $reales_appearance_settings['autoslide_delay_time'] : '0';

$slider_interval = '';

if($slider_auto != '' && is_numeric($slider_auto_time)) {
    $slider_interval = $slider_auto_time;
}

$display = '<div id="homeSlider" class="carousel slide featured" data-ride="carousel" data-interval="' . esc_attr($slider_interval) . '">';

if(is_array($reales_slider_settings) && count($reales_slider_settings) > 0) {
    uasort($reales_slider_settings, "reales_compare_position");

    $display .= '<ol class="carousel-indicators">';
    for($i = 0; $i < count($reales_slider_settings); $i++) {
        $display .= '<li data-target="#homeSlider" data-slide-to="' . esc_attr($i) . '"';
        if($i == 0) $display .= 'class="active"';
        $display .= ' ></li>';
    }
    $display .= '</ol>';
    $display .= '<div class="carousel-inner">';

    $slides = 0;
    foreach($reales_slider_settings as $key => $value) {
        $display .= '<div class="item';
        if ($slides == 0) $display .= ' active';
        $display .= '" style="background-image: url(' . esc_url($value['image']) . ')">';
        $display .=     '<div class="container">';
        $display .=         '<div class="carousel-caption">';
        $display .=             '<div class="caption-title">' . esc_html($value['title']) . '</div>';
        $display .=             '<div class="caption-subtitle">' . esc_html($value['subtitle']) . '</div>';
        if($value['cta_text'] != '' && $value['cta_link'] != '') {
            $display .=         '<a href="' . esc_url($value['cta_link']) . '" class="btn btn-lg btn-o btn-white">' . $value['cta_text'] . '</a>';
        }
        $display .=         '</div>';
        $display .=     '</div>';
        $display .= '</div>';

        $slides++;
    }
}

$display .=     '</div>';
$display .=     '<a class="left carousel-control" href="#homeSlider" role="button" data-slide="prev"><span class="fa fa-chevron-left"></span></a>';
$display .=     '<a class="right carousel-control" href="#homeSlider" role="button" data-slide="next"><span class="fa fa-chevron-right"></span></a>';
$display .= '</div>';

print $display;
?>
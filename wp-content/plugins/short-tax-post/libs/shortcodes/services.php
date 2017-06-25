<?php
/**
 * Services shortcode
 */
if( !function_exists('reales_services_shortcode') ): 
    function reales_services_shortcode($attrs, $content = null) {
        extract(shortcode_atts(array(
            'stitle' => 'Services Title',
            'show' => '4',
            's1icon' => 'icon-pointer',
            's1title' => '1st Service Title',
            's1text' => '1st Service Text',
            's1link' => '#',
            's2icon' => 'icon-users',
            's2title' => '2nd Service Title',
            's2text' => '2nd Service Text',
            's2link' => '#',
            's3icon' => 'icon-home',
            's3title' => '3rd Service Title',
            's3text' => '3rd Service Text',
            's3link' => '3rd Service Link',
            's4icon' => 'icon-cloud-upload',
            's4title' => '4th Service Title',
            's4text' => '4th Service Text',
            's4link' => '#'
        ), $attrs));

        $return_string = '<h2 class="osLight centered">' . esc_html($stitle) . '</h2>';
        $return_string .= '<div class="row pb40">';

        if(esc_html($show) == '2') {
            $return_string .= '<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 s-menu-item">';
            $return_string .= '<a href="' . esc_url($s1link) . '">';
            $return_string .= '<span class="' . esc_attr($s1icon) . ' s-icon"></span>';
            $return_string .= '<div class="s-content">';
            $return_string .= '<h2 class="centered s-main osLight">' . esc_html($s1title) . '</h2>';
            $return_string .= '<h3 class="s-sub osLight">' . esc_html($s1text) . '</h3>';
            $return_string .= '</div>';
            $return_string .= '</a>';
            $return_string .= '</div>';

            $return_string .= '<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 s-menu-item">';
            $return_string .= '<a href="' . esc_url($s2link) . '">';
            $return_string .= '<span class="' . esc_attr($s2icon) . ' s-icon"></span>';
            $return_string .= '<div class="s-content">';
            $return_string .= '<h2 class="centered s-main osLight">' . esc_html($s2title) . '</h2>';
            $return_string .= '<h3 class="s-sub osLight">' . esc_html($s2text) . '</h3>';
            $return_string .= '</div>';
            $return_string .= '</a>';
            $return_string .= '</div>';
        } else if(esc_html($show) == '3') {
            $return_string .= '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 s-menu-item">';
            $return_string .= '<a href="' . esc_url($s1link) . '">';
            $return_string .= '<span class="' . esc_attr($s1icon) . ' s-icon"></span>';
            $return_string .= '<div class="s-content">';
            $return_string .= '<h2 class="centered s-main osLight">' . esc_html($s1title) . '</h2>';
            $return_string .= '<h3 class="s-sub osLight">' . esc_html($s1text) . '</h3>';
            $return_string .= '</div>';
            $return_string .= '</a>';
            $return_string .= '</div>';

            $return_string .= '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 s-menu-item">';
            $return_string .= '<a href="' . esc_url($s2link) . '">';
            $return_string .= '<span class="' . esc_attr($s2icon) . ' s-icon"></span>';
            $return_string .= '<div class="s-content">';
            $return_string .= '<h2 class="centered s-main osLight">' . esc_html($s2title) . '</h2>';
            $return_string .= '<h3 class="s-sub osLight">' . esc_html($s2text) . '</h3>';
            $return_string .= '</div>';
            $return_string .= '</a>';
            $return_string .= '</div>';

            $return_string .= '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 s-menu-item">';
            $return_string .= '<a href="' . esc_url($s3link) . '">';
            $return_string .= '<span class="' . esc_attr($s3icon) . ' s-icon"></span>';
            $return_string .= '<div class="s-content">';
            $return_string .= '<h2 class="centered s-main osLight">' . esc_html($s3title) . '</h2>';
            $return_string .= '<h3 class="s-sub osLight">' . esc_html($s3text) . '</h3>';
            $return_string .= '</div>';
            $return_string .= '</a>';
            $return_string .= '</div>';
        } else {
            $return_string .= '<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 s-menu-item">';
            $return_string .= '<a href="' . esc_url($s1link) . '">';
            $return_string .= '<span class="' . esc_attr($s1icon) . ' s-icon"></span>';
            $return_string .= '<div class="s-content">';
            $return_string .= '<h2 class="centered s-main osLight">' . esc_html($s1title) . '</h2>';
            $return_string .= '<h3 class="s-sub osLight">' . esc_html($s1text) . '</h3>';
            $return_string .= '</div>';
            $return_string .= '</a>';
            $return_string .= '</div>';

            $return_string .= '<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 s-menu-item">';
            $return_string .= '<a href="' . esc_url($s2link) . '">';
            $return_string .= '<span class="' . esc_attr($s2icon) . ' s-icon"></span>';
            $return_string .= '<div class="s-content">';
            $return_string .= '<h2 class="centered s-main osLight">' . esc_html($s2title) . '</h2>';
            $return_string .= '<h3 class="s-sub osLight">' . esc_html($s2text) . '</h3>';
            $return_string .= '</div>';
            $return_string .= '</a>';
            $return_string .= '</div>';

            $return_string .= '<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 s-menu-item">';
            $return_string .= '<a href="' . esc_url($s3link) . '">';
            $return_string .= '<span class="' . esc_attr($s3icon) . ' s-icon"></span>';
            $return_string .= '<div class="s-content">';
            $return_string .= '<h2 class="centered s-main osLight">' . esc_html($s3title) . '</h2>';
            $return_string .= '<h3 class="s-sub osLight">' . esc_html($s3text) . '</h3>';
            $return_string .= '</div>';
            $return_string .= '</a>';
            $return_string .= '</div>';

            $return_string .= '<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 s-menu-item">';
            $return_string .= '<a href="' . esc_url($s4link) . '">';
            $return_string .= '<span class="' . esc_attr($s4icon) . ' s-icon"></span>';
            $return_string .= '<div class="s-content">';
            $return_string .= '<h2 class="centered s-main osLight">' . esc_html($s4title) . '</h2>';
            $return_string .= '<h3 class="s-sub osLight">' . esc_html($s4text) . '</h3>';
            $return_string .= '</div>';
            $return_string .= '</a>';
            $return_string .= '</div>';
        }

        $return_string .= '</div>';

        wp_reset_query();
        return $return_string;
    }
endif;
?>
<?php
/**
 * Testimonials shortcode
 */
if( !function_exists('reales_testimonials_shortcode') ): 
    function reales_testimonials_shortcode($attrs, $content = null) {
        extract(shortcode_atts(array(
            'title' => 'Testimonials'
        ), $attrs));

        $args = array(
                'posts_per_page'   => -1,
                'post_type'        => 'testimonials',
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'suppress_filters' => false,
                'post_status'      => 'publish' );
        $posts = get_posts($args);

        $return_string = '<h2 class="centered osLight">' . esc_html($title) . '</h2>';
        $return_string .= '<div class="row pb40">';
        $return_string .= '<div id="home-testimonials" class="carousel slide carousel-wb mb20" data-ride="carousel">';
        $return_string .= '<ol class="carousel-indicators">';
        for($i = 0; $i < count($posts); $i++) {
            $return_string .= '<li data-target="#home-testimonials" data-slide-to="' . esc_attr($i) . '"';
            if($i == 0) $return_string .= 'class="active"';
            $return_string .= ' ></li>';
        }
        $return_string .= '</ol>';
        $return_string .= '<div class="carousel-inner">';
        $counter = 0;
        foreach($posts as $post) : setup_postdata($post);
            $avatar = get_post_meta($post->ID, 'testimonials_avatar', true);
            if($avatar != '') {
                $avatar_src = $avatar;
            } else {
                $avatar_src = get_template_directory_uri().'/images/avatar.png';
            }
            $text = get_post_meta($post->ID, 'testimonials_text', true);

            $return_string .= '<div class="item';
            if($counter == 0) $return_string .= ' active';
            $return_string .= '">';
            $return_string .= '<img src="' . esc_url($avatar_src) . '" class="home-testim-avatar" alt="' . esc_attr($post->post_title) . '">';
            $return_string .= '<div class="home-testim">';
            $return_string .= '<div class="home-testim-text">' . esc_html($text) . '</div>';
            $return_string .= '<div class="home-testim-name">' . esc_html($post->post_title) . '</div>';
            $return_string .= '</div>';
            $return_string .= '</div>';
            $counter++;
        endforeach;
        $return_string .= '</div>';
        $return_string .= '</div>';
        $return_string .= '</div>';

        wp_reset_postdata();
        wp_reset_query();
        return $return_string;
    }
endif;
?>
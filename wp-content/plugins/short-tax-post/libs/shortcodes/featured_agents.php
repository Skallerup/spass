<?php
/**
 * Featured agents shortcode
 */
if( !function_exists('reales_featured_agents_shortcode') ): 
    function reales_featured_agents_shortcode($attrs, $content = null) {
        $reales_general_settings = get_option('reales_general_settings','');
        $show_rating = isset($reales_general_settings['reales_agents_rating_field']) ? $reales_general_settings['reales_agents_rating_field'] : '';

        extract(shortcode_atts(array(
            'title' => 'Our Agents'
        ), $attrs));

        if(isset($attrs['show']) && is_numeric($attrs['show'])) {
            $show = $attrs['show'];
        } else {
            $show = '4';
        }

        $args = array(
                'posts_per_page'   => $show,
                'post_type'        => 'agent',
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'meta_key'         => 'agent_featured',
                'meta_value'       => '1',
                'suppress_filters' => false,
                'post_status'      => 'publish' );
        $posts = get_posts($args);

        $return_string = '<h2 class="centered osLight">' . esc_html($title) . '</h2>';
        $return_string .= '<div class="row pb40">';
        foreach($posts as $post) : setup_postdata($post);
            $avatar = get_post_meta($post->ID, 'agent_avatar', true);
            if($avatar != '') {
                $avatar_src = $avatar;
            } else {
                $avatar_src = get_template_directory_uri().'/images/avatar.png';
            }
            $email = get_post_meta($post->ID, 'agent_email', true);
            $facebook = get_post_meta($post->ID, 'agent_facebook', true);
            $twitter = get_post_meta($post->ID, 'agent_twitter', true);
            $google = get_post_meta($post->ID, 'agent_google', true);
            $linkedin = get_post_meta($post->ID, 'agent_linkedin', true);

            if(intval($show) % 3 == 0) {
                $return_string .= '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">';
            } else if(intval($show) == 2) {
                $return_string .= '<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">';
            } else if(intval($show) == 1) {
                $return_string .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
            } else {
                $return_string .= '<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">';
            }
            $return_string .= '<div class="agent">';
            $return_string .= '<a href="' . esc_url(get_permalink($post->ID)) . '" class="agent-avatar">';
            $return_string .= '<img src="' . esc_url($avatar_src) . '" alt="' . esc_attr($post->post_title) . '">';
            $return_string .= '<div class="ring"></div>';
            $return_string .= '</a>';
            $return_string .= '<div class="agent-name osLight">' . esc_html($post->post_title) . '</div>';

            if($show_rating != '') {
                $return_string .= reales_display_agent_rating(reales_get_agent_ratings($post->ID), false);
            }

            $return_string .= '<div class="agent-contact">';
            $return_string .= '<a href="' . esc_url(get_permalink($post->ID)) . '" class="btn btn-sm btn-icon btn-round btn-o btn-green"><span class="fa fa-link"></span></a> ';
            if($facebook && $facebook != '') {
                $return_string .= '<a href="' . esc_url($facebook) . '" class="btn btn-sm btn-icon btn-round btn-o btn-facebook" target="_blank"><span class="fa fa-facebook"></span></a> ';
            }
            if($twitter && $twitter != '') {
                $return_string .= '<a href="' . esc_url($twitter) . '" class="btn btn-sm btn-icon btn-round btn-o btn-twitter" target="_blank"><span class="fa fa-twitter"></span></a> ';
            }
            if($google && $google != '') {
                $return_string .= '<a href="' . esc_url($google) . '" class="btn btn-sm btn-icon btn-round btn-o btn-google" target="_blank"><span class="fa fa-google-plus"></span></a> ';
            }
            if($linkedin && $linkedin != '') {
                $return_string .= '<a href="' . esc_url($linkedin) . '" class="btn btn-sm btn-icon btn-round btn-o btn-linkedin" target="_blank"><span class="fa fa-linkedin"></span></a>';
            }
            $return_string .= '</div>';
            $return_string .= '</div>';
            $return_string .= '</div>';
        endforeach;
        $return_string .= '</div>';

        wp_reset_postdata();
        wp_reset_query();
        return $return_string;
    }
endif;
?>
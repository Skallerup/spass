<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

class Featured_Agents_Widget extends WP_Widget {
    function Featured_Agents_Widget() {
        $widget_ops = array('classname' => 'featured_agents_sidebar', 'description' => 'Featured agents.');
        $control_ops = array('id_base' => 'featured_agents_widget');
        parent::__construct('featured_agents_widget', 'Reales WP Featured Agents', $widget_ops, $control_ops);
    }

    function form($instance) {
        $defaults = array(
            'title' => '',
            'limit' => ''
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        $display = '
            <p>
                <label for="' . esc_attr($this->get_field_id('title')) . '">' . __('Title', 'reales') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" value="' . esc_attr($instance['title']) . '" />
            </p>
            <p>
                <label for="' . esc_attr($this->get_field_id('limit')) . '">' . __('Number of agents to show', 'reales') . ':</label>
                <input type="text" size="3" id="' . esc_attr($this->get_field_id('limit')) . '" name="' . esc_attr($this->get_field_name('limit')) . '" value="' . esc_attr($instance['limit']) . '" />
            </p>
        ';

        print $display;
    }


    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['limit'] = sanitize_text_field($new_instance['limit']);

        if(function_exists('icl_register_string')) {
            icl_register_string('reales_featured_agents_widget', 'featured_agents_widget_title', sanitize_text_field($new_instance['title']));
            icl_register_string('reales_featured_agents_widget', 'featured_agents_widget_limit', sanitize_text_field($new_instance['limit']));
        }

        return $instance;
    }

    function widget($args, $instance) {
        $reales_general_settings = get_option('reales_general_settings','');
        $show_rating = isset($reales_general_settings['reales_agents_rating_field']) ? $reales_general_settings['reales_agents_rating_field'] : '';

        extract($args);
        $display = '';
        $title = apply_filters('widget_title', $instance['title']);

        print $before_widget;

        if($title) {
            print $before_title . esc_html($title) . $after_title;
        }

        if($instance['limit'] && $instance['limit'] != '') {
            $limit = $instance['limit'];
        } else {
            $limit = 4;
        }

        $args = array(
            'posts_per_page'   => $instance['limit'],
            'post_type'        => 'agent',
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'meta_key'         => 'agent_featured',
            'meta_value'       => '1',
            'suppress_filters' => false,
            'post_status'      => 'publish' );
        $posts = get_posts($args);

        $has_rating = $show_rating != '' ? ' hasRating' : '';

        $display .= '<div class="agentsWidget' . $has_rating . '"><ul class="agentsList">';
        foreach($posts as $post) : setup_postdata($post);
            $avatar = get_post_meta($post->ID, 'agent_avatar', true);
            $specs = get_post_meta($post->ID, 'agent_specs', true);

            $display .= '<li>';
            $display .= '<a href="' . get_permalink($post->ID) . '">';
            $display .= '<div class="image"><img src="' . esc_url($avatar) . '" alt="' . esc_attr($title) . '" /></div>';
            $display .= '<div class="info text-nowrap">';
            $display .= '<div class="name">' . esc_html($post->post_title) . '</div>';
            if($show_rating != '') {
                $display .= reales_display_agent_rating(reales_get_agent_ratings($post->ID), false);
            }
            $display .= '<div class="title">' . esc_html($specs) . '</div>';
            $display .= '</div>';
            $display .= '<div class="clearfix"></div>';
            $display .= '</a>';
            $display .= '</li>';
        endforeach;

        $display .= '</ul></div>';

        wp_reset_postdata();
        wp_reset_query();
        print $display;
        print $after_widget;
    }

}

?>
<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

class Social_Widget extends WP_Widget {
    function Social_Widget() {
        $widget_ops = array('classname' => 'social_sidebar', 'description' => 'Social networks links.');
        $control_ops = array('id_base' => 'social_widget');
        parent::__construct('social_widget', 'Reales WP Social Networks', $widget_ops, $control_ops);
    }

    function form($instance) {
        $defaults = array(
            'title' => '',
            'facebook' => '',
            'twitter' => '',
            'google' => '',
            'linkedin' => '',
            'instagram' => ''
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        $display = '
            <p>
                <label for="' . esc_attr($this->get_field_id('title')) . '">' . __('Title', 'reales') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" value="' . esc_attr($instance['title']) . '" />
            </p>
            <p>
                <label for="' . esc_attr($this->get_field_id('facebook')) . '">' . __('Facebook Link', 'reales') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('facebook')) . '" name="' . esc_attr($this->get_field_name('facebook')) . '" value="' . esc_attr($instance['facebook']) . '" />
            </p>
            <p>
                <label for="' . esc_attr($this->get_field_id('twitter')) . '">' . __('Twitter Link', 'reales') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('twitter')) . '" name="' . esc_attr($this->get_field_name('twitter')) . '" value="' . esc_attr($instance['twitter']) . '" />
            </p>
            <p>
                <label for="' . esc_attr($this->get_field_id('google')) . '">' . __('Google+ Link', 'reales') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('google')) . '" name="' . esc_attr($this->get_field_name('google')) . '" value="' . esc_attr($instance['google']) . '" />
            </p>
            <p>
                <label for="' . esc_attr($this->get_field_id('linkedin')) . '">' . __('LinkedIn Link', 'reales') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('linkedin')) . '" name="' . esc_attr($this->get_field_name('linkedin')) . '" value="' . esc_attr($instance['linkedin']) . '" />
            </p>
            <p>
                <label for="' . esc_attr($this->get_field_id('instagram')) . '">' . __('Instagram Link', 'reales') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('instagram')) . '" name="' . esc_attr($this->get_field_name('instagram')) . '" value="' . esc_attr($instance['instagram']) . '" />
            </p>
        ';

        print $display;
    }


    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['facebook'] = sanitize_text_field($new_instance['facebook']);
        $instance['twitter'] = sanitize_text_field($new_instance['twitter']);
        $instance['google'] = sanitize_text_field($new_instance['google']);
        $instance['linkedin'] = sanitize_text_field($new_instance['linkedin']);
        $instance['instagram'] = sanitize_text_field($new_instance['instagram']);

        if(function_exists('icl_register_string')) {
            icl_register_string('reales_social_widget', 'social_widget_title', sanitize_text_field($new_instance['title']));
            icl_register_string('reales_social_widget', 'social_widget_facebook', sanitize_text_field($new_instance['facebook']));
            icl_register_string('reales_social_widget', 'social_widget_twitter', sanitize_text_field($new_instance['twitter']));
            icl_register_string('reales_social_widget', 'social_widget_google', sanitize_text_field($new_instance['google']));
            icl_register_string('reales_social_widget', 'social_widget_linkedin', sanitize_text_field($new_instance['linkedin']));
            icl_register_string('reales_social_widget', 'social_widget_instagram', sanitize_text_field($new_instance['instagram']));
        }

        return $instance;
    }

    function widget($args, $instance) {
        extract($args);
        $display = '';
        $title = apply_filters('widget_title', $instance['title']);

        print $before_widget;

        if($title) {
            print $before_title . esc_html($title) . $after_title;
        }

        $display .= '<ul><li>';
        if($instance['facebook']) {
            if(function_exists('icl_t')) {
                $social_facebook = icl_t('reales_social_widget', 'social_widget_facebook', $instance['facebook']);
            } else {
                $social_facebook = $instance['facebook'];
            }
            $display .= '<a href="' . esc_url($social_facebook) . '" class="btn btn-sm btn-icon btn-round btn-o btn-white" target="_blank"><span class="fa fa-facebook"></span></a> ';
        }
        if($instance['twitter']) {
            if(function_exists('icl_t')) {
                $social_twitter = icl_t('reales_social_widget', 'social_widget_twitter', $instance['twitter']);
            } else {
                $social_twitter = $instance['twitter'];
            }
            $display .= '<a href="' . esc_url($social_twitter) . '" class="btn btn-sm btn-icon btn-round btn-o btn-white" target="_blank"><span class="fa fa-twitter"></span></a> ';
        }
        if($instance['google']) {
            if(function_exists('icl_t')) {
                $social_google = icl_t('reales_social_widget', 'social_widget_google', $instance['google']);
            } else {
                $social_google = $instance['google'];
            }
            $display .= '<a href="' . esc_url($social_google) . '" class="btn btn-sm btn-icon btn-round btn-o btn-white" target="_blank"><span class="fa fa-google-plus"></span></a> ';
        }
        if($instance['linkedin']) {
            if(function_exists('icl_t')) {
                $social_linkedin = icl_t('reales_social_widget', 'social_widget_linkedin', $instance['linkedin']);
            } else {
                $social_linkedin = $instance['linkedin'];
            }
            $display .= '<a href="' . esc_url($social_linkedin) . '" class="btn btn-sm btn-icon btn-round btn-o btn-white" target="_blank"><span class="fa fa-linkedin"></span></a> ';
        }
        if($instance['instagram']) {
            if(function_exists('icl_t')) {
                $social_instagram = icl_t('reales_social_widget', 'social_widget_instagram', $instance['instagram']);
            } else {
                $social_instagram = $instance['instagram'];
            }
            $display .= '<a href="' . esc_url($social_instagram) . '" class="btn btn-sm btn-icon btn-round btn-o btn-white" target="_blank"><span class="fa fa-instagram"></span></a> ';
        }
        $display .= '</li></ul>';

        print $display;
        print $after_widget;
    }

}

?>
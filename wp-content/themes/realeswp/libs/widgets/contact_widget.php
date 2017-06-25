<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

class Contact_Widget extends WP_Widget {
    function Contact_Widget() {
        $widget_ops = array('classname' => 'contact_sidebar', 'description' => 'Your contact information.');
        $control_ops = array('id_base' => 'contact_widget');
        parent::__construct('contact_widget', 'Reales WP Contact', $widget_ops, $control_ops);
    }

    function form($instance) {
        $defaults = array(
            'title' => '',
            'phone' => '',
            'address' => '',
            'city' => '',
            'state' => '',
            'zip' => '',
            'country' => ''
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        $display = '
            <p>
                <label for="' . esc_attr($this->get_field_id('title')) . '">' . __('Title', 'reales') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" value="' . esc_attr($instance['title']) . '" />
            </p>
            <p>
                <label for="' . esc_attr($this->get_field_id('phone')) . '">' . __('Phone', 'reales') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('phone')) . '" name="' . esc_attr($this->get_field_name('phone')) . '" value="' . esc_attr($instance['phone']) . '" />
            </p>
            <p>
                <label for="' . esc_attr($this->get_field_id('address')) . '">' . __('Address', 'reales') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('address')) . '" name="' . esc_attr($this->get_field_name('address')) . '" value="' . esc_attr($instance['address']) . '" />
            </p>
            <p>
                <label for="' . esc_attr($this->get_field_id('city')) . '">' . __('City', 'reales') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('city')) . '" name="' . esc_attr($this->get_field_name('city')) . '" value="' . esc_attr($instance['city']) . '" />
            </p>
            <p>
                <label for="' . esc_attr($this->get_field_id('state')) . '">' . __('State/County', 'reales') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('state')) . '" name="' . esc_attr($this->get_field_name('state')) . '" value="' . esc_attr($instance['state']) . '" />
            </p>
            <p>
                <label for="' . esc_attr($this->get_field_id('zip')) . '">' . __('Zip code', 'reales') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('zip')) . '" name="' . esc_attr($this->get_field_name('zip')) . '" value="' . esc_attr($instance['zip']) . '" />
            </p>
            <p>
                <label for="' . esc_attr($this->get_field_id('country')) . '">' . __('Country', 'reales') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('country')) . '" name="' . esc_attr($this->get_field_name('country')) . '" value="' . esc_attr($instance['country']) . '" />
            </p>
        ';

        print $display;
    }


    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['phone'] = sanitize_text_field($new_instance['phone']);
        $instance['address'] = sanitize_text_field($new_instance['address']);
        $instance['city'] = sanitize_text_field($new_instance['city']);
        $instance['state'] = sanitize_text_field($new_instance['state']);
        $instance['zip'] = sanitize_text_field($new_instance['zip']);
        $instance['country'] = sanitize_text_field($new_instance['country']);

        if(function_exists('icl_register_string')) {
            icl_register_string('reales_contact_widget', 'contact_widget_title', sanitize_text_field($new_instance['title']));
            icl_register_string('reales_contact_widget', 'contact_widget_phone', sanitize_text_field($new_instance['phone']));
            icl_register_string('reales_contact_widget', 'contact_widget_address', sanitize_text_field($new_instance['address']));
            icl_register_string('reales_contact_widget', 'contact_widget_city', sanitize_text_field($new_instance['city']));
            icl_register_string('reales_contact_widget', 'contact_widget_state', sanitize_text_field($new_instance['state']));
            icl_register_string('reales_contact_widget', 'contact_widget_zip', sanitize_text_field($new_instance['zip']));
            icl_register_string('reales_contact_widget', 'contact_widget_country', sanitize_text_field($new_instance['country']));
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

        $display .= '<ul>';
        if($instance['phone']) {
            if(function_exists('icl_t')) {
                $info_phone = icl_t('reales_contact_widget', 'contact_widget_phone', $instance['phone']);
            } else {
                $info_phone = $instance['phone'];
            }
            $display .= '<li class="widget-phone"><span class="fa fa-phone"></span> ' . esc_html($info_phone) . '</li>';
        }
        $display .= '<li class="widget-address osLight">';
        if($instance['address']) {
            if(function_exists('icl_t')) {
                $info_address = icl_t('reales_contact_widget', 'contact_widget_address', $instance['address']);
            } else {
                $info_address = $instance['address'];
            }
            $display .= '<p>' . esc_html($info_address) . '</p>';
        }
        $display .= '<p>';
        if($instance['city']) {
            if(function_exists('icl_t')) {
                $info_city = icl_t('reales_contact_widget', 'contact_widget_city', $instance['city']);
            } else {
                $info_city = $instance['city'];
            }
            $display .= esc_html($info_city) . ', ';
        }
        if($instance['state']) {
            if(function_exists('icl_t')) {
                $info_state = icl_t('reales_contact_widget', 'contact_widget_state', $instance['state']);
            } else {
                $info_state = $instance['state'];
            }
            $display .= esc_html($info_state) . ' ';
        }
        if($instance['zip']) {
            if(function_exists('icl_t')) {
                $info_zip = icl_t('reales_contact_widget', 'contact_widget_zip', $instance['zip']);
            } else {
                $info_zip = $instance['zip'];
            }
            $display .= esc_html($info_zip);
        }
        $display .= '</p>';
        if($instance['country']) {
            if(function_exists('icl_t')) {
                $info_country = icl_t('reales_contact_widget', 'contact_widget_country', $instance['country']);
            } else {
                $info_country = $instance['country'];
            }
            $display .= '<p>' . esc_html($info_country) . '</p>';
        }
        $display .= '</li></ul>';

        print $display;
        print $after_widget;
    }

}

?>
<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

class Search_Widget extends WP_Widget {
    function Search_Widget() {
        $widget_ops = array('classname' => 'search_sidebar', 'description' => 'Properties search form.');
        $control_ops = array('id_base' => 'search_widget');
        parent::__construct('search_widget', 'Reales WP Search Properties Form', $widget_ops, $control_ops);
    }

    function form($instance) {
        $defaults = array(
            'title' => '',
            'country' => '0',
            'state' => '0',
            'city' => '1',
            'neighborhood' => '0',
            'category' => '0',
            'type' => '0',
            'price' => '0',
            'area' => '0',
            'bedrooms' => '0',
            'bathrooms' => '0'
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        $display = '
            <p>
                <label for="' . esc_attr($this->get_field_id('title')) . '">' . __('Title', 'reales') . ':</label>
                <input type="text" class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" value="' . esc_attr($instance['title']) . '" />
            </p>
            <p>
                <label for="' . esc_attr($this->get_field_id('country')) . '">' . __('Country', 'reales') . ':</label>
                <select id="' . esc_attr($this->get_field_id('country')) . '" name="' . esc_attr($this->get_field_name('country')) . '">
                    <option value="0" ';
        if(esc_attr($instance['country']) == '0') {
            $display .= 'selected';
        }
        $display .= '>' . __('disabled', 'reales') . '</option>
                    <option value="1" ';
        if(esc_attr($instance['country']) == '1') {
            $display .= 'selected';
        }
        $display .= '>' . __('enabled', 'reales') . '</option>
                </select>
            </p>
        ';

        $display .= '
            <p>
                <label for="' . esc_attr($this->get_field_id('state')) . '">' . __('State/County', 'reales') . ':</label>
                <select id="' . esc_attr($this->get_field_id('state')) . '" name="' . esc_attr($this->get_field_name('state')) . '">
                    <option value="0" ';
        if(esc_attr($instance['state']) == '0') {
            $display .= 'selected';
        }
        $display .= '>' . __('disabled', 'reales') . '</option>
                    <option value="1" ';
        if(esc_attr($instance['state']) == '1') {
            $display .= 'selected';
        }
        $display .= '>' . __('enabled', 'reales') . '</option>
                </select>
            </p>
        ';

        $display .= '
            <p>
                <label for="' . esc_attr($this->get_field_id('city')) . '">' . __('City', 'reales') . ':</label>
                <select id="' . esc_attr($this->get_field_id('city')) . '" name="' . esc_attr($this->get_field_name('city')) . '">
                    <option value="0" ';
        if(esc_attr($instance['city']) == '0') {
            $display .= 'selected';
        }
        $display .= '>' . __('disabled', 'reales') . '</option>
                    <option value="1" ';
        if(esc_attr($instance['city']) == '1') {
            $display .= 'selected';
        }
        $display .= '>' . __('enabled', 'reales') . '</option>
                </select>
            </p>
        ';

        $display .= '
            <p>
                <label for="' . esc_attr($this->get_field_id('neighborhood')) . '">' . __('Neighborhood', 'reales') . ':</label>
                <select id="' . esc_attr($this->get_field_id('neighborhood')) . '" name="' . esc_attr($this->get_field_name('neighborhood')) . '">
                    <option value="0" ';
        if(esc_attr($instance['neighborhood']) == '0') {
            $display .= 'selected';
        }
        $display .= '>' . __('disabled', 'reales') . '</option>
                    <option value="1" ';
        if(esc_attr($instance['neighborhood']) == '1') {
            $display .= 'selected';
        }
        $display .= '>' . __('enabled', 'reales') . '</option>
                </select>
            </p>
        ';

        $display .= '
            <p>
                <label for="' . esc_attr($this->get_field_id('category')) . '">' . __('Category', 'reales') . ':</label>
                <select id="' . esc_attr($this->get_field_id('category')) . '" name="' . esc_attr($this->get_field_name('category')) . '">
                    <option value="0" ';
        if(esc_attr($instance['category']) == '0') {
            $display .= 'selected';
        }
        $display .= '>' . __('disabled', 'reales') . '</option>
                    <option value="1" ';
        if(esc_attr($instance['category']) == '1') {
            $display .= 'selected';
        }
        $display .= '>' . __('enabled', 'reales') . '</option>
                </select>
            </p>
        ';

        $display .= '
            <p>
                <label for="' . esc_attr($this->get_field_id('type')) . '">' . __('Type', 'reales') . ':</label>
                <select id="' . esc_attr($this->get_field_id('type')) . '" name="' . esc_attr($this->get_field_name('type')) . '">
                    <option value="0" ';
        if(esc_attr($instance['type']) == '0') {
            $display .= 'selected';
        }
        $display .= '>' . __('disabled', 'reales') . '</option>
                    <option value="1" ';
        if(esc_attr($instance['type']) == '1') {
            $display .= 'selected';
        }
        $display .= '>' . __('enabled', 'reales') . '</option>
                </select>
            </p>
        ';

        $display .= '
            <p>
                <label for="' . esc_attr($this->get_field_id('price')) . '">' . __('Price', 'reales') . ':</label>
                <select id="' . esc_attr($this->get_field_id('price')) . '" name="' . esc_attr($this->get_field_name('price')) . '">
                    <option value="0" ';
        if(esc_attr($instance['price']) == '0') {
            $display .= 'selected';
        }
        $display .= '>' . __('disabled', 'reales') . '</option>
                    <option value="1" ';
        if(esc_attr($instance['price']) == '1') {
            $display .= 'selected';
        }
        $display .= '>' . __('enabled', 'reales') . '</option>
                </select>
            </p>
        ';

        $display .= '
            <p>
                <label for="' . esc_attr($this->get_field_id('area')) . '">' . __('Area', 'reales') . ':</label>
                <select id="' . esc_attr($this->get_field_id('area')) . '" name="' . esc_attr($this->get_field_name('area')) . '">
                    <option value="0" ';
        if(esc_attr($instance['area']) == '0') {
            $display .= 'selected';
        }
        $display .= '>' . __('disabled', 'reales') . '</option>
                    <option value="1" ';
        if(esc_attr($instance['area']) == '1') {
            $display .= 'selected';
        }
        $display .= '>' . __('enabled', 'reales') . '</option>
                </select>
            </p>
        ';

        $display .= '
            <p>
                <label for="' . esc_attr($this->get_field_id('bedrooms')) . '">' . __('Bedrooms', 'reales') . ':</label>
                <select id="' . esc_attr($this->get_field_id('bedrooms')) . '" name="' . esc_attr($this->get_field_name('bedrooms')) . '">
                    <option value="0" ';
        if(esc_attr($instance['bedrooms']) == '0') {
            $display .= 'selected';
        }
        $display .= '>' . __('disabled', 'reales') . '</option>
                    <option value="1" ';
        if(esc_attr($instance['bedrooms']) == '1') {
            $display .= 'selected';
        }
        $display .= '>' . __('enabled', 'reales') . '</option>
                </select>
            </p>
        ';

        $display .= '
            <p>
                <label for="' . esc_attr($this->get_field_id('bathrooms')) . '">' . __('Bathrooms', 'reales') . ':</label>
                <select id="' . esc_attr($this->get_field_id('bathrooms')) . '" name="' . esc_attr($this->get_field_name('bathrooms')) . '">
                    <option value="0" ';
        if(esc_attr($instance['bathrooms']) == '0') {
            $display .= 'selected';
        }
        $display .= '>' . __('disabled', 'reales') . '</option>
                    <option value="1" ';
        if(esc_attr($instance['bathrooms']) == '1') {
            $display .= 'selected';
        }
        $display .= '>' . __('enabled', 'reales') . '</option>
                </select>
            </p>
        ';

        print $display;
    }


    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['country'] = sanitize_text_field($new_instance['country']);
        $instance['state'] = sanitize_text_field($new_instance['state']);
        $instance['city'] = sanitize_text_field($new_instance['city']);
        $instance['neighborhood'] = sanitize_text_field($new_instance['neighborhood']);
        $instance['category'] = sanitize_text_field($new_instance['category']);
        $instance['type'] = sanitize_text_field($new_instance['type']);
        $instance['price'] = sanitize_text_field($new_instance['price']);
        $instance['area'] = sanitize_text_field($new_instance['area']);
        $instance['bedrooms'] = sanitize_text_field($new_instance['bedrooms']);
        $instance['bathrooms'] = sanitize_text_field($new_instance['bathrooms']);

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


        $search_submit = reales_get_search_link();
        $cat_taxonomies = array( 
            'property_category'
        );
        $cat_args = array(
            'orderby'           => 'name', 
            'order'             => 'ASC',
            'hide_empty'        => false
        ); 
        $cat_terms = get_terms($cat_taxonomies, $cat_args);
        $type_taxonomies = array( 
            'property_type_category'
        );
        $type_args = array(
            'orderby'           => 'name', 
            'order'             => 'ASC',
            'hide_empty'        => false
        ); 
        $type_terms = get_terms($type_taxonomies, $type_args);
        $reales_general_settings = get_option('reales_general_settings');
        $reales_search_settings = get_option('reales_search_settings');
        $currency_symbol = isset($reales_general_settings['reales_currency_symbol_field']) ? $reales_general_settings['reales_currency_symbol_field'] : '';
        $area_unit = isset($reales_general_settings['reales_unit_field']) ? $reales_general_settings['reales_unit_field'] : '';

        $display .= '<form id="searchPropertyForm" role="search" method="get" action="' . esc_url($search_submit) . '">
                        <input type="hidden" name="sort" id="sort" value="newest" />';
        if(isset($instance['country']) &&  $instance['country'] == '1') {
            $country_default = isset($reales_general_settings['reales_country_field']) ? $reales_general_settings['reales_country_field'] : '';
            $display .= '
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    ' . reales_search_country_list($country_default) . '
                                </div>
                            </div>
                        </div>
            ';
        }
        if(isset($instance['state']) &&  $instance['state'] == '1') {
            $display .= '
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="search_state" name="search_state" placeholder="' . esc_attr(__('State/County', 'reales')) . '">
                                </div>
                            </div>
                        </div>
            ';
        }
        if(isset($instance['city']) &&  $instance['city'] == '1') {
            $reales_prop_fields_settings = get_option('reales_prop_fields_settings');
            $p_city_t = isset($reales_prop_fields_settings['reales_p_city_t_field']) ? $reales_prop_fields_settings['reales_p_city_t_field'] : '';
            $display .= '
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">';
            if($p_city_t == 'list') {
                $reales_cities_settings = get_option('reales_cities_settings');

                $display .= '<select id="search_city" name="search_city" class="form-control">
                                <option value="">' . __('Select a city', 'reales') . '</option>';
                if(is_array($reales_cities_settings) && count($reales_cities_settings) > 0) {
                    uasort($reales_cities_settings, "reales_compare_position");
                    foreach ($reales_cities_settings as $key => $value) {
                        $display .= '<option value="' . $key . '">' . $value['name'] . '</option>';
                    }
                }
                $display .= '</select>';
            } else {
                $display .=         '<input type="text" class="form-control auto" id="search_city" name="search_city" placeholder="' . esc_attr(__('City', 'reales')) . '" autocomplete="off">';
            }
            $display .=             '<input type="hidden" name="search_lat" id="search_lat" />
                                    <input type="hidden" name="search_lng" id="search_lng" />
                                </div>
                            </div>
                        </div>
            ';
        }
        if(isset($instance['neighborhood']) &&  $instance['neighborhood'] == '1') {
            $display .= '
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="search_neighborhood" name="search_neighborhood" placeholder="' . esc_attr(__('Neighborhood', 'reales')) . '" autocomplete="off">
                                </div>
                            </div>
                        </div>
            ';
        }
        if(isset($instance['category']) &&  $instance['category'] == '1') {
            $display .= '
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group fg-inline" style="margin-bottom: 15px;">
                                    <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-o btn-light-gray dropdown-toggle">
                                        <span class="dropdown-label">' . esc_html(__('Category', 'reales')) . '</span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-select">
                                        <li class="active"><input type="radio" name="search_category" value="0" checked="checked"><a href="javascript:void(0);">' . esc_html(__('Category', 'reales')) . '</a></li>';
            foreach($cat_terms as $cat_term) {
                $display .= '           <li><input type="radio" name="search_category" value="' . esc_attr($cat_term->term_id) . '"><a href="javascript:void(0);">' . esc_html($cat_term->name) . '</a></li>';
            }
            $display .= '           </ul>
                                </div>
                            </div>
                        </div>
            ';
        }
        if(isset($instance['type']) &&  $instance['type'] == '1') {
            $display .= '
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group fg-inline" style="margin-bottom: 15px;">
                                    <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-o btn-light-gray dropdown-toggle">
                                        <span class="dropdown-label">' . esc_html(__('Type', 'reales')) . '</span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-select">
                                        <li class="active"><input type="radio" name="search_type" value="0" checked="checked"><a href="javascript:void(0);">' . esc_html(__('Type', 'reales')) . '</a></li>';
            foreach($type_terms as $type_term) {
                $display .= '           <li><input type="radio" name="search_type" value="' . esc_attr($type_term->term_id) . '"><a href="javascript:void(0);">' . esc_html($type_term->name) . '</a></li>';
            }
            $display .= '           </ul>
                                </div>
                            </div>
                        </div>
            ';
        }
        if(isset($instance['price']) &&  $instance['price'] == '1') {
            $display .= '
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">' . esc_html($currency_symbol) . '</div>
                                        <input class="form-control price" type="text" name="search_min_price" id="search_min_price" placeholder="' . esc_attr(__('Min price', 'reales')) . '">
                                    </div>
                                </div>
                            </div>
                        </div>
            ';
            $display .= '
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">' . esc_html($currency_symbol) . '</div>
                                        <input class="form-control price" type="text" name="search_max_price" id="search_max_price" placeholder="' . esc_attr(__('Max price', 'reales')) . '">
                                    </div>
                                </div>
                            </div>
                        </div>
            ';
        }
        if(isset($instance['area']) &&  $instance['area'] == '1') {
            $display .= '
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="form-control price" type="text" name="search_min_area" id="search_min_area" placeholder="' . esc_attr(__('Min area', 'reales')) . '">
                                        <div class="input-group-addon">' . esc_html($area_unit) . '</div>
                                    </div>
                                </div>
                            </div>
                        </div>
            ';
            $display .= '
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="form-control price" type="text" name="search_max_area" id="search_max_area" placeholder="' . esc_attr(__('Max area', 'reales')) . '">
                                        <div class="input-group-addon">' . esc_html($area_unit) . '</div>
                                    </div>
                                </div>
                            </div>
                        </div>
            ';
        }
        if(isset($instance['bedrooms']) &&  $instance['bedrooms'] == '1') {
            $display .= '
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group fg-inline" style="margin-bottom: 15px;">
                                    <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-o btn-light-gray dropdown-toggle">
                                        <span class="dropdown-label">' . esc_html(__('Bedrooms', 'reales')) . '</span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-select">
                                        <li class="active"><input type="radio" name="search_bedrooms" value="0" checked="checked"><a href="javascript:void(0);">' . esc_html(__('Bedrooms', 'reales')) . '</a></li>
                                        <li><input type="radio" name="search_bedrooms" value="1"><a href="javascript:void(0);">1+</a></li>
                                        <li><input type="radio" name="search_bedrooms" value="2"><a href="javascript:void(0);">2+</a></li>
                                        <li><input type="radio" name="search_bedrooms" value="3"><a href="javascript:void(0);">3+</a></li>
                                        <li><input type="radio" name="search_bedrooms" value="4"><a href="javascript:void(0);">4+</a></li>
                                        <li><input type="radio" name="search_bedrooms" value="5"><a href="javascript:void(0);">5+</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
            ';
        }
        if(isset($instance['bathrooms']) &&  $instance['bathrooms'] == '1') {
            $display .= '
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group fg-inline" style="margin-bottom: 15px;">
                                    <a href="javascript:void(0);" data-toggle="dropdown" class="btn btn-o btn-light-gray dropdown-toggle">
                                        <span class="dropdown-label">' . esc_html(__('Bathrooms', 'reales')) . '</span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-select">
                                        <li class="active"><input type="radio" name="search_bathrooms" value="0" checked="checked"><a href="javascript:void(0);">' . esc_html(__('Bathrooms', 'reales')) . '</a></li>
                                        <li><input type="radio" name="search_bathrooms" value="1"><a href="javascript:void(0);">1+</a></li>
                                        <li><input type="radio" name="search_bathrooms" value="2"><a href="javascript:void(0);">2+</a></li>
                                        <li><input type="radio" name="search_bathrooms" value="3"><a href="javascript:void(0);">3+</a></li>
                                        <li><input type="radio" name="search_bathrooms" value="4"><a href="javascript:void(0);">4+</a></li>
                                        <li><input type="radio" name="search_bathrooms" value="5"><a href="javascript:void(0);">5+</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
            ';
        }
        $display .= '
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <input type="submit" id="searchPropertySubmit" class="btn btn-green btn-block" value="' . esc_attr(__('Search', 'reales')) . '">
                                </div>
                            </div>
                        </div>
        ';
        $display .= '</form>';

        print $display;
        print $after_widget;
    }

}

?>
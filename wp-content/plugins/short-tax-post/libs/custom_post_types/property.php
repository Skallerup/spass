<?php
/**
 * Register property custom post type
 */

if( !function_exists('reales_register_property_type_init') ): 
    function reales_register_property_type_init() {
        wp_enqueue_style('reales_plugin_style', PLUGIN_PATH . 'css/style.css', false, '1.0', 'all');
        wp_enqueue_style('datepicker_style', PLUGIN_PATH . '/css/datepicker.css', false, '1.0', 'all');

        wp_enqueue_script('jquery-ui', PLUGIN_PATH . '/js/jquery-ui.min.js', array('jquery'), '1.0', true);

        $reales_gmaps_settings = get_option('reales_gmaps_settings','');
        $gmaps_key             = isset($reales_gmaps_settings['reales_gmaps_key_field']) ? $reales_gmaps_settings['reales_gmaps_key_field'] : '';
        wp_enqueue_script('gmaps', 'https://maps.googleapis.com/maps/api/js?key='.$gmaps_key.'&amp;libraries=geometry&amp;libraries=places',array('jquery'), '1.0', true);

        wp_enqueue_script('boostrap-datepicker', PLUGIN_PATH . '/js/bootstrap-datepicker.js', false, '1.0', true);
        wp_enqueue_script('property', PLUGIN_PATH . '/js/property.js', false, '1.0', true);

        $reales_gmaps_settings = get_option('reales_gmaps_settings','');
        $default_lat = isset($reales_gmaps_settings['reales_gmaps_lat_field']) ? $reales_gmaps_settings['reales_gmaps_lat_field'] : '';
        $default_lng = isset($reales_gmaps_settings['reales_gmaps_lng_field']) ? $reales_gmaps_settings['reales_gmaps_lng_field'] : '';

        wp_localize_script('property', 'property_vars', 
            array('admin_url' => get_admin_url(),
                  'theme_url' => get_template_directory_uri(),
                  'plugins_url' => PLUGIN_PATH . '/images/',
                  'browse_text' => __('Browse...', 'reales'),
                  'delete_photo' => __('Delete', 'reales'),
                  'gallery_title' => __('Property photo gallery', 'reales'),
                  'gallery_btn' => __('Insert Photos', 'reales'),
                  'floorplans_title' => __('Property floor plans', 'reales'),
                  'floorplans_btn' => __('Insert Plans', 'reales'),
                  'default_lat' => $default_lat,
                  'default_lng' => $default_lng,
            )
        );
    }
endif;
add_action('init', 'reales_register_property_type_init');

if( !function_exists('reales_register_property_type') ): 
    function reales_register_property_type() {
        register_post_type('property', array(
            'labels' => array(
                'name'                  => __('Properties','reales'),
                'singular_name'         => __('Property','reales'),
                'add_new'               => __('Add New Property','reales'),
                'add_new_item'          => __('Add Property','reales'),
                'edit'                  => __('Edit','reales'),
                'edit_item'             => __('Edit Property','reales'),
                'new_item'              => __('New Property','reales'),
                'view'                  => __('View','reales'),
                'view_item'             => __('View Property','reales'),
                'search_items'          => __('Search Properties','reales'),
                'not_found'             => __('No Properties found','reales'),
                'not_found_in_trash'    => __('No Properties found in Trash','reales'),
                'parent'                => __('Parent Property', 'reales'),
            ),
            'public'                => true,
            'exclude_from_search '  => false,
            'has_archive'           => true,
            // 'rewrite'               => array('slug' => 'properties'),
            'rewrite'               => array('slug' => _x('properties', 'URL SLUG', 'reales')),
            'supports'              => array('title', 'editor', 'thumbnail', 'comments'),
            'can_export'            => true,
            'register_meta_box_cb'  => 'reales_add_property_metaboxes',
            'menu_icon'             => PLUGIN_PATH . '/images/property-icon.png'
        ));

        // add property category custom taxonomy (e.g. apartments/houses)
        register_taxonomy('property_category', 'property', array(
            'labels' => array(
                'name'              => __('Property Categories','reales'),
                'add_new_item'      => __('Add New Property Category','reales'),
                'new_item_name'     => __('New Property Category','reales')
            ),
            'hierarchical'  => true,
            'query_var'     => true,
            'rewrite'       => array('slug' => 'listings')
        ));

        // add property type custom taxonomy (e.g. for rent/for sale)
        register_taxonomy('property_type_category', 'property', array(
            'labels' => array(
                'name'              => __('Property Types','reales'),
                'add_new_item'      => __('Add New Property Type','reales'),
                'new_item_name'     => __('New Property Type','reales')
            ),
            'hierarchical'  => true,
            'query_var'     => true,
            'rewrite'       => array('slug' => 'type')
        ));
    }
endif;
add_action('init', 'reales_register_property_type');

if( !function_exists('reales_insert_default_terms') ): 
    function reales_insert_default_terms() {
        reales_register_property_type();
        wp_insert_term('Apartment', 'property_category', $args = array());
        wp_insert_term('House', 'property_category', $args = array());
        wp_insert_term('Land', 'property_category', $args = array());
        wp_insert_term('For Rent', 'property_type_category', $args = array());
        wp_insert_term('For Sale', 'property_type_category', $args = array());
    }
endif;
register_activation_hook( __FILE__, 'reales_insert_default_terms' );

/**
 * Add property post type metaboxes
 */
if( !function_exists('reales_add_property_metaboxes') ): 
    function reales_add_property_metaboxes() {
        add_meta_box('property-location-section', __('Location', 'reales'), 'reales_property_location_render', 'property', 'normal', 'default');
        add_meta_box('property-details-section', __('Details', 'reales'), 'reales_property_details_render', 'property', 'normal', 'default');
        add_meta_box('property-additional-section', __('Additional Information', 'reales'), 'reales_property_additional_render', 'property', 'normal', 'default');
        add_meta_box('property-amenities-section', __('Amenities', 'reales'), 'reales_property_amenities_render', 'property', 'normal', 'default');
        add_meta_box('property-plans-section', __('Floor Plans', 'reales'), 'reales_property_plans_render', 'property', 'normal', 'default');
        add_meta_box('property-agent-section', __('Agent', 'reales'), 'reales_property_agent_render', 'property', 'normal', 'default');
        add_meta_box('property-video-section', __('Video', 'reales'), 'reales_property_video_render', 'property', 'normal', 'default');
        add_meta_box('property-gallery-section', __('Photo Gallery', 'reales'), 'reales_property_gallery_render', 'property', 'normal', 'default');
        add_meta_box('property-featured-section', __('Featured', 'reales'), 'reales_property_featured_render', 'property', 'side', 'default');
    }
endif;

if( !function_exists('reales_property_location_render') ): 
    function reales_property_location_render($post) {
        wp_nonce_field(PLUGIN_BASENAME, 'property_noncename');

        print '
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="property_city">' . __('City', 'reales') . '</label><br />';
        
        $reales_prop_fields_settings = get_option('reales_prop_fields_settings');
        $cities_list = isset($reales_prop_fields_settings['reales_p_city_t_field']) ? $reales_prop_fields_settings['reales_p_city_t_field'] : '';

        if($cities_list == 'list') {
            $reales_cities_settings = get_option('reales_cities_settings');

            print '<select id="property_city" name="property_city" class="formInput">
                        <option value="">' . __('Select a city', 'reales') . '</option>';
            if(is_array($reales_cities_settings) && count($reales_cities_settings) > 0) {
                uasort($reales_cities_settings, "reales_compare_position");
                foreach ($reales_cities_settings as $key => $value) {
                    print '<option value="' . $key . '"';
                    if (get_post_meta($post->ID, 'property_city', true) == $key) {
                        print ' selected ';
                    }
                    print '>' . $value['name'] . '</option>';
                }
            }
            print '</select>';
        } else {
            print '<input type="text" class="formInput auto" id="property_city" name="property_city" placeholder="' . __('Enter a city name', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'property_city', true)) . '" />';
        }

        print '         </div>
                    </td>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="property_lat">' . __('Latitude', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="property_lat" name="property_lat" value="' . esc_attr(get_post_meta($post->ID, 'property_lat', true)) . '" />
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="property_lng">' . __('Longitude', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="property_lng" name="property_lng" value="' . esc_attr(get_post_meta($post->ID, 'property_lng', true)) . '" />
                        </div>
                    </td>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100%" valign="top" align="left">
                        <div id="propMapView"></div>
                    </td>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="property_address">' . __('Address', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="property_address" name="property_address" placeholder="' . __('Enter address', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'property_address', true)) . '" />
                            <input id="placePinBtn" type="button" class="button" value="' . __('Place pin by address', 'reales') . '">
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="property_state">' . __('County/State', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="property_state" name="property_state" placeholder="' . __('Enter county/state', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'property_state', true)) . '" />
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="property_state">' . __('Neighborhood', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="property_neighborhood" name="property_neighborhood" placeholder="' . __('Enter neighborhood', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'property_neighborhood', true)) . '" />
                        </div>
                    </td>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="property_zip">' . __('Zip Code', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="property_zip" name="property_zip" placeholder="' . __('Enter zip code', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'property_zip', true)) . '" />
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="property_country">' . __('Country', 'reales') . '</label><br />';
                            print reales_country_list(esc_html(get_post_meta($post->ID, 'property_country', true)));
                            print '
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">&nbsp;</td>
                </tr>
            </table>';
    }
endif;

if( !function_exists('reales_property_details_render') ): 
    function reales_property_details_render($post) {
        wp_nonce_field(PLUGIN_BASENAME, 'property_noncename');
        $reales_general_settings = get_option('reales_general_settings');

        $price = (esc_html(get_post_meta($post->ID, 'property_price', true)) != '') ? esc_html(get_post_meta($post->ID, 'property_price', true)) : '';
        $currency_symbol = isset($reales_general_settings['reales_currency_symbol_field']) ? $reales_general_settings['reales_currency_symbol_field'] : '';
        $unit = isset($reales_general_settings['reales_unit_field']) ? $reales_general_settings['reales_unit_field'] : '';

        print '
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="property_price">' . __('Price', 'reales') . ' (' . esc_html($currency_symbol) . ')' . '</label><br />
                            <input type="text" class="formInput" id="property_price" name="property_price" placeholder="' . __('Enter price', 'reales') . '" value="' . esc_attr($price) . '" />
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="property_price_label">' . __('Price Label (e.g. "per month")', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="property_price_label" name="property_price_label" placeholder="' . __('Enter price label', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'property_price_label', true)) . '" />
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="property_area">' . __('Area', 'reales') . ' (' . esc_html($unit) . ')' . '</label><br />
                            <input type="text" class="formInput" id="property_area" name="property_area" placeholder="' . __('Enter area', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'property_area', true)) . '" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="property_bedrooms">' . __('Bedrooms', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="property_bedrooms" name="property_bedrooms" placeholder="' . __('Enter number of bedrooms', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'property_bedrooms', true)) . '" />
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="property_bathrooms">' . __('Bathrooms', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="property_bathrooms" name="property_bathrooms" placeholder="' . __('Enter number of bathrooms', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'property_bathrooms', true)) . '" />
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">&nbsp;</td>
                </tr>
            </table>';
    }
endif;

if( !function_exists('reales_property_additional_render') ): 
    function reales_property_additional_render($post) {
        wp_nonce_field(PLUGIN_BASENAME, 'property_noncename');
        $reales_fields_settings = get_option('reales_fields_settings');
        $counter = 0;

        if(is_array($reales_fields_settings)) {
            uasort($reales_fields_settings, "reales_compare_position");
            print '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>';
            foreach ($reales_fields_settings as $key => $value) {
                $counter++;
                if(($counter - 1) % 3 == 0) {
                    print '<tr>';
                }
                print '
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="' . $key . '">' . $value['label'] . '</label><br />';
                if($value['type'] == 'date_field') {
                    print '<input type="text" name="' . $key . '" id="' . $key . '" class="formInput datePicker" value="' . esc_attr(get_post_meta($post->ID, $key, true)) . '" />';
                } else if ($value['type'] == 'list_field') {
                    $list = explode(',', $value['list']);
                    print '<select name="' . $key . '" id="' . $key . '" class="formInput">';
                    print '<option value="">' . __('Select', 'reales') . '</option>';
                    for($i = 0; $i < count($list); $i++) {
                        print '<option value="' . $i . '"';
                        $list_value = get_post_meta($post->ID, $key, true);
                        if($list_value != '' && $list_value == $i) {
                            print ' selected';
                        }
                        print '>' . $list[$i] . '</option>';
                    }
                    print '</select>';
                } else {
                    print '<input type="text" name="' . $key . '" id="' . $key . '" class="formInput" value="' . esc_attr(get_post_meta($post->ID, $key, true)) . '" />';
                }
                print   '</div>
                    </td>';
                if($counter % 3 == 0) {
                    print '</tr>';
                }
            }
            print '</table>';
        } else {
            print __('No addtional information fields defined', 'reales');
        }
    }
endif;

if( !function_exists('reales_property_amenities_render') ): 
    function reales_property_amenities_render($post) {
        wp_nonce_field(PLUGIN_BASENAME, 'property_noncename');
        $reales_amenity_settings = get_option('reales_amenity_settings');
        $counter = 0;

        if(is_array($reales_amenity_settings) && count($reales_amenity_settings) > 0) {
            uasort($reales_amenity_settings, "reales_compare_position");
            print '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>';
            foreach ($reales_amenity_settings as $key => $value) {
                $counter++;
                if(($counter - 1) % 3 == 0) {
                    print '<tr>';
                }
                print '
                    <td width="33%" valign="top" align="left">
                        <p class="meta-options"> 
                            <input type="hidden" name="' . $key . '" value="">
                            <input type="checkbox" name="' . $key . '" value="1" ';

                if (get_post_meta($post->ID, $key, true) == 1) {
                    print ' checked ';
                }
                print ' />
                            <label for="' . $key . '">' . $value['label'] . '</label>
                        </p>
                    </td>';
                if($counter % 3 == 0) {
                    print '</tr>';
                }
            }
            print '</table>';
        } else {
            print __('No amenities defined', 'reales');
        }
    }
endif;

if( !function_exists('reales_property_plans_render') ): 
    function reales_property_plans_render($post) {
        wp_nonce_field(PLUGIN_BASENAME, 'property_noncename');
        $plans = array();
        $images_list = esc_html(get_post_meta($post->ID, 'property_plans', true));
        $images = explode('~~~', $images_list);

        print '<input type="hidden" id="property_plans" name="property_plans" value="' . esc_attr(get_post_meta($post->ID, 'property_plans', true)) . '" />';

        print '<ul class="list-group" id="propPlans">';
        foreach($images as $image) {
            if($image != '') {
                print '<li class="list-group-item"><img class="pull-left" src="' . esc_url($image) . '" />';
                print '<a href="javascript:void(0);" class="pull-right delImage">' . __('Delete', 'reales') . '</a>';
                print '<div class="clearfix"></div></li>';
            }
        }
        print '</ul>';

        print '<input id="addImageBtn" type="button" class="button" value="' . __('Add plan image', 'reales') . '" />';
    }
endif;

if( !function_exists('reales_property_agent_render') ): 
    function reales_property_agent_render($post) {
        wp_nonce_field(PLUGIN_BASENAME, 'property_noncename');
        $mypost = $post->ID;
        $originalpost = $post;
        $agent_list = '';
        $selected_agent = esc_html(get_post_meta($mypost, 'property_agent', true));

        $args = array(
            'post_type' => 'agent',
            'post_status' => 'publish',
            'posts_per_page' => -1
        );

        $agent_selection = new WP_Query($args);

        while($agent_selection->have_posts()) {
            $agent_selection->the_post();
            $the_id = get_the_ID();

            $agent_list .= '<option value="' . esc_attr($the_id) . '"';
                if ($the_id == $selected_agent) {
                    $agent_list .= ' selected';
                }
                $agent_list .= '>' . get_the_title() . '</option>';
        }

        wp_reset_postdata();
        $post = $originalpost;

        print '
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="property_agent">' . __('Assign an Agent', 'reales') . '</label><br />
                            <select id="property_agent" name="property_agent">
                                <option value="">none</option>
                                ' . $agent_list . '
                            </select>
                        </div>
                    </td>
                </tr>
            </table>';
    }
endif;

if( !function_exists('reales_property_video_render') ): 
    function reales_property_video_render($post) {
        wp_nonce_field(PLUGIN_BASENAME, 'property_noncename');
        $selected_source = esc_html(get_post_meta($post->ID, 'property_video_source', true));

        if($selected_source == 'youtube') {
            $source_list = '<option value="">none</option>
                            <option value="youtube" selected>' . __('youtube', 'reales') . '</option>
                            <option value="vimeo">' . __('vimeo', 'reales') . '</option>';
        } else if($selected_source == 'vimeo') {
            $source_list = '<option value="">none</option>
                            <option value="youtube">' . __('youtube', 'reales') . '</option>
                            <option value="vimeo" selected>' . __('vimeo', 'reales') . '</option>';
        } else {
            $source_list = '<option value="" selected>none</option>
                            <option value="youtube">' . __('youtube', 'reales') . '</option>
                            <option value="vimeo">' . __('vimeo', 'reales') . '</option>';
        }

        print '
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="property_video_source">' . __('Video source', 'reales') . '</label><br />
                            <select id="property_video_source" name="property_video_source">
                                ' . $source_list . '
                            </select>
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">
                        <div class="adminField">
                            <label for="property_video_id">' . __('Video ID', 'reales') . '</label><br />
                            <input type="text" class="formInput" id="property_video_id" name="property_video_id" placeholder="' . __('Enter video ID', 'reales') . '" value="' . esc_attr(get_post_meta($post->ID, 'property_video_id', true)) . '" />
                        </div>
                    </td>
                    <td width="33%" valign="top" align="left">&nbsp;</td>
                </tr>
            </table>';
    }
endif;

if( !function_exists('reales_property_gallery_render') ): 
    function reales_property_gallery_render($post) {
        wp_nonce_field(PLUGIN_BASENAME, 'property_noncename');
        $gallery = array();
        $photos_list = esc_html(get_post_meta($post->ID, 'property_gallery', true));
        $photos = explode('~~~', $photos_list);

        print '<input type="hidden" id="property_gallery" name="property_gallery" value="' . esc_attr(get_post_meta($post->ID, 'property_gallery', true)) . '" />';

        print '<ul class="list-group" id="propGallery">';
        foreach($photos as $photo) {
            if($photo != '') {
                print '<li class="list-group-item"><img class="pull-left" src="' . esc_url($photo) . '" />';
                print '<a href="javascript:void(0);" class="pull-right delPhoto">' . __('Delete', 'reales') . '</a>';
                print '<div class="clearfix"></div></li>';
            }
        }
        print '</ul>';

        print '<input id="addPhotoBtn" type="button" class="button" value="' . __('Add photo', 'reales') . '" />';
    }
endif;

if( !function_exists('reales_property_featured_render') ): 
    function reales_property_featured_render($post) {
        wp_nonce_field(PLUGIN_BASENAME, 'property_noncename');

        print '
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100%" valign="top" align="left">
                        <p class="meta-options">
                            <input type="hidden" name="property_featured" value="">
                            <input type="checkbox" name="property_featured" value="1" ';
                            if (esc_html(get_post_meta($post->ID, 'property_featured', true)) == 1) {
                                print ' checked ';
                            }
                            print ' />
                            <label for="property_featured">' . __('Set as Featured', 'reales') . '</label>
                        </p>
                    </td>
                </tr>
            </table>';
    }
endif;

if( !function_exists('reales_property_meta_save') ): 
    function reales_property_meta_save($post_id) {
        $is_autosave = wp_is_post_autosave($post_id);
        $is_revision = wp_is_post_revision($post_id);
        $is_valid_nonce = (isset($_POST['property_noncename']) && wp_verify_nonce($_POST['property_noncename'], PLUGIN_BASENAME)) ? 'true' : 'false';

        if ($is_autosave || $is_revision || !$is_valid_nonce) {
            return;
        }

        if(isset($_POST['property_city'])) {
            update_post_meta($post_id, 'property_city', sanitize_text_field($_POST['property_city']));
        }
        if(isset($_POST['property_lat'])) {
            update_post_meta($post_id, 'property_lat', sanitize_text_field($_POST['property_lat']));
        }
        if(isset($_POST['property_lng'])) {
            update_post_meta($post_id, 'property_lng', sanitize_text_field($_POST['property_lng']));
        }
        if(isset($_POST['property_address'])) {
            update_post_meta($post_id, 'property_address', sanitize_text_field($_POST['property_address']));
        }
        if(isset($_POST['property_state'])) {
            update_post_meta($post_id, 'property_state', sanitize_text_field($_POST['property_state']));
        }
        if(isset($_POST['property_neighborhood'])) {
            update_post_meta($post_id, 'property_neighborhood', sanitize_text_field($_POST['property_neighborhood']));
        }
        if(isset($_POST['property_zip'])) {
            update_post_meta($post_id, 'property_zip', sanitize_text_field($_POST['property_zip']));
        }
        if(isset($_POST['property_country'])) {
            update_post_meta($post_id, 'property_country', sanitize_text_field($_POST['property_country']));
        }
        if(isset($_POST['property_price'])) {
            // Comment this for now
            // $price_no = preg_replace('/[^a-z_ \-0-9\x{4e00}-\x{9fa5}]/ui', '', $_POST['property_price']);
            update_post_meta($post_id, 'property_price', sanitize_text_field($_POST['property_price']));
        }
        if(isset($_POST['property_price_label'])) {
            update_post_meta($post_id, 'property_price_label', sanitize_text_field($_POST['property_price_label']));
        }
        if(isset($_POST['property_area'])) {
            update_post_meta($post_id, 'property_area', sanitize_text_field($_POST['property_area']));
        }
        if(isset($_POST['property_bedrooms'])) {
            update_post_meta($post_id, 'property_bedrooms', sanitize_text_field($_POST['property_bedrooms']));
        }
        if(isset($_POST['property_bathrooms'])) {
            update_post_meta($post_id, 'property_bathrooms', sanitize_text_field($_POST['property_bathrooms']));
        }

        $reales_amenity_settings = get_option('reales_amenity_settings');
        if(is_array($reales_amenity_settings) && count($reales_amenity_settings) > 0) {
            foreach ($reales_amenity_settings as $key => $value) {
                if(isset($_POST[$key])) {
                    update_post_meta($post_id, $key, sanitize_text_field($_POST[$key]));
                }
            }
        }

        if(isset($_POST['property_plans'])) {
            update_post_meta($post_id, 'property_plans', sanitize_text_field($_POST['property_plans']));
        }

        $reales_fields_settings = get_option('reales_fields_settings');
        if(is_array($reales_fields_settings)) {
            foreach ($reales_fields_settings as $key => $value) {
                if(isset($_POST[$key])) {
                    update_post_meta($post_id, $key, sanitize_text_field($_POST[$key]));
                }
            }
        }

        if(isset($_POST['property_agent'])) {
            update_post_meta($post_id, 'property_agent', sanitize_text_field($_POST['property_agent']));
        }
        if(isset($_POST['property_video_source'])) {
            update_post_meta($post_id, 'property_video_source', sanitize_text_field($_POST['property_video_source']));
        }
        if(isset($_POST['property_video_id'])) {
            update_post_meta($post_id, 'property_video_id', sanitize_text_field($_POST['property_video_id']));
        }
        if(isset($_POST['property_gallery'])) {
            update_post_meta($post_id, 'property_gallery', sanitize_text_field($_POST['property_gallery']));
        }
        if(isset($_POST['property_featured'])) {
            update_post_meta($post_id, 'property_featured', sanitize_text_field($_POST['property_featured']));
        }
    }
endif;
add_action('save_post', 'reales_property_meta_save');

if( !function_exists('reales_country_list') ): 
    function reales_country_list($selected) {
        $countries = array("Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium","Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo, Republic of the", "Congo, Democratic Republic of the", "Costa Rica", "Cote d Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kosovo", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "Norway", "Oman", "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Puerto Rico", "Qatar", "Romania", "Russia", "Rwanda", "St. Kitts and Nevis", "St. Lucia", "St. Vincent and The Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Korea", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe");
        $country_select = '<select id="property_country" name="property_country">';

        if ($selected == '') {
            $reales_general_settings = get_option('reales_general_settings');
            if(isset($reales_general_settings['reales_country_field'])) {
                $selected = $reales_general_settings['reales_country_field'];
            }
        }

        foreach ($countries as $country) {
            $country_select .= '<option value="' . esc_attr($country) . '"';
            if ($selected == $country) {
                $country_select .= 'selected="selected"';
            }
            $country_select .= '>' . esc_html($country) . '</option>';
        }
        $country_select.='</select>';

        return $country_select;
    }
endif;

if( !function_exists('reales_substr45') ): 
    function reales_substr45($string) {
        return substr($string, 0, 45);
    }
endif;

if( !function_exists('reales_change_property_default_title') ): 
    function reales_change_property_default_title($title){
        $screen = get_current_screen();
        if ('property' == $screen->post_type) {
            $title = __('Enter property title here', 'reales');
        }
        return $title;
    }
endif;
add_filter('enter_title_here', 'reales_change_property_default_title');
?>
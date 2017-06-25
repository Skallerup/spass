<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

if( !function_exists('reales_admin_gmaps') ): 
    function reales_admin_gmaps() {
        add_settings_section( 'reales_gmaps_section', __( 'Google Maps', 'reales' ), 'reales_gmaps_section_callback', 'reales_gmaps_settings' );
        add_settings_field( 'reales_gmaps_key_field', __( 'Google maps API key', 'reales' ), 'reales_gmaps_key_field_render', 'reales_gmaps_settings', 'reales_gmaps_section' );
        add_settings_field( 'reales_gmaps_lat_field', __( 'Google maps default latitude', 'reales' ), 'reales_gmaps_lat_field_render', 'reales_gmaps_settings', 'reales_gmaps_section' );
        add_settings_field( 'reales_gmaps_lng_field', __( 'Google maps default longitude', 'reales' ), 'reales_gmaps_lng_field_render', 'reales_gmaps_settings', 'reales_gmaps_section' );
        add_settings_field( 'reales_gmaps_zoom_field', __( 'Google maps default zoom level', 'reales' ), 'reales_gmaps_zoom_field_render', 'reales_gmaps_settings', 'reales_gmaps_section' );
        add_settings_field( 'reales_gmaps_style_field', __( 'Google maps style', 'reales' ), 'reales_gmaps_style_field_render', 'reales_gmaps_settings', 'reales_gmaps_section' );
    }
endif;

if( !function_exists('reales_gmaps_section_callback') ): 
    function reales_gmaps_section_callback() { 
        echo '';
    }
endif;

if( !function_exists('reales_gmaps_key_field_render') ): 
    function reales_gmaps_key_field_render() {
        $options = get_option( 'reales_gmaps_settings' );
        ?>
        <input type="text" size="40" name="reales_gmaps_settings[reales_gmaps_key_field]" value="<?php if(isset($options['reales_gmaps_key_field'])) { echo esc_attr($options['reales_gmaps_key_field']); } ?>" />
        <p class="help">The Google Maps JavaScript API v3 does not require an API key to function correctly. However, we strongly encourage you to load the Maps API using an APIs Console key. You can get it from <a href="https://developers.google.com/maps/documentation/javascript/tutorial#api_key" target="_blank">here</a>.</p>
        <?php
    }
endif;

if( !function_exists('reales_gmaps_lat_field_render') ): 
    function reales_gmaps_lat_field_render() {
        $options = get_option( 'reales_gmaps_settings' );
        ?>
        <input type="text" size="40" name="reales_gmaps_settings[reales_gmaps_lat_field]" value="<?php if(isset($options['reales_gmaps_lat_field'])) { echo esc_attr($options['reales_gmaps_lat_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_gmaps_lng_field_render') ): 
    function reales_gmaps_lng_field_render() {
        $options = get_option( 'reales_gmaps_settings' );
        ?>
        <input type="text" size="40" name="reales_gmaps_settings[reales_gmaps_lng_field]" value="<?php if(isset($options['reales_gmaps_lat_field'])) { echo esc_attr($options['reales_gmaps_lng_field']); } ?>" />
        <?php
    }
endif;

if( !function_exists('reales_gmaps_zoom_field_render') ): 
    function reales_gmaps_zoom_field_render() {
        $options = get_option( 'reales_gmaps_settings' );
        $values = array(3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21);
        $value_select = '<select id="reales_gmaps_settings[reales_gmaps_zoom_field]" name="reales_gmaps_settings[reales_gmaps_zoom_field]">';

        foreach($values as $value) {
            $value_select .= '<option value="' . esc_attr($value) . '"';
            if(isset($options['reales_gmaps_zoom_field']) && $options['reales_gmaps_zoom_field'] == $value) {
                $value_select .= 'selected="selected"';
            }
            $value_select .= '>' . esc_html($value) . '</option>';
        }

        $value_select .= '</select>';

        print $value_select;
    }
endif;

if( !function_exists('reales_gmaps_style_field_render') ): 
    function reales_gmaps_style_field_render() {
        $options = get_option( 'reales_gmaps_settings' );
        $values = array(
            __('Default', 'reales')      => '',
            __('Light Gray', 'reales')   => urlencode('[{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d3d3d3"}]},{"featureType":"transit","stylers":[{"color":"#808080"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#b3b3b3"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":1.8}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#d7d7d7"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ebebeb"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#a7a7a7"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#efefef"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#696969"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#737373"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#d6d6d6"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#dadada"}]}]'),
            __('Dark Gray', 'reales')    => urlencode('[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]'),
            __('Light Red', 'reales')    => urlencode('[{"stylers":[{"hue":"#dd0d0d"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]}]'),
            __('Dark Red', 'reales')     => urlencode('[{"featureType":"administrative","elementType":"labels","stylers":[{"visibility":"simplified"},{"color":"#e94f3f"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"on"},{"gamma":"0.50"},{"hue":"#ff4a00"},{"lightness":"-79"},{"saturation":"-86"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"hue":"#ff1700"}]},{"featureType":"landscape.natural.landcover","elementType":"all","stylers":[{"visibility":"on"},{"hue":"#ff0000"}]},{"featureType":"poi","elementType":"all","stylers":[{"color":"#e74231"},{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#4d6447"},{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"color":"#f0ce41"},{"visibility":"off"}]},{"featureType":"poi.park","elementType":"all","stylers":[{"color":"#363f42"}]},{"featureType":"road","elementType":"all","stylers":[{"color":"#231f20"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#6c5e53"}]},{"featureType":"transit","elementType":"all","stylers":[{"color":"#313639"},{"visibility":"off"}]},{"featureType":"transit","elementType":"labels.text","stylers":[{"hue":"#ff0000"}]},{"featureType":"transit","elementType":"labels.text.fill","stylers":[{"visibility":"simplified"},{"hue":"#ff0000"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#0e171d"}]}]'),
            __('Light Green', 'reales')  => urlencode('[{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#aee2e0"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#abce83"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#769E72"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#7B8758"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#EBF4A4"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#8dab68"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#5B5B3F"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ABCE83"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#A4C67D"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#9BBF72"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#EBF4A4"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#87ae79"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#7f2200"},{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"visibility":"on"},{"weight":4.1}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#495421"}]},{"featureType":"administrative.neighborhood","elementType":"labels","stylers":[{"visibility":"off"}]}]'),
            __('Dark Green', 'reales')   => urlencode('[{"featureType":"all","elementType":"all","stylers":[{"invert_lightness":true},{"saturation":-80},{"lightness":30},{"gamma":0.5},{"hue":"#3d433a"}]}]'),
            __('Light Blue', 'reales')   => urlencode('[{"featureType":"all","stylers":[{"saturation":0},{"hue":"#e7ecf0"}]},{"featureType":"road","stylers":[{"saturation":-70}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"visibility":"simplified"},{"saturation":-60}]}]'),
            __('Dark Blue', 'reales')    => urlencode('[{"featureType":"water","elementType":"geometry","stylers":[{"color":"#193341"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#2c5a71"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#29768a"},{"lightness":-37}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#406d80"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#406d80"}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#3e606f"},{"weight":2},{"gamma":0.84}]},{"elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"weight":0.6},{"color":"#1a3541"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#2c5a71"}]}]'),
            __('Light Yellow', 'reales') => urlencode('[{"featureType":"landscape","stylers":[{"hue":"#FFAD00"},{"saturation":50.2},{"lightness":-34.8},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFAD00"},{"saturation":-19.8},{"lightness":-1.8},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FFAD00"},{"saturation":72.4},{"lightness":-32.6},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FFAD00"},{"saturation":74.4},{"lightness":-18},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#00FFA6"},{"saturation":-63.2},{"lightness":38},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#FFC300"},{"saturation":54.2},{"lightness":-14.4},{"gamma":1}]}]'),
            __('Dark Yellow', 'reales')  => urlencode('[{"featureType":"all","elementType":"all","stylers":[{"invert_lightness":true},{"saturation":"0"},{"lightness":"33"},{"gamma":0.5},{"hue":"#ffcc00"},{"weight":"1.51"}]},{"featureType":"transit.station.rail","elementType":"labels.text","stylers":[{"gamma":"1.00"}]},{"featureType":"transit.station.rail","elementType":"labels.text.fill","stylers":[{"hue":"#ff0000"},{"lightness":"42"}]},{"featureType":"transit.station.rail","elementType":"labels.icon","stylers":[{"hue":"#ff0000"},{"invert_lightness":true},{"lightness":"-15"},{"saturation":"31"}]}]'),
        );
        $value_select = '<select id="reales_gmaps_settings[reales_gmaps_style_field]" name="reales_gmaps_settings[reales_gmaps_style_field]">';

        foreach($values as $key => $value) {
            $value_select .= '<option value="' . esc_attr($value) . '"';
            if(isset($options['reales_gmaps_style_field']) && $options['reales_gmaps_style_field'] == $value) {
                $value_select .= 'selected="selected"';
            }
            $value_select .= '>' . esc_html($key) . '</option>';
        }

        $value_select .= '</select>';

        print $value_select;
    }
endif;

?>
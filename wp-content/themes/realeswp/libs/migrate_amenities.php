<?php
/**
 * @package WordPress
 * @subpackage Reales
 */

$reales_amenities_settings = get_option('reales_amenities_settings');
$reales_amenity_settings = get_option('reales_amenity_settings');
$amenities_list = array();
$amenities = isset($reales_amenities_settings['reales_amenities_field']) ? $reales_amenities_settings['reales_amenities_field'] : '';
$amenities_list = explode(',', $amenities);

if($amenities != '') {
    foreach($amenities_list as $key => $value) {
        $post_var_name = str_replace(' ', '_', trim($value));
        $input_name = reales_substr45(sanitize_title($post_var_name));
        $input_name = sanitize_key($input_name);

        $reales_amenity_settings[$input_name]['name']        = $input_name;
        $reales_amenity_settings[$input_name]['label']       = $value;
        $reales_amenity_settings[$input_name]['icon']        = 'fa fa-check';
        $reales_amenity_settings[$input_name]['position']    = '0';
    }

    update_option('reales_amenity_settings', $reales_amenity_settings);
    delete_option('reales_amenities_settings');
}
?>